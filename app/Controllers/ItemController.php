<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ItemModel;
use App\Entities\Item;

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
            $data['item'] = $this->model->find($id);
            if ($data['item'] && (int) $data['item']->id_user !== (int) auth()->id()) {
                return redirect()->to('/')->with('error', 'Modification interdite.');
            }
        }
        return view('layout', $data);
    }

    public function save()
    {
        if ($this->request->is('post')) {
            if (!auth()->loggedIn()) return redirect()->to('login');

            // 1. Validation CI4
            $rules = [
                'titre' => 'required|max_length[100]',
                'id_division' => 'required|numeric',
                'status' => 'in_list[Aucun,À voir,En cours,En pause,Terminé]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'Erreur dans le formulaire.');
            }

            // 2. Traitement des données
            $item = new Item($this->request->getPost());
            $item->id_user = auth()->id();
            $item->is_public = $this->request->getPost('is_public') ? 1 : 0;
            
            $id = $this->request->getPost('id');

            // 3. Sauvegarde
            if ($id) {
                $existing = $this->model->find($id);
                if ($existing && (int) $existing->id_user === (int) auth()->id()) {
                    $this->model->save($item);
                }
            } else {
                $this->model->save($item);
            }

            return redirect()->back();
        }
    }

    public function delete($id = null)
    {
        if ($id !== null) {
            $item = $this->model->find($id);
            
            // Vérification des droits de l'utilisateur
            if ($item && (int) $item->id_user === (int) auth()->id()) {
                // Définition explicite du WHERE avant de supprimer
                $this->model->where('id', $id)->delete();
            }
        }
        return redirect()->back();
    }

    public function incrementEpisode($id)
    {
        if (!auth()->loggedIn()) return $this->response->setJSON(['success' => false]);
        
        $item = $this->model->find($id);
        if ($item && (int) $item->id_user === (int) auth()->id()) {
            $newEp = (string) ((int) $item->episode + 1);
            $this->model->update($id, ['episode' => $newEp]);
            return $this->response->setJSON(['success' => true, 'new_episode' => $newEp]);
        }
        return $this->response->setJSON(['success' => false]);
    }
}