<?php echo view('layouts/header'); ?>

<div class="container-fluid mt-5">
    <h2>Tableau de bord</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Créneau disponibles</h5>
                    <p class="card-text" style="font-size: 2em;"><?= $total_creneaux; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Mes réservations</h5>
                    <p class="card-text" style="font-size: 2em;"><?= $user_reservations; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <a href="/client/creneaux" class="btn btn-primary">Parcourir les créneau</a>
        <a href="/client/reservations" class="btn btn-info">Voir mes réservations</a>
    </div>
</div>

<?php echo view('layouts/footer'); ?>
