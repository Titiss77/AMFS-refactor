<?php declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        //php spark migrate:refresh; php spark db:seed MasterSeeder
        
        // On crée d'abord les tables de référence (parents)
        $this->call('CategorieSeeder');
        $this->call('SectionSeeder');
        
        // Ensuite on peut créer les cartes (enfants) qui ont besoin des IDs parents
        $this->call('CarteSeeder');
    }
}