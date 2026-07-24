<?php
require_once 'config.php';

class MetricModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function insertMetric($data) {
        $sql = "INSERT INTO metrics_history 
                 (id_user, gender, height, weight, neck, waist, hip, activity_multiplier, body_fat, fat_mass, lean_mass, bmr, tdee) 
                 VALUES 
                 (:id_user, :gender, :height, :weight, :neck, :waist, :hip, :activity, :body_fat, :fat_mass, :lean_mass, :bmr, :tdee)";
                 
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAllHistory($id_user) {
        $sql = "SELECT * FROM metrics_history WHERE id_user = :id_user ORDER BY created_at DESC LIMIT 10";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}