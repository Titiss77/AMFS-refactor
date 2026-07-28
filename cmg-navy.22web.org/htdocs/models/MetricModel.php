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
                  (id_user, gender, height, weight, neck, waist, hip, activity_multiplier, is_athlete, body_fat, fat_mass, lean_mass, bmr, tdee, created_at) 
                  VALUES 
                  (:id_user, :gender, :height, :weight, :neck, :waist, :hip, :activity, :is_athlete, :body_fat, :fat_mass, :lean_mass, :bmr, :tdee, :created_at)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAllHistory($id_user) {
        $sql = "SELECT * FROM metrics_history WHERE id_user = :id_user ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteMetric($id, $id_user) {
        $sql = "DELETE FROM metrics_history WHERE id = :id AND id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id, 
            ':id_user' => $id_user
        ]);
    }

    public function updateMetric($data) {
        $sql = "UPDATE metrics_history SET 
                    gender = :gender, 
                    height = :height, 
                    weight = :weight, 
                    neck = :neck, 
                    waist = :waist, 
                    hip = :hip, 
                    activity_multiplier = :activity, 
                    is_athlete = :is_athlete,
                    body_fat = :body_fat, 
                    fat_mass = :fat_mass, 
                    lean_mass = :lean_mass, 
                    bmr = :bmr, 
                    tdee = :tdee, 
                    created_at = :created_at
                WHERE id = :id AND id_user = :id_user";
                
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}