<?php

namespace App\Controllers;

use App\Models\RessourceModel;
use App\Models\CreneauModel;

class IndexController extends BaseController
{
    public function index()
    {
        $ressourceModel = new RessourceModel();
        $creneauModel = new CreneauModel();
        
        // Récupérer les statistiques dynamiques
        $data = [
            'total_creneaux_semaine' => $creneauModel->countCreneauxSemaine(),
            'total_types_ressources' => $ressourceModel->distinct()->select('type')->countAllResults(),
            'delai_annulation' => '48h', // Valeur fixe ou venant de config
            'gratuit' => '100%' // Valeur fixe
        ];
        
        return view('index', $data);
    }
}