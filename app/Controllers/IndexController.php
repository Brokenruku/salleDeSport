<?php

namespace App\Controllers;

use App\Models\RessourceModel;
use App\Models\CreneauModel;
use App\Models\ReservationModel;

class IndexController extends BaseController
{
    public function index()
    {
        $ressourceModel = new RessourceModel();
        $creneauModel = new CreneauModel();
        
        $total_creneaux_semaine = $creneauModel->countCreneauxSemaine();
        $total_types_ressources = $ressourceModel->getTypeCount();
        
        $data = [
            'total_creneaux_semaine' => $total_creneaux_semaine,
            'total_types_ressources' => $total_types_ressources,
            'delai_annulation' => '48h',
            'gratuit' => '100%'
        ];
        
        return view('index', $data);
    }

    public function dashboard()
    {
        $creneauModel      = new CreneauModel();
        $reservationModel  = new ReservationModel();
        $userId            = session()->get('user_id');

        $data = [
            'total_creneaux'     => $creneauModel->where('actif', 1)->countAllResults(),
            'user_reservations'  => $reservationModel->where('user_id', $userId)->countAllResults(),
        ];

        return view('client/dashboard', $data);
    }
}