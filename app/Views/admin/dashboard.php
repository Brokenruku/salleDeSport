<?php echo view('layouts/header'); ?>

<div class="container-fluid mt-5">
    <h2 class="mb-4">Tableau de bord</h2>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div style="font-size:2rem;font-weight:700;color:var(--accent)"><?= $total_creneaux; ?></div>
                    <div class="text-muted small">Créneaux total</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div style="font-size:2rem;font-weight:700;color:var(--accent)"><?= $creneaux_actifs; ?></div>
                    <div class="text-muted small">Créneaux à venir</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div style="font-size:2rem;font-weight:700;color:var(--accent)"><?= $total_reservations; ?></div>
                    <div class="text-muted small">Réservations total</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div style="font-size:2rem;font-weight:700;color:var(--accent)"><?= $reservations_aujourdhui; ?></div>
                    <div class="text-muted small">Réservations aujourd'hui</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-5">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div style="font-size:2rem;font-weight:700;color:var(--accent)"><?= $reservations_en_attente; ?></div>
                    <div class="text-muted small">En attente</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div style="font-size:2rem;font-weight:700;color:var(--accent)"><?= $total_clients; ?></div>
                    <div class="text-muted small">Clients inscrits</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div style="font-size:2rem;font-weight:700;color:var(--accent)"><?= $total_ressources; ?></div>
                    <div class="text-muted small">Ressources</div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="/admin/creneaux" class="btn btn-primary">Gérer les créneaux</a>
        <a href="/admin/reservations" class="btn btn-info">Gérer les réservations</a>
        <a href="/admin/ressources" class="btn btn-secondary">Gérer les ressources</a>
        <a href="/admin/clients" class="btn btn-outline-dark">Voir les clients</a>
    </div>
</div>

<?php echo view('layouts/footer'); ?>
