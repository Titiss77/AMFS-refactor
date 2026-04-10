<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'libelle' => 'Animés'],
            ['id' => 2, 'libelle' => 'Films'],
            ['id' => 3, 'libelle' => 'Séries'],
        ];
        $this->db->table('categories')->insert($data);
    }
}