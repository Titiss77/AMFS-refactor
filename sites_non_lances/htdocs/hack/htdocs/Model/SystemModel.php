<?php
// Model/SystemModel.php

class SystemModel
{
    public function getServerData()
    {
        return [
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'Inconnue',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Inconnu',
            'languages'  => $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'Non spécifié',
        ];
    }

    public function getIpGeolocation($ip)
    {
        // Pour les tests en local (localhost), on utilise une IP publique arbitraire
        $ip_to_check = ($ip === '::1' || $ip === '127.0.0.1') ? '8.8.8.8' : $ip;
        
        $url = "http://ip-api.com/json/{$ip_to_check}";
        
        // On désactive les alertes si l'API est injoignable
        $response = @file_get_contents($url);
        
        if ($response) {
            $data = json_decode($response, true);
            return [
                'city'    => $data['city'] ?? 'Inconnue',
                'country' => $data['country'] ?? 'Inconnu',
                'isp'     => $data['isp'] ?? 'Inconnu'
            ];
        }
        
        return ['city' => 'Erreur', 'country' => 'Erreur', 'isp' => 'Erreur'];
    }
}