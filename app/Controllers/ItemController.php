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
        $divisions = $this->model->getDivisions();
        $item = null;

        // Si on a un ID dans l'URL, on le récupère
        if (null !== $id) {
            $item = $this->model->getItemById($id);
        }

        return view('layout', ['divisions' => $divisions, 'item' => $item, 'view' => 'item_form']);
    }

    public function save()
    {
        if ($this->request->getMethod() === 'POST' || $this->request->getMethod() === 'post') {
            // On vérifie que l'utilisateur est bien connecté par sécurité supplémentaire
            if (!auth()->loggedIn()) {
                return redirect()->to('login');
            }

            $id = $this->request->getPost('id');
            $titre = $this->request->getPost('titre') ?? '';
            $id_division = $this->request->getPost('id_division') ?? 1;

            $lien = $this->request->getPost('lien') ?: null;
            $description = $this->request->getPost('description') ?: null;
            $saison = $this->request->getPost('saison') ?: null;
            $episode = $this->request->getPost('episode') ?: null;

            // NOUVEAU : On récupère l'ID du vrai compte utilisateur via Shield !
            $id_user = auth()->id();

            if ($id) {
                $this->model->updateItem($id, $id_division, $titre, $lien, $description, $episode, $saison);
            } else {
                $this->model->createItem($id_user, $id_division, $titre, $lien, $description, $episode, $saison);
            }

            return redirect()->to('/');
        }
    }

    public function delete($id = null)
    {
        if (null !== $id) {
            $this->model->deleteItem($id);
        }

        return redirect()->to('/');
    }
}
