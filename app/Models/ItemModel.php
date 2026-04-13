<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'item';
    protected $primaryKey = 'id';

    // On dit au Modèle d'utiliser notre Entity
    protected $returnType = \App\Entities\Item::class; 

    // Nouveaux champs autorisés
    protected $allowedFields = [
        'id_user', 'is_public', 'id_division', 'titre', 'status', 'ordre',
        'image', 'lien', 'description', 'episode', 'saison'
    ];

    public function getItemsGroupedByHeaderAndDivision($userId = null, $headerId = null)
    {
        $builder = $this->db->table('item i')
            ->select('h.nom AS header_nom, d.nom AS division_nom, i.*')
            ->join('division d', 'i.id_division = d.id')
            ->join('header h', 'd.id_header = h.id');

        if ($userId === null) {
            $builder->where('i.is_public', 1);
        } else {
            $builder->groupStart()
                    ->where('i.id_user', $userId)
                    ->orWhere('i.is_public', 1)
                    ->groupEnd();
        }

        if ($headerId !== null) {
            $builder->where('h.id', $headerId);
        }

        // Tri par ordre ajouté
        $builder->orderBy('h.id', 'ASC')
                ->orderBy('d.id', 'ASC')
                ->orderBy('i.ordre', 'ASC') 
                ->orderBy('i.titre', 'ASC');

        // On retourne des Objets Entity, pas des Array simples
        $results = $builder->get()->getCustomResultObject(\App\Entities\Item::class);

        $groupedData = [];
        foreach ($results as $item) {
            $header = $item->header_nom;
            $division = $item->division_nom;

            if (!isset($groupedData[$header])) $groupedData[$header] = [];
            if (!isset($groupedData[$header][$division])) $groupedData[$header][$division] = [];
            
            $groupedData[$header][$division][] = $item;
        }

        return $groupedData;
    }

    public function getDivisions() { return $this->db->table('division')->orderBy('nom', 'ASC')->get()->getResultArray(); }
    public function getHeaders() { return $this->db->table('header')->orderBy('id', 'ASC')->get()->getResultArray(); }
}