<?php

namespace App\Models;

use CodeIgniter\Model;

class InviteModel extends Model
{
    protected $table            = 'invites';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    // Ajout de tentatives_non ici 👇
    protected $allowedFields    = ['nom', 'reponse', 'tentatives_non']; 
    protected $useTimestamps    = true;
}