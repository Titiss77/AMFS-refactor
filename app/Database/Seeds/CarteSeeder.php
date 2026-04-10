<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CarteSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'categorie_id' => 1, // ID pour 'Animés'
                'section_id'   => 1, // ID pour 'Animés'
                'libelle'      => 'L\'Attaque des Titans',
                'description'  => 'Dans un monde ravagé par des titans mangeurs d\'hommes, l\'humanité tente de survivre.',
                'url_path'     => '/animes/snk',
                'img_path'     => 'assets/img/cartes/snk.jpg',
            ],
            [
                'categorie_id' => 2, // ID pour 'Films'
                'section_id'   => 2, // ID pour 'Films'
                'libelle'      => 'Inception',
                'description'  => 'Des voleurs qui s\'infiltrent dans les rêves pour y voler des secrets.',
                'url_path'     => '/films/inception',
                'img_path'     => 'assets/img/cartes/inception.jpg',
            ],
            [
                'categorie_id' => 3, // ID pour 'Séries'
                'section_id'   => 3, // ID pour 'Séries'
                'libelle'      => 'Breaking Bad',
                'description'  => 'Un professeur de chimie devient un baron de la drogue.',
                'url_path'     => '/series/breaking-bad',
                'img_path'     => 'assets/img/cartes/breaking_bad.jpg',
            ],
        ];

        $this->db->table('cartes')->insertBatch($data);
    }
}