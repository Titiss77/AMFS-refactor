<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cartes extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'categorie_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'section_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'libelle' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'url_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'img_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        // --- DÉCLARATION DES CLÉS ÉTRANGÈRES ---
        // (Champ local, Table cible, Champ cible, Comportement à la mise à jour, Comportement à la suppression)
        $this->forge->addForeignKey('categorie_id', 'categories', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('section_id', 'sections', 'id', 'CASCADE', 'SET NULL');

        // Création de la table
        $this->forge->createTable('cartes');
    }

    public function down(): void
    {
        $this->forge->dropTable('cartes');
    }
}
