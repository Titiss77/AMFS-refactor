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

    // Afficher le formulaire (Ajout ou Modification)
    public function form()
    {
        $divisions = $this->model->getDivisions();
        $item = null;

        // Si on a un ID, on est en mode "Modification"
        if (isset($_GET['id'])) {
            $item = $this->model->getItemById($_GET['id']);
        }

        return view('views/layout.php', ['divisions' => $divisions, 'item' => $item, 'view' => 'item_form']);
    }

    // Sauvegarder l'ajout ou la modification
    public function save()
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $id = $_POST['id'] ?? null;
            $titre = $_POST['titre'] ?? '';
            $id_division = $_POST['id_division'] ?? 1;

            // --- GESTION DES CHAMPS VIDES (Transformation en NULL) ---

            $lien = $_POST['lien'] ?? '';
            if ('' === $lien) {
                $lien = null;
            }

            $description = $_POST['description'] ?? '';
            if ('' === $description) {
                $description = null;
            }

            $saison = $_POST['saison'] ?? '';
            if ('' === $saison) {
                $saison = null;
            }

            $episode = $_POST['episode'] ?? '';
            if ('' === $episode) {
                $episode = null;
            }

            // ---------------------------------------------------------

            // Pour l'exemple, on associe l'ajout à l'utilisateur ID 1
            $id_user = 1;

            if ($id) {
                // Mise à jour
                $this->model->updateItem($id, $id_division, $titre, $lien, $description, $episode, $saison);
            } else {
                // Création
                $this->model->createItem($id_user, $id_division, $titre, $lien, $description, $episode, $saison);
            }

            // Redirection vers l'accueil après sauvegarde
            header('Location: index.php');

            exit;
        }
    }

    // Supprimer une carte
    public function delete()
    {
        if (isset($_GET['id'])) {
            $this->model->deleteItem($_GET['id']);
        }
        header('Location: index.php');

        exit;
    }
}