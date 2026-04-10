<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id' => 1, 'libelle' => 'Animés'],
            ['id' => 2, 'libelle' => 'Films'],
            ['id' => 3, 'libelle' => 'Séries'],
        ];

        // Utilisation de insertBatch car on insère plusieurs lignes d'un coup
        $this->db->table('categories')->insertBatch($data);
    }
}