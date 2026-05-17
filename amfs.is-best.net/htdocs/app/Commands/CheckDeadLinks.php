<?php declare(strict_types=1);

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\ItemModel;
use App\Models\CronLogModel;
use App\Models\AuditLogModel;

class CheckDeadLinks extends BaseCommand
{
    protected $group       = 'Maintenance';
    protected $name        = 'app:check-links';
    protected $description = 'Vérifie les liens morts (404) de toutes les cartes. Exécution limitée à 1 fois par semaine.';

    public function run(array $params)
    {
        $cronModel = new CronLogModel();
        $lastRun = $cronModel->where('task_name', 'check_dead_links')->first();

        // Vérification du délai d'une semaine (604800 secondes)
        if ($lastRun) {
            $lastRunDate = strtotime($lastRun['last_run']);
            $now = time();
            
            // Si on force l'exécution via la commande "php spark app:check-links -f"
            $force = in_array('-f', $params);

            if (($now - $lastRunDate) < 604800 && !$force) {
                CLI::write("La vérification a déjà eu lieu cette semaine (" . date('d/m/Y', $lastRunDate) . ").", 'yellow');
                CLI::write("Utilisez 'php spark app:check-links -f' pour forcer l'exécution.", 'yellow');
                return;
            }
        }

        CLI::write("Démarrage de la vérification des liens externes...", 'cyan');

        $itemModel = new ItemModel();
        // On ne teste que les items qui ont un lien
        $items = $itemModel->where('lien !=', '')->where('lien IS NOT NULL')->findAll();

        // Configuration du client HTTP (Timeout court, ne suit pas les erreurs pour les récupérer)
        $client = \Config\Services::curlrequest([
            'timeout' => 7,
            'http_errors' => false,
            'allow_redirects' => true
        ]);

        $deadCount = 0;
        $totalChecked = 0;

        foreach ($items as $item) {
            // 1. Formatage du lien : Remplacement des variables {ep} et {ep2} par l'épisode actuel
            $ep = $item->episode ?: '1'; // S'il n'y a pas d'épisode, on teste avec 1
            $ep2 = str_pad((string)$ep, 2, '0', STR_PAD_LEFT); // Format 01, 02...
            
            $urlToTest = str_replace(['{ep}', '{ep2}'], [$ep, $ep2], $item->lien);
            $totalChecked++;

            try {
                $response = $client->get($urlToTest);
                $statusCode = $response->getStatusCode();
            } catch (\Exception $e) {
                // Domaine introuvable, timeout ou erreur DNS
                $statusCode = 404; 
            }

            // Si c'est une erreur 404 ou une erreur serveur (500+)
            if ($statusCode == 404 || $statusCode >= 500) {
                CLI::write("[MORT] ({$statusCode}) : {$item->titre}", 'red');
                $itemModel->update($item->id, ['link_status' => 'dead']);
                $deadCount++;
            } else {
                // Si le lien fonctionne à nouveau, on enlève le flag 'dead'
                if ($item->link_status === 'dead') {
                    $itemModel->update($item->id, ['link_status' => 'ok']);
                    CLI::write("[RÉTABLI] : {$item->titre}", 'green');
                }
            }
        }

        // Mise à jour de la date d'exécution dans la base
        if ($lastRun) {
            $cronModel->update($lastRun['id'], ['last_run' => date('Y-m-d H:i:s')]);
        } else {
            $cronModel->insert(['task_name' => 'check_dead_links', 'last_run' => date('Y-m-d H:i:s')]);
        }

        // Trace dans l'Audit Trail
        if ($deadCount > 0) {
            $audit = new AuditLogModel();
            $audit->logAction('Maintenance Système', "Scan de liens : {$totalChecked} URLs testées, {$deadCount} lien(s) mort(s) détecté(s) et flagué(s).");
        }

        CLI::newLine();
        CLI::write("✓ Vérification terminée. {$totalChecked} liens testés. {$deadCount} liens morts détectés.", 'black', 'green');
    }
}