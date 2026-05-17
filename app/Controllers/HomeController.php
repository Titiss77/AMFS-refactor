<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ItemModel;

class HomeController extends BaseController
{
    public function index()
    {
        $model = new ItemModel();
        $headers = $model->getHeaders();

        if (!empty($headers)) {
            return redirect()->to('categorie/'.$headers[0]['id']);
        }

        return view('home', ['headers' => [], 'groupedItems' => []]);
    }

    public function categorie($headerId)
    {
        $model = new ItemModel();
        $userId = auth()->loggedIn() ? auth()->id() : null;

        $headers = $model->getHeaders();
        $groupedItems = $model->getItemsGroupedByHeaderAndDivision($userId, $headerId);

        // --- NOUVEAU : Compter les cartes en attente pour les admins ---
        $pendingCount = 0;
        if (auth()->loggedIn() && auth()->user()->inGroup('admin', 'superadmin')) {
            $pendingCount = $model->where('is_public', 2)->countAllResults();
        }
        // ---------------------------------------------------------------

        return view('home', [
            'headers' => $headers,
            'groupedItems' => $groupedItems,
            'currentHeaderId' => $headerId,
            'pendingCount' => $pendingCount, // On passe le compteur à la vue
        ]);
    }
}