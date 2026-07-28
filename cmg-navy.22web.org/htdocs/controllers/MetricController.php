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
        $id_user = $_SESSION['user_id'];
        $history = $this->model->getAllHistory($id_user);
        require 'views/calculator_view.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                $this->sendJson(['success' => false, 'message' => 'Non authentifié.']);
            }
            if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                $this->sendJson(['success' => false, 'message' => 'Token de sécurité invalide.']);
            }

            // 1. Récupération de l'ID si on est en mode édition
            $id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;
            
            // 2. Récupération sécurisée des données
            $id_user = $_SESSION['user_id'];
            $gender = $_POST['gender'] ?? 'male';
            $height = (float) str_replace(',', '.', $_POST['height'] ?? 0);
            $weight = (float) str_replace(',', '.', $_POST['weight'] ?? 0);
            $neck = (float) str_replace(',', '.', $_POST['neck'] ?? 0);
            $waist = (float) str_replace(',', '.', $_POST['waist'] ?? 0);
            $hip = isset($_POST['hip']) && $_POST['hip'] !== '' ? (float) str_replace(',', '.', $_POST['hip']) : 0;
            $activity = (float) ($_POST['activity'] ?? 1.2);
            $isAthlete = isset($_POST['is_athlete']) && $_POST['is_athlete'] == '1';

            // Gestion de la date de mesure
            $createdAt = isset($_POST['created_at']) && !empty($_POST['created_at'])
                ? $_POST['created_at'] . ' ' . date('H:i:s')
                : date('Y-m-d H:i:s');

            // 3. Protection du serveur contre les erreurs mathématiques (log10)
            if ($height <= 0 || $waist <= 0 || $neck <= 0) {
                 $this->sendJson(['success' => false, 'message' => 'Mensurations invalides ou incomplètes.']);
            }

            // 4. Calculs des métriques
            $density = 0;
            if ($gender === 'male') {
                $diff = $waist - $neck;
                if ($diff <= 0) { 
                    $this->sendJson(['success' => false, 'message' => 'Le tour de taille doit être supérieur au cou.']); 
                }
                $density = 1.0324 - 0.19077 * log10($diff) + 0.15456 * log10($height);
            } else {
                $diff = $waist + $hip - $neck;
                if ($diff <= 0) { 
                    $this->sendJson(['success' => false, 'message' => 'Mensurations invalides pour le calcul.']); 
                }
                $density = 1.29579 - 0.35004 * log10($diff) + 0.221 * log10($height);
            }

            $bodyFat = max(0, (495 / $density) - 450);

            // Correction athlétique
            if ($isAthlete) {
                $minFat = $gender === 'male' ? 4.0 : 12.0;
                $bodyFat = max($minFat, $bodyFat - 1.5);
            }

            $fatMass = $weight * ($bodyFat / 100);
            $leanMass = $weight - $fatMass;
            $bmr = 370 + (21.6 * $leanMass);
            $tdee = $bmr * $activity;

            // 5. Préparation des données pour SQL
            $data = [
                ':id_user' => $id_user,
                ':gender' => $gender,
                ':height' => $height,
                ':weight' => $weight,
                ':neck' => $neck,
                ':waist' => $waist,
                ':hip' => $gender === 'female' ? $hip : null,
                ':activity' => $activity,
                ':is_athlete' => $isAthlete ? 1 : 0,
                ':body_fat' => round($bodyFat, 2),
                ':fat_mass' => round($fatMass, 2),
                ':lean_mass' => round($leanMass, 2),
                ':bmr' => round($bmr),
                ':tdee' => round($tdee),
                ':created_at' => $createdAt
            ];

            // 6. Exécution : UPDATE si un ID est présent, sinon INSERT
            if ($id) {
                $data[':id'] = $id;
                if ($this->model->updateMetric($data)) {
                    $this->sendJson(['success' => true, 'message' => 'Mesure mise à jour avec succès.']);
                } else {
                    $this->sendJson(['success' => false, 'message' => 'Erreur SQL lors de la mise à jour.']);
                }
            } else {
                if ($this->model->insertMetric($data)) {
                    $this->sendJson(['success' => true, 'message' => 'Mesure sauvegardée avec succès.']);
                } else {
                    $this->sendJson(['success' => false, 'message' => 'Erreur SQL lors de la sauvegarde.']);
                }
            }
        }
    }

    public function exportCSV()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }
        $id_user = $_SESSION['user_id'];
        $history = $this->model->getAllHistory($id_user);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=historique_metriques.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Date', 'Poids (kg)', 'Masse Grasse (%)', 'Masse Maigre (kg)', 'TDEE (kcal)']);

        foreach ($history as $row) {
            fputcsv($output, [
                $row['created_at'],
                $row['weight'],
                $row['body_fat'],
                $row['lean_mass'],
                $row['tdee']
            ]);
        }
        fclose($output);
        exit();
    }

    private function sendJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                $this->sendJson(['success' => false, 'message' => 'Non authentifié.']);
            }

            $id = $_POST['id'] ?? null;
            $id_user = $_SESSION['user_id'];

            if ($id && $this->model->deleteMetric($id, $id_user)) {
                $this->sendJson(['success' => true, 'message' => 'Mesure supprimée avec succès.']);
            } else {
                $this->sendJson(['success' => false, 'message' => 'Erreur lors de la suppression.']);
            }
        }
    }
}