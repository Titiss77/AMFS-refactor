<?php

namespace App\Models;

use CodeIgniter\Model;

class InviteModel extends Model
{
    protected $table            = 'invites';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nom', 'reponse'];
    protected $useTimestamps    = true; // Gère automatiquement created_at et updated_at
}