<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'item';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    // --- NOUVEAUTÉ : Activation du Soft Delete ---
    protected $useSoftDeletes = true;
    protected $protectFields = true;

    protected $allowedFields = [
        'titre', 'titre_original', 'id_user', 'id_division',
        'saison', 'episode', 'statut', 'lien', 'img',
        'description', 'ordre', 'is_visible'
    ];

    // --- NOUVEAUTÉ : Gestion des dates automatiques ---
    protected $useTimestamps = true;  // Assure-toi que c'est à true
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';  // La nouvelle colonne

    public function getItemsGroupedByHeaderAndDivision($userId = null, $headerId = null)
    {
        $builder = $this
            ->db
            ->table('item i')
            ->select('h.nom AS header_nom, d.nom AS division_nom, i.*')
            ->join('division d', 'i.id_division = d.id')
            ->join('header h', 'd.id_header = h.id')
            ->where('i.id_user !=', 0);  // EXCLURE L'UTILISATEUR 0 DE L'AFFICHAGE

        if (null === $userId) {
            $builder->where('i.is_public', 1);
        } else {
            $builder
                ->groupStart()
                ->where('i.id_user', $userId)
                ->orWhere('i.is_public', 1)
                ->groupEnd();
        }

        if (null !== $headerId) {
            $builder->where('h.id', $headerId);
        }

        // Tri par ordre ajouté
        $builder
            ->orderBy('h.id', 'ASC')
            ->orderBy('d.id', 'ASC')
            ->orderBy('i.position', 'ASC')
            ->orderBy('i.titre', 'ASC');

        // On retourne des Objets Entity, pas des Array simples
        $results = $builder->get()->getCustomResultObject(Item::class);

        $groupedData = [];
        foreach ($results as $item) {
            $header = $item->header_nom;
            $division = $item->division_nom;

            if (!isset($groupedData[$header])) {
                $groupedData[$header] = [];
            }
            if (!isset($groupedData[$header][$division])) {
                $groupedData[$header][$division] = [];
            }

            $groupedData[$header][$division][] = $item;
        }

        return $groupedData;
    }

    public function getDivisions()
    {
        return $this->db->table('division')->orderBy('id', 'ASC')->get()->getResultArray();
    }

    public function getHeaders()
    {
        return $this->db->table('header')->orderBy('id', 'ASC')->get()->getResultArray();
    }

    public function checkToGlobal()
    {
        // On sélectionne TOUT (*) pour que getFinalLink(), status, etc. fonctionnent
        $command = 'SELECT * FROM `item` WHERE id_division >= 5 AND id_division < 11 AND is_public = 1;';

        // On force le résultat à être un tableau d'objets Entity\Item
        return $this->db->query($command)->getCustomResultObject(Item::class);
    }
}