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
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(DISTINCT type) as cnt FROM ressources');
        $row = $query->getRow();
        $count = $row ? (int)$row->cnt : 0;
        return $count > 0 ? $count : 3; // 3 types par défaut si table vide
    }
}