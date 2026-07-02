<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvitesTable extends Migration
{
    // Ajout de ": void" ici
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

    // Ajout de ": void" ici
    public function down(): void 
    {
        $this->forge->dropTable('invites');
    }
}