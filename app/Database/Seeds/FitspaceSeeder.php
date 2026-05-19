<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FitspaceSeeder extends Seeder
{
    public function run(): void
    {
        $this->db->table('users')->insert([
            'nom'        => 'Admin',
            'email'      => 'admin@fitspace.mg',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'role'       => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('users')->insert([
            'nom'        => 'Client Test',
            'email'      => 'client@fitspace.mg',
            'password'   => password_hash('client123', PASSWORD_DEFAULT),
            'role'       => 'client',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('ressources')->insertBatch([
            ['nom' => 'Salle Zen', 'type' => 'cours', 'capacite' => 10, 'description' => 'Cours de yoga et méditation'],
            ['nom' => 'Terrain 1', 'type' => 'terrain', 'capacite' => 2, 'description' => 'Terrain de squash'],
            ['nom' => 'Salle Cardio', 'type' => 'salle', 'capacite' => 20, 'description' => 'Équipements cardio'],
        ]);

        for ($i = 1; $i <= 3; $i++) {
            $date = date('Y-m-d', strtotime("+$i days"));
            $this->db->table('creneaux')->insert([
                'ressource_id' => $i,
                'date_debut'   => $date . ' 08:00:00',
                'date_fin'     => $date . ' 09:30:00',
                'places_dispo' => 10,
                'actif'        => 1,
            ]);
        }
    }
}
