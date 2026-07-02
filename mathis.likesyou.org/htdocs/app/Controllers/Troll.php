<?php

namespace App\Controllers;

use App\Models\InviteModel;

class Troll extends BaseController
{
    // 1. On centralise la vérification de l'IP ici
    private function estAdmin(): bool
    {
        $ipsAutorisees = [
            '::1', 
            '127.0.0.1',
            // 'TON.IP.PUBLIQUE.ICI'
        ];

        return in_array($this->request->getIPAddress(), $ipsAutorisees, true);
    }

    public function index($nom = 'Inconnu')
    {
        $nomFormatte = ucfirst(strtolower($nom));
        
        // 2. On envoie l'information "est-ce un admin ?" à la vue
        return view('troll', [
            'nom'      => $nomFormatte,
            'estAdmin' => $this->estAdmin() 
        ]);
    }

    public function confirmation()
    {
        $nom = $this->request->getPost('nom');
        $tentatives = (int) $this->request->getPost('tentatives_non');

        if (!empty($nom)) {
            $inviteModel = new \App\Models\InviteModel();
            
            $inviteModel->insert([
                'nom'            => $nom,
                'reponse'        => 'Oui',
                'tentatives_non' => $tentatives
            ]);

            return "Génial $nom ! C'est enregistré. Tu as essayé de cliquer sur 'Non' $tentatives fois, bel effort ! 🎉";
        }

        return redirect()->to('/troll');
    }

    public function resultats()
    {
        // 3. On réutilise notre fonction ici pour sécuriser la page
        if (!$this->estAdmin()) {
            $ipVisiteur = $this->request->getIPAddress();
            return $this->response->setStatusCode(403)
                                  ->setBody("<h1>Accès refusé</h1><p>Tu n'es pas l'administrateur. (Ton IP : $ipVisiteur)</p>");
        }

        $inviteModel = new \App\Models\InviteModel();
        
        $donnees['invites'] = $inviteModel->orderBy('created_at', 'DESC')->findAll();
        $donnees['mon_ip']  = $this->request->getIPAddress();

        return view('resultats', $donnees);
    }
}