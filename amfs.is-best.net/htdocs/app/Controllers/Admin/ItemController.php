<?php declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\ItemRevisionModel;

class ItemController extends BaseController
{
    /**
     * Affiche le tableau de bord des attentes (Nouvelles cartes + Révisions avec Diff)
     */
    public function pending()
    {
        helper('text');

        $itemModel = new ItemModel();
        $revisionModel = new ItemRevisionModel();

        $revisions = $revisionModel->getPendingRevisions();

        // Analyse des différences pour chaque révision
        foreach ($revisions as &$revision) {
            $original = $itemModel->asArray()->find($revision['original_item_id']);
            $changes = [];

            // Liste des champs à surveiller et leur équivalent lisible
            $fieldsToCompare = [
                'titre' => 'Titre',
                'status' => 'Statut',
                'image' => 'Image / Couverture',
                'lien' => 'Lien de visionnage/lecture',
                'description' => 'Description',
                'episode' => 'Épisode',
                'saison' => 'Saison',
                'date_sortie' => 'Date de sortie'
            ];

            if ($original) {
                foreach ($fieldsToCompare as $field => $label) {
                    $oldValue = $original[$field] ?? '';
                    $newValue = $revision[$field] ?? '';

                    // Normalisation pour éviter les faux positifs sur les dates
                    if ($field === 'date_sortie' && (!empty($oldValue) || !empty($newValue))) {
                        $oldValue = $oldValue ? substr((string) $oldValue, 0, 10) : '';
                        $newValue = $newValue ? substr((string) $newValue, 0, 10) : '';
                    }

                    // Si les chaînes sont différentes, on enregistre la modification
                    if ((string) $oldValue !== (string) $newValue) {
                        $changes[] = [
                            'field' => $field,
                            'label' => $label,
                            'old' => $oldValue,
                            'new' => $newValue
                        ];
                    }
                }
            }

            $revision['changes'] = $changes;
        }

        $data = [
            // Nouvelles cartes avec le statut 2 (En inspection)
            'pendingItems' => $itemModel->where('is_public', 2)->findAll(),
            // Modifications de cartes publiques enrichies des changements calculés
            'pendingRevisions' => $revisions
        ];

        return view('admin/items/pending', $data);
    }

    // =========================================================================
    // GESTION DES NOUVELLES CARTES (is_public = 2)
    // =========================================================================

    public function approve($id)
    {
        $itemModel = new ItemModel();
        $itemModel->update($id, ['is_public' => 1]);
        return redirect()->back()->with('message', 'Nouvelle carte validée ! Elle est désormais visible de tous.');
    }

    public function reject($id)
    {
        $itemModel = new ItemModel();
        $itemModel->update($id, ['is_public' => 0]);
        return redirect()->back()->with('error', "Nouvelle carte refusée. Elle est repassée en privé pour l'utilisateur.");
    }

    // =========================================================================
    // GESTION DES RÉVISIONS / DRAFTS (item_revisions)
    // =========================================================================

    public function approveRevision($revisionId)
    {
        $revisionModel = new ItemRevisionModel();
        $itemModel = new ItemModel();

        $revision = $revisionModel->find($revisionId);

        if ($revision && $revision['revision_status'] === 'pending') {
            $updateData = [
                'titre' => $revision['titre'],
                'status' => $revision['status'],
                'image' => $revision['image'],
                'lien' => $revision['lien'],
                'description' => $revision['description'],
                'episode' => $revision['episode'],
                'saison' => $revision['saison'],
                'date_sortie' => $revision['date_sortie'],
            ];

            $itemModel->update($revision['original_item_id'], $updateData);
            $revisionModel->update($revisionId, ['revision_status' => 'approved']);

            return redirect()->back()->with('message', 'La modification a été fusionnée et est maintenant en ligne.');
        }

        return redirect()->back()->with('error', 'Révision introuvable ou déjà traitée.');
    }

    public function rejectRevision($revisionId)
    {
        $revisionModel = new ItemRevisionModel();
        $revisionModel->update($revisionId, ['revision_status' => 'rejected']);

        return redirect()->back()->with('error', 'La modification a été refusée.');
    }
}
