<?php declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItemModel;

class ItemController extends BaseController
{
    public function pending()
    {
        $itemModel = new ItemModel();

        $data = [
            // On récupère toutes les cartes avec le statut 2 (En inspection)
            'pendingItems' => $itemModel->where('is_public', 2)->findAll()
        ];

        return view('admin/items/pending', $data);
    }

    public function approve($id)
    {
        $itemModel = new ItemModel();
        $itemModel->update($id, ['is_public' => 1]);  // Valider
        return redirect()->back()->with('message', 'Carte validée ! Elle est désormais visible de tous.');
    }

    public function reject($id)
    {
        $itemModel = new ItemModel();
        $itemModel->update($id, ['is_public' => 0]);  // Refuser = repasser en privé
        return redirect()->back()->with('error', "Carte refusée. Elle est repassée en privé pour l'utilisateur.");
    }
}