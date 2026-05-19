<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table      = 'reservations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'creneau_id', 'statut'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    public function getReservationsWithDetails()
    {
        return $this->select('reservations.*, users.nom as user_nom, users.email as user_email, creneaux.date_debut, creneaux.date_fin, ressources.nom as ressource_nom')
                    ->join('users', 'users.id = reservations.user_id')
                    ->join('creneaux', 'creneaux.id = reservations.creneau_id')
                    ->join('ressources', 'ressources.id = creneaux.ressource_id')
                    ->orderBy('creneaux.date_debut', 'DESC')
                    ->findAll();
    }
}
