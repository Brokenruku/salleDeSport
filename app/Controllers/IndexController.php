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
        
        // Récupérer les données
        $total_creneaux_semaine = $creneauModel->countCreneauxSemaine();
        $total_types_ressources = $ressourceModel->getTypeCount();
        
        // Passer les données à la vue
        $data = [
            'total_creneaux_semaine' => $total_creneaux_semaine,
            'total_types_ressources' => $total_types_ressources,
            'delai_annulation' => '48h',
            'gratuit' => '100%'
        ];
        
        // Retourner la vue avec les données
        return view('index', $data);
    }
}