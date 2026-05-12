<?php

namespace App\Controllers;

use App\Models\CreneauModel;

class CreneauxController extends BaseController
{
    public function index(): string
    {
        $creneauModel = new CreneauModel();

        // Récupérer le filtre depuis l'URL (?type=Sport), défaut = tous
        $type = $this->request->getGet('type') ?? 'tous';

        $creneaux = $creneauModel->getCreneauxDisponibles($type === 'tous' ? null : $type);
        $types    = $creneauModel->getTypesDisponibles();

        $data = [
            'creneaux'     => $creneaux,
            'types'        => $types,
            'filtre_actif' => $type,
            'total'        => count($creneaux),
        ];

        return view('client/creneaux', $data);
    }
}