<?php

namespace App\Controllers;

use App\Models\InviteModel;

class Anniversaire extends BaseController
{
    public function index($nom = 'Inconnu')
    {
        // On met une majuscule au prénom pour faire propre
        $nomFormatte = ucfirst(strtolower($nom));
        return view('anniversaire', ['nom' => $nomFormatte]);
    }

    public function confirmation()
    {
        $nom = $this->request->getPost('nom');
        // Récupération du nombre de tentatives (casté en entier par sécurité)
        $tentatives = (int) $this->request->getPost('tentatives_non');

        if (!empty($nom)) {
            $inviteModel = new \App\Models\InviteModel();
            
            $inviteModel->insert([
                'nom'            => $nom,
                'reponse'        => 'Oui',
                'tentatives_non' => $tentatives  // Enregistrement en base
            ]);

            return "Génial $nom ! C'est enregistré. Tu as essayé de cliquer sur 'Non' $tentatives fois, bel effort ! 🎉";
        }

        return redirect()->to('/anniversaire');
    }
}