<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservations extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'         => ['type' => 'INTEGER', 'auto_increment' => true],
            'user_id'    => ['type' => 'INTEGER'],
            'creneau_id' => ['type' => 'INTEGER'],
            'statut'     => ['type' => 'VARCHAR', 'constraint' => 15, 'default' => 'en_attente'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('creneau_id', 'creneaux', 'id');
        $this->forge->createTable('reservations');
    }

    public function down(): void
    {
        $this->forge->dropTable('reservations');
    }
}
