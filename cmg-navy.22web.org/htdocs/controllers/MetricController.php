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
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if (!isset($_SESSION['user_id'])) {
                $this->sendJson(['success' => false, 'message' => 'Non authentifié.']);
            }
            if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                $this->sendJson(['success' => false, 'message' => 'Token de sécurité invalide.']);
            }

            $id = isset($_POST['id']) && !empty($_POST['id']) ? (int) $_POST['id'] : null;
            $id_user = $_SESSION['user_id'];

            $gender = $_POST['gender'] ?? 'male';
            $height = (float) str_replace(',', '.', $_POST['height'] ?? 0);
            $weight = (float) str_replace(',', '.', $_POST['weight'] ?? 0);
            $neck = (float) str_replace(',', '.', $_POST['neck'] ?? 0);
            $waist = (float) str_replace(',', '.', $_POST['waist'] ?? 0);
            $hip = isset($_POST['hip']) && '' !== $_POST['hip'] ? (float) str_replace(',', '.', $_POST['hip']) : 0;
            $activity = (float) ($_POST['activity'] ?? 1.2);
            $isAthlete = isset($_POST['is_athlete']) && '1' == $_POST['is_athlete'];

            $createdAt = isset($_POST['created_at']) && !empty($_POST['created_at'])
                ? $_POST['created_at'].' '.date('H:i:s')
                : date('Y-m-d H:i:s');

            if ($height <= 0 || $waist <= 0 || $neck <= 0) {
                $this->sendJson(['success' => false, 'message' => 'Mensurations invalides ou incomplètes.']);
            }

            // --- NOUVEAU MODÈLE HYBRIDE SCIENTIFIQUE ---
            $diff = 0;
            if ('male' === $gender) {
                $diff = $waist - $neck;
                if ($diff <= 0) {
                    $this->sendJson(['success' => false, 'message' => 'Le tour de taille doit être supérieur au cou.']);
                }
                $lbmBoer = (0.407 * $weight) + (0.267 * $height) - 19.2;
                if ($isAthlete) {
                    $lbmBoer *= 1.08;
                }
                $density = 1.0324 - 0.19077 * log10($diff) + 0.15456 * log10($height);
            } else {
                $diff = $waist + $hip - $neck;
                if ($diff <= 0) {
                    $this->sendJson(['success' => false, 'message' => 'Mensurations invalides pour le calcul.']);
                }
                $lbmBoer = (0.252 * $weight) + (0.473 * $height) - 48.3;
                if ($isAthlete) {
                    $lbmBoer *= 1.05;
                }
                $density = 1.29579 - 0.35004 * log10($diff) + 0.221 * log10($height);
            }

            $bfNavy = max(0, (495 / $density) - 450);
            $lbmNavy = $weight * (1 - ($bfNavy / 100));

            $leanMass = ($lbmBoer + $lbmNavy) / 2;

            $minFatPercent = 'male' === $gender ? 3.0 : 10.0;
            $maxLbm = $weight * (1 - ($minFatPercent / 100));
            $leanMass = min($maxLbm, max($weight * 0.4, $leanMass));

            $fatMass = $weight - $leanMass;
            $bodyFat = ($fatMass / $weight) * 100;

            $bmr = 370 + (21.6 * $leanMass);
            $tdee = $bmr * $activity;
            // --------------------------------------------

            $data = [
                ':id_user' => $id_user,
                ':gender' => $gender,
                ':height' => $height,
                ':weight' => $weight,
                ':neck' => $neck,
                ':waist' => $waist,
                ':hip' => 'female' === $gender ? $hip : null,
                ':activity' => $activity,
                ':is_athlete' => $isAthlete ? 1 : 0,
                ':body_fat' => round($bodyFat, 2),
                ':fat_mass' => round($fatMass, 2),
                ':lean_mass' => round($leanMass, 2),
                ':bmr' => round($bmr),
                ':tdee' => round($tdee),
                ':created_at' => $createdAt,
            ];

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

            exit;
        }
        $id_user = $_SESSION['user_id'];
        $history = $this->model->getAllHistory($id_user);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=historique_metriques.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['created_at', 'gender', 'height', 'weight', 'waist', 'neck', 'hip', 'activity_multiplier', 'is_athlete'], ';');

        foreach ($history as $row) {
            fputcsv($output, [
                $row['created_at'], $row['gender'], $row['height'], $row['weight'],
                $row['waist'], $row['neck'], $row['hip'], $row['activity_multiplier'], $row['is_athlete'],
            ], ';');
        }
        fclose($output);

        exit;
    }

    public function importCSV()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');

            exit;
        }

        if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_FILES['csv_file'])) {
            $file = $_FILES['csv_file']['tmp_name'];
            $id_user = $_SESSION['user_id'];

            if (!empty($file) && ($handle = fopen($file, 'r')) !== false) {
                fgetcsv($handle, 1000, ';'); // Ignore header

                while (($dataRow = fgetcsv($handle, 1000, ';')) !== false) {
                    if (count($dataRow) < 9) {
                        continue;
                    }

                    $createdAt = $dataRow[0];
                    $gender = $dataRow[1];
                    $height = (float) $dataRow[2];
                    $weight = (float) $dataRow[3];
                    $waist = (float) $dataRow[4];
                    $neck = (float) $dataRow[5];
                    $hip = empty($dataRow[6]) ? null : (float) $dataRow[6];
                    $activity = (float) $dataRow[7];
                    $isAthlete = (int) $dataRow[8];

                    if ($height <= 0 || $waist <= 0 || $neck <= 0) {
                        continue;
                    }

                    $diff = 'male' === $gender ? ($waist - $neck) : ($waist + $hip - $neck);
                    if ($diff <= 0) {
                        continue;
                    }

                    $lbmBoer = 'male' === $gender
                        ? (0.407 * $weight) + (0.267 * $height) - 19.2
                        : (0.252 * $weight) + (0.473 * $height) - 48.3;

                    if ($isAthlete) {
                        $lbmBoer *= ('male' === $gender ? 1.08 : 1.05);
                    }

                    $density = 'male' === $gender
                        ? 1.0324 - 0.19077 * log10($diff) + 0.15456 * log10($height)
                        : 1.29579 - 0.35004 * log10($diff) + 0.221 * log10($height);

                    $bfNavy = max(0, (495 / $density) - 450);
                    $lbmNavy = $weight * (1 - ($bfNavy / 100));

                    $leanMass = ($lbmBoer + $lbmNavy) / 2;
                    $minFatPercent = 'male' === $gender ? 3.0 : 10.0;
                    $maxLbm = $weight * (1 - ($minFatPercent / 100));
                    $leanMass = min($maxLbm, max($weight * 0.4, $leanMass));

                    $fatMass = $weight - $leanMass;
                    $bodyFat = ($fatMass / $weight) * 100;
                    $bmr = 370 + (21.6 * $leanMass);
                    $tdee = $bmr * $activity;

                    $dataToInsert = [
                        ':id_user' => $id_user,
                        ':gender' => $gender,
                        ':height' => $height,
                        ':weight' => $weight,
                        ':neck' => $neck,
                        ':waist' => $waist,
                        ':hip' => 'female' === $gender ? $hip : null,
                        ':activity' => $activity,
                        ':is_athlete' => $isAthlete ? 1 : 0,
                        ':body_fat' => round($bodyFat, 2),
                        ':fat_mass' => round($fatMass, 2),
                        ':lean_mass' => round($leanMass, 2),
                        ':bmr' => round($bmr),
                        ':tdee' => round($tdee),
                        ':created_at' => $createdAt,
                    ];

                    $this->model->insertMetric($dataToInsert);
                }
                fclose($handle);
            }
            header('Location: index.php');

            exit;
        }
    }

    public function delete()
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
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

    private function sendJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);

        exit;
    }
}
