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

    // Sauvegarder l'ajout ou la modification
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $titre = $_POST['titre'] ?? '';
            $lien = $_POST['lien'] ?? '';
            $description = $_POST['description'] ?? '';
            $episode = $_POST['episode'] ?? 'N/A';
            $id_division = $_POST['id_division'] ?? 1;
            
            // Pour l'exemple, on associe l'ajout à l'utilisateur ID 1
            $id_user = 1; 

            if ($id) {
                // Mise à jour
                $this->model->updateItem($id, $id_division, $titre, $lien, $description, $episode);
            } else {
                // Création
                $this->model->createItem($id_user, $id_division, $titre, $lien, $description, $episode);
            }

            // Redirection vers l'accueil après sauvegarde
            header("Location: index.php");
            exit();
        }
    }

    // Supprimer une carte
    public function delete()
    {
        if (isset($_GET['id'])) {
            $this->model->deleteItem($_GET['id']);
        }
        header("Location: index.php");
        exit();
    }
}