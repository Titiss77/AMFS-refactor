<?php declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\ItemRevisionModel;

class ItemController extends BaseController
{
    /**
     * Affiche le tableau de bord des attentes (Nouvelles cartes + Révisions)
     */
    public function pending()
    {
        helper('text');
        
        $itemModel = new ItemModel();
        $revisionModel = new ItemRevisionModel();

        $data = [
            // Nouvelles cartes avec le statut 2 (En inspection)
            'pendingItems' => $itemModel->where('is_public', 2)->findAll(),
            
            // Modifications de cartes publiques en attente (Le "Drafting")
            'pendingRevisions' => $revisionModel->getPendingRevisions()
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
            
            // 1. On prépare les données pour écraser la carte originale
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

            // 2. On met à jour l'Item original
            $itemModel->update($revision['original_item_id'], $updateData);

            // 3. On marque la révision comme approuvée (ou on peut la supprimer avec delete())
            $revisionModel->update($revisionId, ['revision_status' => 'approved']);

            return redirect()->back()->with('message', 'La modification a été fusionnée et est maintenant en ligne.');
        }

        return redirect()->back()->with('error', 'Révision introuvable ou déjà traitée.');
    }

    public function rejectRevision($revisionId)
    {
        $revisionModel = new ItemRevisionModel();
        
        // On marque simplement la révision comme rejetée (ou on la supprime)
        $revisionModel->update($revisionId, ['revision_status' => 'rejected']);
        
        return redirect()->back()->with('error', 'La modification a été refusée.');
    }
}