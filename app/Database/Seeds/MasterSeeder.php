<?php declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        //php spark migrate:refresh; php spark db:seed MasterSeeder
        $this->call('CategorieSeeder');
    }
}