<?php declare(strict_types=1);

namespace App\Controllers;

use App\Models\ItemModel;

class HomeController extends BaseController
{
    public function index()
    {
        $model = new ItemModel();
        $headers = $model->getHeaders();

        // Redirection automatique vers le premier onglet s'il existe
        if (!empty($headers)) {
            return redirect()->to('categorie/' . $headers[0]['id']);
        }

        // Si aucune catégorie n'existe en base de données
        return view('layout', ['headers' => [], 'groupedItems' => [], 'view' => 'home']);
    }

    public function categorie($headerId)
    {
        $model = new ItemModel();
        $userId = auth()->loggedIn() ? auth()->id() : null;

        // On récupère toutes les catégories pour construire le menu
        $headers = $model->getHeaders();

        // On récupère les items UNIQUEMENT pour la catégorie sélectionnée
        $groupedItems = $model->getItemsGroupedByHeaderAndDivision($userId, $headerId);

        return view('layout', [
            'headers' => $headers,
            'groupedItems' => $groupedItems,
            'currentHeaderId' => $headerId,  // Permet de savoir quel onglet colorer
            'view' => 'home'
        ]);
    }
}
