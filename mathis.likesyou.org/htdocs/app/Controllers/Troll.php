<?php

namespace App\Controllers;

use App\Models\InviteModel;

class Troll extends BaseController
{
    public function index($nom = 'Inconnu')
    {
        // On met une majuscule au prénom pour faire propre
        $nomFormatte = ucfirst(strtolower($nom));
        return view('troll', ['nom' => $nomFormatte]);
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

        return redirect()->to('/troll');
    }

    public function resultats()
    {
        // 1. Définir les IP autorisées
        // '::1' et '127.0.0.1' correspondent à ton accès local sur XAMPP.
        // Quand tu mettras ton site en ligne, ajoute ton adresse IP publique ici.
        $ipsAutorisees = [
            '::1', 
            '127.0.0.1',
            // 'TON.IP.PUBLIQUE.ICI'
        ];

        // 2. Récupérer l'IP du visiteur
        $ipVisiteur = $this->request->getIPAddress();

        // 3. Vérifier si l'IP est dans la liste
        if (!in_array($ipVisiteur, $ipsAutorisees, true)) {
            // Si l'IP n'est pas bonne, on bloque l'accès
            // Petite astuce : tu peux afficher l'IP bloquée pour t'aider à la configurer
            return $this->response->setStatusCode(403)
                                  ->setBody("<h1>Accès refusé</h1><p>Tu n'es pas l'administrateur. (Ton IP : $ipVisiteur)</p>");
        }

        // 4. L'IP est bonne, on récupère les résultats
        $inviteModel = new \App\Models\InviteModel();
        
        // On récupère tout, trié du plus récent au plus ancien
        $donnees['invites'] = $inviteModel->orderBy('created_at', 'DESC')->findAll();
        $donnees['mon_ip']  = $ipVisiteur;

        return view('resultats', $donnees);
    }
}