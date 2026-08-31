<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategorieModel;
use App\Models\DonneeModel;

class Sommaire extends BaseController
{
    protected $categorieModel;
    protected $donneeModel;

    public function __construct()
    {
        // On initialise les modèles une seule fois pour tout le contrôleur
        $this->categorieModel = new CategorieModel();
        $this->donneeModel    = new DonneeModel();
    }

    // Affiche la liste (Ton code existant)
    public function index()
    {
        $categories = $this->categorieModel->findAll();
        $sommaire = [];

        foreach ($categories as $cat) {
            $liens = $this->donneeModel->where('idCateg', $cat['id'])->findAll();
            $sommaire[] = [
                'info_categorie' => $cat,
                'liens'          => $liens
            ];
        }

        return view('sommaire_view', ['sommaire' => $sommaire]);
    }

    // 1. Affiche le formulaire (pour AJOUTER ou MODIFIER)
    public function formulaire($id = null)
    {
        $data = [
            // On récupère toutes les catégories pour la liste déroulante
            'categories' => $this->categorieModel->findAll(),
            'lien'       => null
        ];

        // Si un ID est fourni, on est en mode MODIFICATION, on cherche le lien existant
        if ($id) {
            $data['lien'] = $this->donneeModel->find($id);
            if (!$data['lien']) {
                return redirect()->to('/')->with('error', 'Lien introuvable.');
            }
        }

        return view('form_view', $data);
    }

    // 2. Traite la soumission du formulaire (Sauvegarde)
    public function sauvegarder()
    {
        $id = $this->request->getPost('id'); // Récupère l'ID (caché dans le form)

        $data = [
            'nom'     => $this->request->getPost('nom'),
            'lien'    => $this->request->getPost('lien'),
            'temps'   => $this->request->getPost('temps'),
            'idCateg' => $this->request->getPost('idCateg'),
        ];

        if ($id) {
            // Mise à jour
            $this->donneeModel->update($id, $data);
            $msg = 'Lien modifié avec succès.';
        } else {
            // Création
            $this->donneeModel->insert($data);
            $msg = 'Lien ajouté avec succès.';
        }

        return redirect()->to('/')->with('message', $msg);
    }

    // 3. Supprime un lien
    public function supprimer($id)
    {
        $this->donneeModel->delete($id);
        return redirect()->to('/')->with('message', 'Lien supprimé.');
    }
}