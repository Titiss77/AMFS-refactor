<?php

namespace App\Models;

use CodeIgniter\Model;

class DonneeModel extends Model
{
    protected $table            = 'donnees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nom', 'lien', 'idCateg', 'temps'];

    // Optionnel : Une fonction pour récupérer les liens par catégorie directement
    public function getByCategory($idCateg)
    {
        return $this->where('idCateg', $idCateg)->findAll();
    }
}