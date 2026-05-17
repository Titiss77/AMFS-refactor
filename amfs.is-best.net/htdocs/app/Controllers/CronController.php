<?php declare(strict_types=1);

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\CronLogModel;
use App\Models\AuditLogModel;

class CronController extends BaseController
{
    public function run()
    {
        // Empêche le serveur de couper le script s'il met du temps à tester les liens
        ini_set('max_execution_time', '0');

        $cronModel = new CronLogModel();
        $lastRun = $cronModel->where('task_name', 'check_dead_links')->first();

        $now = time();
        $shouldRun = false;

        if (!$lastRun) {
            $shouldRun = true;
            // Insertion initiale
            $cronModel->insert(['task_name' => 'check_dead_links', 'last_run' => date('Y-m-d H:i:s')]);
        } else {
            $lastRunDate = strtotime($lastRun['last_run']);
            // 604800 secondes = exactement 7 jours
            if (($now - $lastRunDate) >= 604800) {
                $shouldRun = true;
                // /!\ IMPORTANT : On met à jour la date AVANT de tester les liens.
                // Cela évite que si 2 utilisateurs chargent la page en même temps, 
                // le script se lance deux fois en parallèle.
                $cronModel->update($lastRun['id'], ['last_run' => date('Y-m-d H:i:s')]);
            }
        }

        // Si le délai n'est pas écoulé, on stoppe silencieusement le script
        if (!$shouldRun) {
            return $this->response->setJSON(['status' => 'skipped', 'message' => 'Délai de 7 jours non écoulé.']);
        }

        // ==========================================
        // DÉBUT DE LA VÉRIFICATION DES LIENS
        // ==========================================
        $itemModel = new ItemModel();
        $items = $itemModel->where('lien !=', '')->where('lien IS NOT NULL')->findAll();

        // Configuration HTTP optimisée (timeout court pour ne pas s'éterniser sur un serveur mort)
        $client = \Config\Services::curlrequest([
            'timeout'         => 5, 
            'http_errors'     => false,
            'allow_redirects' => true
        ]);

        $deadCount = 0;
        $totalChecked = 0;

        foreach ($items as $item) {
            // Formatage des variables d'épisodes {ep}
            $ep = $item->episode ?: '1';
            $ep2 = str_pad((string)$ep, 2, '0', STR_PAD_LEFT);
            $urlToTest = str_replace(['{ep}', '{ep2}'], [$ep, $ep2], $item->lien);
            $totalChecked++;

            try {
                $response = $client->get($urlToTest);
                $statusCode = $response->getStatusCode();
            } catch (\Exception $e) {
                $statusCode = 404; // Erreur DNS ou Timeout
            }

            // Flag de la carte si erreur 404 ou 500+
            if ($statusCode == 404 || $statusCode >= 500) {
                $itemModel->update($item->id, ['link_status' => 'dead']);
                $deadCount++;
            } else {
                // Rétablissement si le lien remarche
                if ($item->link_status === 'dead') {
                    $itemModel->update($item->id, ['link_status' => 'ok']);
                }
            }
        }

        // Inscription dans l'Audit Trail pour alerter l'Admin
        if ($deadCount > 0) {
            $audit = new AuditLogModel();
            $audit->logAction('Maintenance Système', "Scan de liens en arrière-plan : {$totalChecked} URLs testées, {$deadCount} lien(s) mort(s).");
        }

        return $this->response->setJSON([
            'status'        => 'executed',
            'total_checked' => $totalChecked,
            'dead_count'    => $deadCount
        ]);
    }
}