<?php

namespace App\Controllers;

use App\Models\CreneauModel;
use App\Models\RessourceModel;
use App\Models\ReservationModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    protected $creneauModel;
    protected $ressourceModel;
    protected $reservationModel;
    protected $userModel;

    public function __construct()
    {
        $this->creneauModel      = new CreneauModel();
        $this->ressourceModel    = new RessourceModel();
        $this->reservationModel  = new ReservationModel();
        $this->userModel         = new UserModel();
    }

    public function dashboard()
    {
        $today = date('Y-m-d');
        $data = [
            'total_creneaux'          => $this->creneauModel->countAll(),
            'total_reservations'      => $this->reservationModel->countAll(),
            'total_ressources'        => $this->ressourceModel->countAll(),
            'total_clients'           => $this->userModel->where('role', 'client')->countAllResults(),
            'reservations_aujourdhui' => $this->reservationModel
                                              ->join('creneaux', 'creneaux.id = reservations.creneau_id')
                                              ->where('DATE(creneaux.date_debut)', $today)
                                              ->countAllResults(),
            'reservations_en_attente' => $this->reservationModel->where('statut', 'en_attente')->countAllResults(),
            'creneaux_actifs'         => $this->creneauModel->where('actif', 1)
                                                            ->where('date_debut >=', date('Y-m-d H:i:s'))
                                                            ->countAllResults(),
        ];
        return view('admin/dashboard', $data);
    }

    public function clients()
    {
        $data = [
            'clients' => $this->userModel->where('role', 'client')->orderBy('created_at', 'DESC')->findAll(),
        ];
        return view('admin/clients', $data);
    }

    public function creneaux()
    {
        $data = [
            'creneaux'   => $this->creneauModel->select('creneaux.*, ressources.nom as ressource_nom')
                                                ->join('ressources', 'ressources.id = creneaux.ressource_id')
                                                ->orderBy('creneaux.date_debut', 'DESC')
                                                ->findAll(),
            'ressources' => $this->ressourceModel->findAll(),
        ];
        return view('admin/creneaux', $data);
    }

    public function createCreneau()
    {
        $data = [
            'ressources' => $this->ressourceModel->findAll(),
        ];
        return view('admin/creneau_form', $data);
    }

    public function saveCreneau()
    {
        $id = $this->request->getPost('id');
        $data = [
            'ressource_id' => $this->request->getPost('ressource_id'),
            'date_debut'   => $this->request->getPost('date_debut'),
            'date_fin'     => $this->request->getPost('date_fin'),
            'places_dispo' => $this->request->getPost('places_dispo'),
            'actif'        => $this->request->getPost('actif') ? 1 : 0,
        ];

        if ($id) {
            $this->creneauModel->update($id, $data);
            $message = 'Créneau modifié avec succès.';
        } else {
            $this->creneauModel->insert($data);
            $message = 'Créneau créé avec succès.';
        }

        return redirect()->to('/admin/creneaux')->with('success', $message);
    }

    public function editCreneau($id)
    {
        $data = [
            'creneau'    => $this->creneauModel->find($id),
            'ressources' => $this->ressourceModel->findAll(),
        ];
        return view('admin/creneau_form', $data);
    }

    public function deleteCreneau($id)
    {
        $this->creneauModel->delete($id);
        return redirect()->to('/admin/creneaux')->with('success', 'Créneau supprimé.');
    }

    public function reservations()
    {
        $data = [
            'reservations' => $this->reservationModel->getReservationsWithDetails(),
        ];
        return view('admin/reservations', $data);
    }

    public function updateReservation()
    {
        $id     = $this->request->getPost('id');
        $statut = $this->request->getPost('statut');

        $this->reservationModel->update($id, ['statut' => $statut]);

        return redirect()->to('/admin/reservations')->with('success', 'Réservation mise à jour.');
    }

    public function ressources()
    {
        $data = ['ressources' => $this->ressourceModel->findAll()];
        return view('admin/ressources', $data);
    }

    public function createRessource()
    {
        return view('admin/ressource_form');
    }

    public function saveRessource()
    {
        $id   = $this->request->getPost('id');
        $data = [
            'nom'         => $this->request->getPost('nom'),
            'type'        => $this->request->getPost('type'),
            'capacite'    => $this->request->getPost('capacite'),
            'description' => $this->request->getPost('description'),
        ];

        if ($id) {
            $this->ressourceModel->update($id, $data);
            $message = 'Ressource modifiée avec succès.';
        } else {
            $this->ressourceModel->insert($data);
            $message = 'Ressource créée avec succès.';
        }

        return redirect()->to('/admin/ressources')->with('success', $message);
    }

    public function editRessource($id)
    {
        $data = ['ressource' => $this->ressourceModel->find($id)];
        return view('admin/ressource_form', $data);
    }

    public function deleteRessource($id)
    {
        $this->ressourceModel->delete($id);
        return redirect()->to('/admin/ressources')->with('success', 'Ressource supprimée.');
    }
}
