<?php
require_once 'src/Models/ItemModel.php';

class ItemController
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

        require_once 'views/layout.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $titre = $_POST['titre'] ?? '';
            $lien = $_POST['lien'] ?? '';
            $description = $_POST['description'] ?? '';
            $saison = $_POST['saison'] ?? '1';  // Ajout de la saison
            $episode = $_POST['episode'] ?? '1';
            $id_division = $_POST['id_division'] ?? 1;

            $id_user = 1;

            if ($id) {
                // On ajoute la saison ici
                $this->model->updateItem($id, $id_division, $titre, $lien, $description, $episode, $saison);
            } else {
                // Et ici aussi
                $this->model->createItem($id_user, $id_division, $titre, $lien, $description, $episode, $saison);
            }

            header('Location: index.php');
            exit();
        }
    }

    // Supprimer une carte
    public function delete()
    {
        if (isset($_GET['id'])) {
            $this->model->deleteItem($_GET['id']);
        }
        header('Location: index.php');
        exit();
    }
}
