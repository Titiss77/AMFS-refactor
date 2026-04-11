<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ItemModel;

class HomeController extends BaseController
{
    public function index()
    {
        $model = new ItemModel();
        $groupedItems = $model->getItemsGroupedByHeaderAndDivision();

        // En CI4, on pointe directement vers les noms des vues (sans l'extension .php ni le dossier views si on est déjà dedans)
        return view('layout', ['groupedItems' => $groupedItems, 'view' => 'home']);
    }
}