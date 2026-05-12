<?php

namespace App\Models;

use CodeIgniter\Model;

class RessourceModel extends Model
{
    protected $table = 'ressources';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'type', 'capacite', 'description'];
    
    public function getTypeCount()
    {
        $count = $this->distinct()->select('type')->countAllResults();
        return $count > 0 ? $count : 3; // 3 types par défaut si table vide
    }
}