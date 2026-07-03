<?php

namespace App\Controllers;

class SystemInfo extends BaseController
{
    public function index()
    {
        // Chargement du service User Agent de CodeIgniter
        $agent = $this->request->getUserAgent();

        // Récupérer l'IP
        $ip = $this->request->getIPAddress();

        // (Optionnel) Pour tester en local, on force une IP publique (ex: Google) car 127.0.0.1 ne donnera rien
        $ip_to_check = ($ip === '::1' || $ip === '127.0.0.1') ? '8.8.8.8' : $ip;

        // Appel à une API de géolocalisation
        $geoUrl = "http://ip-api.com/json/{$ip_to_check}";
        $geoResponse = @file_get_contents($geoUrl);
        $geoData = $geoResponse ? json_decode($geoResponse, true) : null;

        // On ajoute les infos géo dans les données de la vue
        $data['geo_city'] = $geoData['city'] ?? 'Inconnue';
        $data['geo_country'] = $geoData['country'] ?? 'Inconnu';
        $data['geo_isp'] = $geoData['isp'] ?? 'Inconnu';

        // Préparation des données pour la vue
        $data = [
            'ip_address' => $this->request->getIPAddress(),
            'browser' => $agent->getBrowser() . ' ' . $agent->getVersion(),
            'platform' => $agent->getPlatform(),
            'full_string' => $agent->getAgentString(),
            'languages' => implode(', ', $this->request->getHeaderLine('accept-language') ? explode(',', $this->request->getHeaderLine('accept-language')) : ['Non spécifié']),
            'geo_city' => $data['geo_city'],
            'geo_country' => $data['geo_country'],
            'geo_isp' => $data['geo_isp']
        ];

        // Appel de la vue en lui passant les données
        return view('system_info_view', $data);
    }
}