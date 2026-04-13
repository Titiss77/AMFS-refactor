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
        if ('POST' === $this->request->getMethod() || 'post' === $this->request->getMethod()) {
            // On vérifie que l'utilisateur est bien connecté par sécurité supplémentaire
            if (!auth()->loggedIn()) {
                return redirect()->to('login');
            }

            // --- IL MANQUAIT CES LIGNES ---
            $id = $this->request->getPost('id');
            $titre = $this->request->getPost('titre') ?? '';
            $id_division = $this->request->getPost('id_division') ?? 1;

            $lien = $this->request->getPost('lien') ?: null;
            $image = $this->request->getPost('img') ?: null;
            $description = $this->request->getPost('description') ?: null;
            $saison = $this->request->getPost('saison') ?: null;
            $episode = $this->request->getPost('episode') ?: null;
            // ------------------------------

            // On récupère l'ID du compte utilisateur connecté
            $id_user = auth()->id();

            if ($id) {
                // Verifier la propriété avant l'update
                $existingItem = $this->model->getItemById($id);
                if ($existingItem && (int) $existingItem['id_user'] === (int) $id_user) {
                    $this->model->updateItem($id, $id_division, $titre, $lien, $image, $description, $episode, $saison);
                }
            } else {
                // Si pas d'ID, on crée la carte
                $this->model->createItem($id_user, $id_division, $titre, $lien, $image, $description, $episode, $saison);
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