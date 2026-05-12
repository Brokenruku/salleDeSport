<?php

namespace App\Models;

use CodeIgniter\Model;

class CreneauModel extends Model
{
    protected $table = 'creneaux';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ressource_id', 'date_debut', 'date_fin', 'places_dispo', 'actif'];
    
    public function countCreneauxSemaine()
    {
        return $this->where('actif', 1)
                    ->where('date_debut >=', date('Y-m-d 00:00:00'))
                    ->where('date_debut <=', date('Y-m-d 23:59:59', strtotime('+7 days')))
                    ->countAllResults();
    }
}