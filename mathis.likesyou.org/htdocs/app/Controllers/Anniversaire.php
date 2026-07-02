<?php

namespace App\Controllers;

use App\Models\InviteModel;

class Anniversaire extends BaseController
{
    public function index()
    {
        return view('anniversaire');
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
                'tentatives_non' => $tentatives // Enregistrement en base 👇
            ]);

            return "Génial $nom ! C'est enregistré. Tu as essayé de cliquer sur 'Non' $tentatives fois, bel effort ! 🎉";
        }

        return redirect()->to('/anniversaire');
    }
}