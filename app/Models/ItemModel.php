<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'item';
    protected $primaryKey = 'id';

    // AJOUT DE 'is_public' DANS LES CHAMPS AUTORISÉS
    protected $allowedFields = [
        'id_user', 'is_public', 'id_division', 'titre', 
        'image', 'lien', 'description', 'episode', 'saison'
    ];

    public function getItemsGroupedByHeaderAndDivision($userId = null, $headerId = null)
    {
        $builder = $this->db->table('item i')
            ->select('h.nom AS header_nom, d.nom AS division_nom, i.*')
            ->join('division d', 'i.id_division = d.id')
            ->join('header h', 'd.id_header = h.id');

        // GESTION PROPRE DE LA VISIBILITÉ
        if ($userId === null) {
            $builder->where('i.is_public', 1);
        } else {
            $builder->groupStart()
                    ->where('i.id_user', $userId)
                    ->orWhere('i.is_public', 1)
                    ->groupEnd();
        }

        // FILTRE PAR CATÉGORIE
        if ($headerId !== null) {
            $builder->where('h.id', $headerId);
        }

        $builder->orderBy('h.id', 'ASC')
                ->orderBy('d.id', 'ASC')
                ->orderBy('i.titre', 'ASC');

        $results = $builder->get()->getResultArray();

        // REGROUPEMENT
        $groupedData = [];
        foreach ($results as $row) {
            $header = $row['header_nom'];
            $division = $row['division_nom'];

            if (!isset($groupedData[$header])) $groupedData[$header] = [];
            if (!isset($groupedData[$header][$division])) $groupedData[$header][$division] = [];
            
            $groupedData[$header][$division][] = $row;
        }

        return $groupedData;
    }

    public function getDivisions()
    {
        return $this->db->table('division')->orderBy('nom', 'ASC')->get()->getResultArray();
    }

    public function getHeaders()
    {
        return $this->db->table('header')->orderBy('id', 'ASC')->get()->getResultArray();
    }

    // SUPPRESSION DE createItem, updateItem, deleteItem et getItemById 
    // CodeIgniter gère ça tout seul maintenant !
}