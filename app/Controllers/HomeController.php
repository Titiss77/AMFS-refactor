<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ItemModel;

class HomeController extends BaseController
{
    public function index()
    {
        $model = new ItemModel();
        
        // On vérifie si l'utilisateur est connecté
        if (auth()->loggedIn()) {
            // On récupère l'ID de l'utilisateur connecté via Shield
            $userId = auth()->id();
            $groupedItems = $model->getItemsGroupedByHeaderAndDivision($userId);
        } else {
            // S'il n'est pas connecté, on ne charge aucun item
            $groupedItems = [];
        }

        return view('layout', ['groupedItems' => $groupedItems, 'view' => 'home']);
    }
}