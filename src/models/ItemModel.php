<?php

class ItemModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Récupère tous les items et les groupe par Header puis par Division.
     */
    public function getItemsGroupedByHeaderAndDivision()
    {
        // On récupère tout grâce aux jointures
        $sql = "SELECT h.nom AS header_nom, d.nom AS division_nom, i.* FROM item i
                JOIN division d ON i.id_division = d.id
                JOIN header h ON d.id_header = h.id
                ORDER BY h.id, d.id, i.titre ASC";

        $stmt = $this->db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // On réorganise les données dans un tableau multidimensionnel
        $groupedData = [];
        foreach ($results as $row) {
            $header = $row['header_nom'];
            $division = $row['division_nom'];
            
            // Si le header n'existe pas, on le crée
            if (!isset($groupedData[$header])) {
                $groupedData[$header] = [];
            }
            
            // Si la division n'existe pas dans le header, on la crée
            if (!isset($groupedData[$header][$division])) {
                $groupedData[$header][$division] = [];
            }
            
            // On ajoute la carte dans sa division
            $groupedData[$header][$division][] = $row;
        }

        return $groupedData;
    }
}