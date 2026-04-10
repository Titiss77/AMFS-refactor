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
        $sql = 'SELECT h.nom AS header_nom, d.nom AS division_nom, i.* FROM item i
                JOIN division d ON i.id_division = d.id
                JOIN header h ON d.id_header = h.id
                ORDER BY h.id, d.id, i.titre ASC';

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

    /**
     * Récupère la liste des divisions pour le formulaire
     */
    public function getDivisions()
    {
        $stmt = $this->db->query('SELECT id, nom FROM division ORDER BY nom ASC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une seule carte par son ID
     */
    public function getItemById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM item WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Ajoute une nouvelle carte
     */
    public function createItem($id_user, $id_division, $titre, $lien, $description, $episode, $saison)
    {
        $sql = 'INSERT INTO item (id_user, id_division, titre, lien, description, episode, saison) 
                VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_user, $id_division, $titre, $lien, $description, $episode, $saison]);
    }

    /**
     * Met à jour une carte existante
     */
    public function updateItem($id, $id_division, $titre, $lien, $description, $episode, $saison)
    {
        $sql = 'UPDATE item SET id_division = ?, titre = ?, lien = ?, description = ?, episode = ?, saison = ? WHERE id = ?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_division, $titre, $lien, $description, $episode, $saison, $id]);
    }

    /**
     * Supprime une carte
     */
    public function deleteItem($id)
    {
        $stmt = $this->db->prepare('DELETE FROM item WHERE id = ?');
        return $stmt->execute([$id]);
    }
}