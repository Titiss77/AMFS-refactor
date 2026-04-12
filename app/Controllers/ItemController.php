<?php declare(strict_types=1);

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
        $headers = $this->model->getHeaders();
        $divisions = $this->model->getDivisions();
        $item = null;

        if (null !== $id) {
            $item = $this->model->getItemById($id);

            // Si l'item n'appartient pas à l'utilisateur, on refuse l'accès
            if ($item && (int) $item['id_user'] !== (int) auth()->id()) {
                return redirect()->to('/')->with('error', 'Modification interdite.');
            }
        }

        return view('layout', ['headers' => $headers, 'divisions' => $divisions, 'item' => $item, 'view' => 'item_form']);
    }

    public function save()
    {
        if ($this->request->getMethod() === 'POST' || $this->request->getMethod() === 'post') {
            if (!auth()->loggedIn()) {
                return redirect()->to('login');
            }

            $id = $this->request->getPost('id');
            $id_user = auth()->id();

            // ... récupération des autres champs (titre, division, etc.) ...

            if ($id) {
                // Verifier la propriété avant l'update
                $existingItem = $this->model->getItemById($id);
                if ($existingItem && (int) $existingItem['id_user'] === (int) $id_user) {
                    $this->model->updateItem($id, $id_division, $titre, $lien, $description, $episode, $saison);
                }
            } else {
                $this->model->createItem($id_user, $id_division, $titre, $lien, $description, $episode, $saison);
            }

            return redirect()->to('/');
        }
    }

    // Fichier : Controllers/ItemController.php

    public function delete($id = null)
    {
        if (null !== $id) {
            $item = $this->model->getItemById($id);
            $userId = auth()->id();

            // Vérification : l'utilisateur doit être le propriétaire
            if ($item && (int) $item['id_user'] === (int) $userId) {
                $this->model->deleteItem($id);
            } else {
                // Optionnel : ajouter un message d'erreur flash
                return redirect()->back()->with('error', 'Action non autorisée.');
            }
        }

        return redirect()->to('/');
    }
}
