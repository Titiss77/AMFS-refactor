<?php

namespace App\Controllers;

use App\Models\InviteModel;

class Troll extends BaseController
{
    // On centralise la vérification de l'IP ici
    private function estAdmin(): bool
    {
        $ipsAutorisees = [
            '::1',
            '127.0.0.1',
            '5.49.246.18',  // Mon IP locale
            '104.28.30.16',
            // Ajoute ton IP publique ici quand le site sera en ligne
        ];

        return in_array($this->request->getIPAddress(), $ipsAutorisees, true);
    }

    public function index($nom = 'Inconnu', $question = 'Accepte-tu de me pardonner')
    {
        $nomFormatte = ucfirst(strtolower($nom));

        // On remplace les underscores par des espaces pour avoir des liens propres
        // ex: /troll/Mathis/Tu_veux_un_kebab_?
        $questionFormattee = str_replace('_', ' ', urldecode($question));

        return view('troll', [
            'nom' => $nomFormatte,
            'question' => $questionFormattee,
            'estAdmin' => $this->estAdmin()
        ]);
    }

    public function confirmation()
    {
        $nom = $this->request->getPost('nom');
        $question = $this->request->getPost('question');
        $tentatives = (int) $this->request->getPost('tentatives_non');

        if (!empty($nom)) {
            $inviteModel = new \App\Models\InviteModel();

            $inviteModel->insert([
                'nom' => $nom,
                'question' => $question,
                'reponse' => 'Oui',
                'tentatives_non' => $tentatives
            ]);

            return view('confirmation', [
                'nom' => $nom,
                'tentatives' => $tentatives
            ]);
        }
        return redirect()->to('/troll');
    }

    public function resultats()
    {
        // On réutilise notre fonction ici pour sécuriser la page des résultats
        if (!$this->estAdmin()) {
            $ipVisiteur = $this->request->getIPAddress();
            return $this
                ->response
                ->setStatusCode(403)
                ->setBody("<h1>Accès refusé</h1><p>Tu n'es pas l'administrateur. (Ton IP : $ipVisiteur)</p>");
        }

        $inviteModel = new \App\Models\InviteModel();

        $donnees['invites'] = $inviteModel->orderBy('created_at', 'DESC')->findAll();
        $donnees['mon_ip'] = $this->request->getIPAddress();

        return view('resultats', $donnees);
    }
}