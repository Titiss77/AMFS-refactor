<?php

namespace App\Controllers;

use App\Models\CarteModel;

class CartesController extends BaseController
{
    protected $carteModel;

    public function __construct()
    {
        $this->carteModel = new CarteModel();
    }

    // AFFICHER LA PAGE PRINCIPALE
    public function index()
    {
        // On récupère toutes les cartes
        $data['cartes'] = $this->carteModel->findAll();
        
        return view('index', $data);
    }

    // AJOUTER UNE CARTE (Traitement du formulaire)
    public function create()
    {
        $this->carteModel->save([
            'libelle'      => $this->request->getPost('libelle'),
            'description'  => $this->request->getPost('description'),
            'url_path'     => $this->request->getPost('url_path'),
            'img_path'     => $this->request->getPost('img_path'),
            'categorie_id' => 1, // À dynamiser plus tard avec un <select>
            'section_id'   => 1  // À dynamiser plus tard avec un <select>
        ]);

        return redirect()->to('/')->with('message', 'Carte ajoutée avec succès !');
    }

    // MODIFIER UNE CARTE
    public function update($id)
    {
        $this->carteModel->update($id, [
            'libelle'      => $this->request->getPost('libelle'),
            'description'  => $this->request->getPost('description'),
            'url_path'     => $this->request->getPost('url_path'),
            'img_path'     => $this->request->getPost('img_path')
        ]);

        return redirect()->to('/')->with('message', 'Carte modifiée avec succès !');
    }

    // SUPPRIMER UNE CARTE
    public function delete($id)
    {
        $this->carteModel->delete($id);
        return redirect()->to('/')->with('message', 'Carte supprimée !');
    }
}