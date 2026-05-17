<?php declare(strict_types=1);

namespace App\Controllers;

use App\Models\AuditLogModel;
use App\Models\CronLogModel;
use App\Models\ItemModel;

class CronController extends BaseController
{
    public function run()
    {
        ini_set('max_execution_time', '0');

        $cronModel = new CronLogModel();

        // Recherche du repère temporel le plus récent en base
        $lastRunRow = $cronModel->orderBy('last_run', 'DESC')->first();

        $now = time();
        $shouldRun = false;
        $isForced = $this->request->getGet('force') === '1';

        if (!$lastRunRow) {
            $shouldRun = true;
        } else {
            $lastRunDate = strtotime($lastRunRow['last_run']);
            // 604800 secondes = 7 jours
            if (($now - $lastRunDate) >= 604800 || $isForced) {
                $shouldRun = true;
            }
        }

        if (!$shouldRun) {
            return $this->response->setJSON(['status' => 'skipped', 'message' => 'Délai de 7 jours non écoulé.']);
        }

        // --- ENLEVER LES ANCIENS RÉSULTATS ---
        // Vidage complet de la table comme demandé avant d'écrire les nouvelles données
        $cronModel->truncate();

        $itemModel = new ItemModel();
        $items = $itemModel->where('lien !=', '')->where('lien IS NOT NULL')->findAll();

        $client = \Config\Services::curlrequest([
            'timeout' => 7,
            'http_errors' => false,
            'allow_redirects' => true,
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
        ]);

        $deadCount = 0;
        $totalChecked = 0;
        $currentTimestamp = date('Y-m-d H:i:s');
        $deadLinksDetails = [];

        foreach ($items as $item) {
            $ep = $item->episode ?: '1';
            $ep2 = str_pad((string) $ep, 2, '0', STR_PAD_LEFT);
            $s = $item->saison ?: '1';
            $s2 = str_pad((string) $s, 2, '0', STR_PAD_LEFT);

            $urlToTest = str_replace(
                ['{ep}', '{ep2}', '{s}', '{s2}'],
                [$ep, $ep2, $s, $s2],
                $item->lien
            );

            $totalChecked++;

            try {
                $response = $client->get($urlToTest);
                $statusCode = $response->getStatusCode();
            } catch (\Exception $e) {
                $statusCode = 404;
            }

            if (in_array($statusCode, [403, 404]) || $statusCode >= 500) {
                $itemModel->update($item->id, ['link_status' => 'dead']);
                $deadCount++;

                // Écriture du résultat directement dans la table cron_logs
                $cronModel->insert([
                    'task_name' => 'check_dead_links',
                    'last_run' => $currentTimestamp,
                    'item_id' => $item->id,
                    'titre' => $item->titre,
                    'url_testee' => $urlToTest,
                    'code_erreur' => $statusCode
                ]);

                $deadLinksDetails[] = [
                    'id' => $item->id,
                    'titre' => $item->titre,
                    'url_testee' => $urlToTest,
                    'code_erreur' => $statusCode
                ];
            } else {
                if ($item->link_status === 'dead') {
                    $itemModel->update($item->id, ['link_status' => 'ok']);
                }
            }
        }

        // Si aucun lien n'est mort, on génère une ligne témoin pour caler le last_run du prochain cycle
        if ($deadCount === 0) {
            $cronModel->insert([
                'task_name' => 'check_dead_links',
                'last_run' => $currentTimestamp,
                'item_id' => null,
                'titre' => 'Aucun lien mort détecté',
                'url_testee' => null,
                'code_erreur' => 200
            ]);
        }

        if ($deadCount > 0) {
            $audit = new AuditLogModel();
            $message = $isForced ? 'Scan FORCÉ de liens' : 'Scan de liens en arrière-plan';
            $audit->logAction('Maintenance Système', "{$message} : {$totalChecked} URLs vérifiées, {$deadCount} anomalie(s) enregistrée(s) dans les journaux.");
        }

        return $this->response->setJSON([
            'status' => 'executed',
            'forced' => $isForced,
            'total_checked' => $totalChecked,
            'dead_count' => $deadCount,
            'dead_links' => $deadLinksDetails
        ]);
    }
}