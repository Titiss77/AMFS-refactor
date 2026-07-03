<?php
// Controller/SystemController.php

require_once __DIR__ . '/../Model/SystemModel.php';

class SystemController
{
    public function index()
    {
        $model = new SystemModel();
        
        // 1. Récupération des données serveur
        $data = $model->getServerData();
        
        // 2. Récupération des données géo basées sur l'IP
        $geoData = $model->getIpGeolocation($data['ip_address']);
        
        // 3. Fusion des données pour les envoyer à la vue
        $viewData = array_merge($data, [
            'geo_city'    => $geoData['city'],
            'geo_country' => $geoData['country'],
            'geo_isp'     => $geoData['isp']
        ]);
        
        // 4. Chargement de la vue (extraction des variables du tableau)
        extract($viewData);
        require_once __DIR__ . '/../View/system_view.php';
    }
}