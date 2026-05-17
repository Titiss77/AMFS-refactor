<?php declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\ItemRevisionModel;
use App\Models\CronLogModel;
use App\Models\AuditLogModel;

class ItemController extends BaseController
{
    public function pending()
    {
        helper('text');
        
        $itemModel = new ItemModel();
        $revisionModel = new ItemRevisionModel();

        $revisions = $revisionModel->getPendingRevisions();

        foreach ($revisions as &$revision) {
            $original = $itemModel->asArray()->find($revision['original_item_id']);
            $changes = [];

            $fieldsToCompare = [
                'titre'       => 'Titre',
                'status'      => 'Statut',
                'image'       => 'Image / Couverture',
                'lien'        => 'Lien de visionnage/lecture',
                'description' => 'Description',
                'episode'     => 'Épisode',
                'saison'      => 'Saison',
                'date_sortie' => 'Date de sortie'
            ];

            if ($original) {
                foreach ($fieldsToCompare as $field => $label) {
                    $oldValue = $original[$field] ?? '';
                    $newValue = $revision[$field] ?? '';

                    if ($field === 'date_sortie' && (!empty($oldValue) || !empty($newValue))) {
                        $oldValue = $oldValue ? substr((string)$oldValue, 0, 10) : '';
                        $newValue = $newValue ? substr((string)$newValue, 0, 10) : '';
                    }

                    if ((string)$oldValue !== (string)$newValue) {
                        $changes[] = [
                            'field' => $field,
                            'label' => $label,
                            'old'   => $oldValue,
                            'new'   => $newValue
                        ];
                    }
                }
            }
            $revision['changes'] = $changes;
        }

        $data = [
            'pendingItems' => $itemModel->where('is_public', 2)->findAll(),
            'pendingRevisions' => $revisions
        ];

        return view('admin/items/pending', $data);
    }

    public function approve($id)
    {
        $itemModel = new ItemModel();
        $item = $itemModel->find($id);

        if ($item) {
            $itemModel->update($id, ['is_public' => 1]); 
            
            $audit = new AuditLogModel();
            $audit->logAction('Modération : Approbation Carte', "Le SuperAdmin a validé la nouvelle publication de la carte ID {$id} ('{$item->titre}').");
        }
        return redirect()->back()->with('message', 'Nouvelle carte validée ! Elle est désormais visible de tous.');
    }

    public function reject($id)
    {
        $itemModel = new ItemModel();
        $item = $itemModel->find($id);

        if ($item) {
            $itemModel->update($id, ['is_public' => 0]); 
            
            $audit = new AuditLogModel();
            $audit->logAction('Modération : Refus Carte', "Le SuperAdmin a refusé la publication de la carte ID {$id} ('{$item->titre}'). Rétrogradation en privé.");
        }
        return redirect()->back()->with('error', "Nouvelle carte refusée. Elle est repassée en privé pour l'utilisateur.");
    }

    public function approveRevision($revisionId)
    {
        $revisionModel = new ItemRevisionModel();
        $itemModel = new ItemModel();
        $audit = new AuditLogModel();

        $revision = $revisionModel->find($revisionId);

        if ($revision && $revision['revision_status'] === 'pending') {
            
            $updateData = [
                'titre'       => $revision['titre'],
                'status'      => $revision['status'],
                'image'       => $revision['image'],
                'lien'        => $revision['lien'],
                'description' => $revision['description'],
                'episode'     => $revision['episode'],
                'saison'      => $revision['saison'],
                'date_sortie' => $revision['date_sortie'],
            ];

            $itemModel->update($revision['original_item_id'], $updateData);
            $revisionModel->update($revisionId, ['revision_status' => 'approved']);

            $audit->logAction('Modération : Approbation Draft', "Validation du Draft ID {$revisionId}. Les données de la carte publique ID {$revision['original_item_id']} ('{$revision['titre']}') ont été écrasées avec succès.");

            return redirect()->back()->with('message', 'La modification a été fusionnée et est maintenant en ligne.');
        }

        return redirect()->back()->with('error', 'Révision introuvable ou déjà traitée.');
    }

    public function rejectRevision($revisionId)
    {
        $revisionModel = new ItemRevisionModel();
        $revision = $revisionModel->find($revisionId);

        if ($revision) {
            $revisionModel->update($revisionId, ['revision_status' => 'rejected']);
            
            $audit = new AuditLogModel();
            $audit->logAction('Modération : Refus Draft', "Rejet du Draft ID {$revisionId} pour la carte ID {$revision['original_item_id']}. La version publique n'a pas été affectée.");
        }
        return redirect()->back()->with('error', 'La modification a été refusée.');
    }

    public function deadLinks()
    {
        $cronLogModel = new CronLogModel();
        
        $data = [
            'deadItems' => $cronLogModel->where('item_id IS NOT NULL')->findAll()
        ];

        return view('admin/items/dead_links', $data);
    }

    /**
     * NOUVEAUTÉ : Suppression d'une carte depuis le panneau d'administration
     */
    public function delete($id)
    {
        $itemModel = new ItemModel();
        $item = $itemModel->find($id);

        if ($item) {
            $titre = $item->titre;
            
            // Suppression de la carte principale
            $itemModel->delete($id);

            // Nettoyage immédiat de son alerte de lien mort indexée
            $cronLogModel = new CronLogModel();
            $cronLogModel->where('item_id', $id)->delete();

            // Journalisation de la suppression administrative
            $audit = new AuditLogModel();
            $audit->logAction('Modération : Suppression Carte', "Suppression définitive de la carte ID {$id} ('{$titre}') par l'administration depuis le rapport des erreurs 404.");

            return redirect()->back()->with('message', "La carte '{$titre}' a été définitivement supprimée.");
        }

        return redirect()->back()->with('error', 'Carte introuvable.');
    }
    
    /**
     * NOUVEAUTÉ : Remplacement d'un nom de domaine en masse
     */
    public function bulkUpdateDomain()
    {
        if ($this->request->is('post')) {
            $oldDomain = $this->request->getPost('old_domain');
            $newDomain = $this->request->getPost('new_domain');

            if (empty($oldDomain) || empty($newDomain)) {
                return redirect()->back()->with('error', 'Les deux champs de domaine sont requis.');
            }

            // On supprime les slashs de fin potentiels pour éviter les erreurs de formatage (/anime)
            $oldDomain = rtrim($oldDomain, '/');
            $newDomain = rtrim($newDomain, '/');

            $itemModel = new ItemModel();
            
            // On cherche toutes les cartes dont le lien contient l'ancien domaine
            $itemsToUpdate = $itemModel->like('lien', $oldDomain)->findAll();

            $count = 0;
            $cronLogModel = new CronLogModel();

            foreach ($itemsToUpdate as $item) {
                // Remplacement dynamique uniquement sur la portion du domaine
                $newLien = str_replace($oldDomain, $newDomain, $item->lien);
                
                // Mise à jour de la carte en base de données
                $itemModel->update($item->id, [
                    'lien' => $newLien,
                    'link_status' => 'ok' // On retire le flag "dead"
                ]);

                // On supprime l'alerte correspondante dans les logs du Cron
                $cronLogModel->where('item_id', $item->id)->delete();
                $count++;
            }

            if ($count > 0) {
                // Journalisation de sécurité
                $audit = new AuditLogModel();
                $audit->logAction('Maintenance : Remplacement en masse', "Migration du domaine '{$oldDomain}' vers '{$newDomain}' appliquée sur {$count} carte(s).");
                
                return redirect()->back()->with('message', "Succès : Le domaine a été remplacé sur {$count} carte(s). Les alertes ont été effacées.");
            } else {
                return redirect()->back()->with('error', "Aucune carte trouvée contenant le domaine '{$oldDomain}'.");
            }
        }
        
        return redirect()->back();
    }
}