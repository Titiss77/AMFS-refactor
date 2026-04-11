<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ItemModel;

class HomeController extends BaseController
{
    public function index()
    {
        // 1. Instancier le modèle
        $model = new ItemModel();

        // 2. Récupérer les données groupées
        $groupedItems = $model->getItemsGroupedByHeaderAndDivision();

        // 3. Charger la vue avec les données
        return view('views/layout.php', ['groupedItems' => $groupedItems]);
    }
}