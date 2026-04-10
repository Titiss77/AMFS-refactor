<?php

namespace App\Models;

use CodeIgniter\Model;

class CarteModel extends Model
{
    protected $table            = 'cartes';
    protected $primaryKey       = 'id';
    
    // Les champs modifiables d'après votre migration
    protected $allowedFields    = [
        'categorie_id', 
        'section_id', 
        'libelle', 
        'description', 
        'url_path', 
        'img_path'
    ];

    // Optionnel : Récupérer les cartes avec le nom de leur catégorie
    public function getCartesWithRelations()
    {
        return $this->select('cartes.*, categories.libelle as categorie_nom')
                    ->join('categories', 'categories.id = cartes.categorie_id', 'left')
                    ->findAll();
    }
}