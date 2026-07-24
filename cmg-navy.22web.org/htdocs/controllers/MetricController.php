<?php
require_once 'models/MetricModel.php';

class MetricController
{
    private $model;

    public function __construct()
    {
        $this->model = new MetricModel();
    }

    public function index()
    {
        $id_user = $_SESSION['user_id']; // <-- Récupération de l'ID
        $history = $this->model->getAllHistory($id_user); // <-- Passage de l'ID au modèle
        require 'views/calculator_view.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification de sécurité supplémentaire
            if (!isset($_SESSION['user_id'])) {
                header('Location: index.php?action=login');
                exit();
            }

            // Récupération et nettoyage
            $id_user = $_SESSION['user_id']; // <-- AJOUT : ID de l'utilisateur connecté
            $gender = $_POST['gender'];
            $height = (float) str_replace(',', '.', $_POST['height']);
            $weight = (float) str_replace(',', '.', $_POST['weight']);
            $neck = (float) str_replace(',', '.', $_POST['neck']);
            $waist = (float) str_replace(',', '.', $_POST['waist']);
            $hip = isset($_POST['hip']) && $_POST['hip'] !== '' ? (float) str_replace(',', '.', $_POST['hip']) : 0;
            $activity = (float) $_POST['activity'];

            // Recalcul backend
            $density = 0;
            if ($gender === 'male') {
                $density = 1.0324 - 0.19077 * log10($waist - $neck) + 0.15456 * log10($height);
            } else {
                $density = 1.29579 - 0.35004 * log10($waist + $hip - $neck) + 0.221 * log10($height);
            }
            $bodyFat = max(0, (495 / $density) - 450);
            $fatMass = $weight * ($bodyFat / 100);
            $leanMass = $weight - $fatMass;
            $bmr = 370 + (21.6 * $leanMass);
            $tdee = $bmr * $activity;

            // Préparation des données pour le Model (avec :id_user)
            $data = [
                ':id_user' => $id_user, // <-- AJOUT
                ':gender' => $gender,
                ':height' => $height,
                ':weight' => $weight,
                ':neck' => $neck,
                ':waist' => $waist,
                ':hip' => $gender === 'female' ? $hip : null,
                ':activity' => $activity,
                ':body_fat' => round($bodyFat, 2),
                ':fat_mass' => round($fatMass, 2),
                ':lean_mass' => round($leanMass, 2),
                ':bmr' => round($bmr),
                ':tdee' => round($tdee)
            ];

            $this->model->insertMetric($data);

            header('Location: index.php');
            exit();
        }
    }
}