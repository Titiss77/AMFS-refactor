<?php declare(strict_types=1);

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\CronLogModel;
use App\Models\AuditLogModel;

class CronController extends BaseController
{
    public function run()
    {
        // Empêche le serveur de couper le script s'il met du temps
        ini_set('max_execution_time', '0');

        $cronModel = new CronLogModel();
        $lastRun = $cronModel->where('task_name', 'check_dead_links')->first();

        $now = time();
        $shouldRun = false;
        
        $isForced = $this->request->getGet('force') === '1';

        if (!$lastRun) {
            $shouldRun = true;
            $cronModel->insert(['task_name' => 'check_dead_links', 'last_run' => date('Y-m-d H:i:s')]);
        } else {
            $lastRunDate = strtotime($lastRun['last_run']);
            
            if (($now - $lastRunDate) >= 604800 || $isForced) {
                $shouldRun = true;
                $cronModel->update($lastRun['id'], ['last_run' => date('Y-m-d H:i:s')]);
            }
        }

        if (!$shouldRun) {
            return $this->response->setJSON(['status' => 'skipped', 'message' => 'Délai de 7 jours non écoulé.']);
        }

        $itemModel = new ItemModel();
        $items = $itemModel->where('lien !=', '')->where('lien IS NOT NULL')->findAll();

        // Ajout d'un faux User-Agent pour passer les sécurités Anti-Bot (Cloudflare, etc.)
        $client = \Config\Services::curlrequest([
            'timeout'         => 7, 
            'http_errors'     => false,
            'allow_redirects' => true,
            'user_agent'      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
        ]);

        $deadCount = 0;
        $totalChecked = 0;
        $deadLinksDetails = []; 

        foreach ($items as $item) {
            
            // 1. Gestion des épisodes ({ep} et {ep2})
            $ep = $item->episode ?: '1';
            $ep2 = str_pad((string)$ep, 2, '0', STR_PAD_LEFT);
            
            // 2. Gestion des saisons ({s} et {s2})
            $s = $item->saison ?: '1'; // Si la saison n'est pas remplie, on teste avec la saison 1
            $s2 = str_pad((string)$s, 2, '0', STR_PAD_LEFT);

            // 3. Remplacement global dans l'URL
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
                $statusCode = 404; // Considéré comme mort si on ne trouve pas le serveur
            }

            // On signale si erreur 404, 403 (Souvent accès interdit définitif), ou 500+
            if (in_array($statusCode, [403, 404]) || $statusCode >= 500) {
                $itemModel->update($item->id, ['link_status' => 'dead']);
                $deadCount++;
                
                $deadLinksDetails[] = [
                    'id'          => $item->id,
                    'titre'       => $item->titre,
                    'url_testee'  => $urlToTest,
                    'code_erreur' => $statusCode
                ];
                
            } else {
                if ($item->link_status === 'dead') {
                    $itemModel->update($item->id, ['link_status' => 'ok']);
                }
            }
        }

        if ($deadCount > 0) {
            $audit = new AuditLogModel();
            $message = $isForced ? "Scan FORCÉ de liens" : "Scan de liens en arrière-plan";
            $audit->logAction('Maintenance Système', "{$message} : {$totalChecked} URLs testées, {$deadCount} lien(s) mort(s).");
        }

        return $this->response->setJSON([
            'status'        => 'executed',
            'forced'        => $isForced,
            'total_checked' => $totalChecked,
            'dead_count'    => $deadCount,
            'dead_links'    => $deadLinksDetails
        ]);
    }
}