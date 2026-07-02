<?php

namespace App\Controllers;

class Anniversaire extends BaseController
{
    public function index()
    {
        return view('anniversaire');
    }

    public function confirmation()
    {
        // Tu pourras ajouter ici la logique pour sauvegarder la réponse en base de données
        return "Génial ! Prépare-toi bien, on va fêter ça ! 🎉";
    }
}