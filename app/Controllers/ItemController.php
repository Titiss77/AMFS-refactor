<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ItemModel;

class ItemController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new ItemModel();
    }

    public function form($id = null)
    {
        $data = [
            'headers' => $this->model->getHeaders(),
            'divisions' => $this->model->getDivisions(),
            'item' => null,
            'view' => 'item_form'
        ];

        if ($id !== null) {
            $data['item'] = $this->model->find($id); // Remplacé getItemById par find()

            if ($data['item'] && (int) $data['item']['id_user'] !== (int) auth()->id()) {
                return redirect()->to('/')->with('error', 'Modification interdite.');
            }
        }

        return view('layout', $data);
    }

    public function save()
    {
        if ($this->request->is('post')) {
            if (!auth()->loggedIn()) {
                return redirect()->to('login');
            }

            // 1. VALIDATION DE SÉCURITÉ
            $rules = [
                'titre' => 'required|max_length[100]',
                'id_division' => 'required|numeric'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'Vérifiez vos champs obligatoires.');
            }

            // 2. RÉCUPÉRATION DES DONNÉES
            $data = $this->request->getPost();
            $data['id_user'] = auth()->id(); // Force l'assignation à l'utilisateur actuel
            
            // Si la case is_public n'est pas cochée, elle n'est pas envoyée par le formulaire
            $data['is_public'] = $this->request->getPost('is_public') ? 1 : 0;

            $id = $this->request->getPost('id');

            // 3. SAUVEGARDE (INSERT OU UPDATE AUTO)
            if ($id) {
                $existingItem = $this->model->find($id);
                if ($existingItem && (int) $existingItem['id_user'] === (int) auth()->id()) {
                    $this->model->save($data); // UPDATE auto de CodeIgniter
                } else {
                    return redirect()->to('/')->with('error', 'Action non autorisée.');
                }
            } else {
                $this->model->save($data); // INSERT auto de CodeIgniter
            }

            return redirect()->to('/');
        }
    }

    public function delete($id = null)
    {
        if ($id !== null) {
            $item = $this->model->find($id);
            if ($item && (int) $item['id_user'] === (int) auth()->id()) {
                $this->model->delete($id); // Méthode native CodeIgniter
            }
        }
        return redirect()->to('/');
    }

    // --- NOUVELLE FONCTIONNALITÉ : BOUTON +1 ÉPISODE EN AJAX ---
    public function incrementEpisode($id)
    {
        if (!auth()->loggedIn()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Non connecté']);
        }

        $item = $this->model->find($id);
        
        if ($item && (int) $item['id_user'] === (int) auth()->id()) {
            // On s'assure de récupérer un nombre, on l'incrémente, puis on repasse en string
            $currentEp = (int) $item['episode'];
            $newEp = (string) ($currentEp + 1);
            
            // Mise à jour ciblée
            $this->model->update($id, ['episode' => $newEp]);

            return $this->response->setJSON(['success' => true, 'new_episode' => $newEp]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Non autorisé']);
    }
}