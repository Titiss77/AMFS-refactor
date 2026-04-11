<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'item';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_user', 'id_division', 'titre', 'lien', 'description', 'episode', 'saison',
    ];

    public function getItemsGroupedByHeaderAndDivision($userId = null)
    {
        $idUtilisateurPublic = 1; // ID de l'utilisateur fictif (par défaut)

        // Si personne n'est connecté, on ne cherche que les cartes de l'ID 1
        if ($userId === null) {
            $whereClause = "WHERE i.id_user = ?";
            $params = [$idUtilisateurPublic];
        } 
        // Si c'est l'utilisateur public qui est connecté (l'admin), on ne cherche que ses cartes
        elseif ($userId === $idUtilisateurPublic) {
            $whereClause = "WHERE i.id_user = ?";
            $params = [$idUtilisateurPublic];
        } 
        // Si un autre utilisateur est connecté, on cherche ses cartes ET les cartes publiques
        else {
            $whereClause = "WHERE i.id_user = ? OR i.id_user = ?";
            $params = [$userId, $idUtilisateurPublic];
        }

        $sql = "SELECT h.nom AS header_nom, d.nom AS division_nom, i.* FROM item i
                JOIN division d ON i.id_division = d.id
                JOIN header h ON d.id_header = h.id
                $whereClause
                ORDER BY h.id, d.id, i.titre ASC";

        $query = $this->db->query($sql, $params);
        $results = $query->getResultArray();

        $groupedData = [];
        foreach ($results as $row) {
            $header = $row['header_nom'];
            $division = $row['division_nom'];

            if (!isset($groupedData[$header])) {
                $groupedData[$header] = [];
            }
            if (!isset($groupedData[$header][$division])) {
                $groupedData[$header][$division] = [];
            }
            $groupedData[$header][$division][] = $row;
        }

        return $groupedData;
    }
    
    public function getDivisions()
    {
        $query = $this->db->query('SELECT id, nom FROM division ORDER BY nom ASC');

        return $query->getResultArray();
    }

    public function getItemById($id)
    {
        $query = $this->db->query('SELECT * FROM item WHERE id = ?', [$id]);

        return $query->getRowArray(); // Equivalent de fetch(PDO::FETCH_ASSOC)
    }

    public function createItem($id_user, $id_division, $titre, $lien, $description, $episode, $saison)
    {
        $sql = 'INSERT INTO item (id_user, id_division, titre, lien, description, episode, saison) VALUES (?, ?, ?, ?, ?, ?, ?)';

        return $this->db->query($sql, [$id_user, $id_division, $titre, $lien, $description, $episode, $saison]);
    }

    public function updateItem($id, $id_division, $titre, $lien, $description, $episode, $saison)
    {
        $sql = 'UPDATE item SET id_division = ?, titre = ?, lien = ?, description = ?, episode = ?, saison = ? WHERE id = ?';

        return $this->db->query($sql, [$id_division, $titre, $lien, $description, $episode, $saison, $id]);
    }

    public function deleteItem($id)
    {
        return $this->db->query('DELETE FROM item WHERE id = ?', [$id]);
    }
}