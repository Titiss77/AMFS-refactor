<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ItemModel;

class HomeController extends BaseController
{
    public function index()
    {
        $model = new ItemModel();
        
        // On récupère l'ID si connecté, sinon on laisse null
        $userId = auth()->loggedIn() ? auth()->id() : null;
        
        // Le modèle va maintenant nous renvoyer les cartes publiques + privées
        $groupedItems = $model->getItemsGroupedByHeaderAndDivision($userId);

        return view('layout', ['groupedItems' => $groupedItems, 'view' => 'home']);
    }
}