<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFavorisTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('categories');

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type' => 'TEXT',
            ],
            'lien' => [
                'type' => 'TEXT',
            ],
            'idCateg' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'temps' => [
                'type' => 'VARCHAR',
                'constraint' => '5',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');

        $this->forge->addForeignKey('idCateg', 'categories', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('donnees');
    }

    public function down()
    {
        // On supprime d'abord l'enfant (donneesh) puis le parent (cateh)
        $this->forge->dropTable('donnees');
        $this->forge->dropTable('categories');
    }
}