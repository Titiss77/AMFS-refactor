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

        if (!empty($nom)) {
            $inviteModel = new InviteModel();
            
            // On sauvegarde le grand gagnant
            $inviteModel->insert([
                'nom'     => $nom,
                'reponse' => 'Oui' // Toujours oui !
            ]);

            return "Génial $nom ! C'est enregistré dans la base de données. Prépare-toi bien ! 🎉";
        }

        return redirect()->to('/anniversaire');
    }
}