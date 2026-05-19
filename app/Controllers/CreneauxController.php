<?php

namespace App\Controllers;

use App\Models\CreneauModel;
use App\Models\ReservationModel;

class CreneauxController extends BaseController
{
    public function index(): string
    {
        $creneauModel = new CreneauModel();

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

    public function reserve()
    {
        $creneauId = $this->request->getPost('creneau_id');
        $userId    = session()->get('user_id');

        $creneauModel      = new CreneauModel();
        $reservationModel  = new ReservationModel();

        $creneau = $creneauModel->find($creneauId);
        
        if (!$creneau || $creneau['places_dispo'] <= 0) {
            return redirect()->back()->with('error', 'Créneau non disponible.');
        }

        $existing = $reservationModel->where('user_id', $userId)
                                     ->where('creneau_id', $creneauId)
                                     ->first();
        
        if ($existing) {
            return redirect()->back()->with('error', 'Vous avez déjà réservé ce créneau.');
        }

        $reservationModel->insert([
            'user_id'    => $userId,
            'creneau_id' => $creneauId,
            'statut'     => 'en_attente',
        ]);

        $creneauModel->update($creneauId, ['places_dispo' => $creneau['places_dispo'] - 1]);

        return redirect()->to('/client/reservations')->with('success', 'Réservation effectuée.');
    }

    public function myReservations()
    {
        $reservationModel = new ReservationModel();
        $userId           = session()->get('user_id');

        $reservations = $reservationModel->select('reservations.*, creneaux.date_debut, creneaux.date_fin, ressources.nom as ressource_nom')
                                        ->join('creneaux', 'creneaux.id = reservations.creneau_id')
                                        ->join('ressources', 'ressources.id = creneaux.ressource_id')
                                        ->where('reservations.user_id', $userId)
                                        ->orderBy('creneaux.date_debut', 'DESC')
                                        ->findAll();

        $data = ['reservations' => $reservations];
        return view('client/reservations', $data);
    }

    public function cancelReservation()
    {
        $reservationId   = $this->request->getPost('reservation_id');
        $reservationModel = new ReservationModel();
        $creneauModel     = new CreneauModel();

        $reservation = $reservationModel->find($reservationId);
        if (!$reservation) {
            return redirect()->back()->with('error', 'Réservation non trouvée.');
        }

        $creneau = $creneauModel->find($reservation['creneau_id']);
        $creneauModel->update($reservation['creneau_id'], ['places_dispo' => $creneau['places_dispo'] + 1]);

        $reservationModel->update($reservationId, ['statut' => 'annulee']);

        return redirect()->to('/client/reservations')->with('success', 'Réservation annulée.');
    }
}