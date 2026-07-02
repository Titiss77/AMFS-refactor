<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvitesTable extends Migration
{
    public function up(): void 
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'reponse' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'default'    => 'Oui',
            ],
            'tentatives_non' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('invites');
    }

    public function down(): void 
    {
        $this->forge->dropTable('invites');
    }
}