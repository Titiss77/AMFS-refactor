<?php

class HomeController
{
    public function index()
    {
        // 1. Instancier le modèle
        $model = new ItemModel();
        
        // 2. Récupérer les données groupées
        $groupedItems = $model->getItemsGroupedByHeaderAndDivision();
        
        // 3. Charger la vue avec les données
        require_once 'views/layout.php';
    }
}