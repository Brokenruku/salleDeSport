<?php echo view('layouts/header'); ?>

<div class="container-fluid mt-5">
    <h2>Gérer les réservations</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Client</th>
                <th>Ressource</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $r): ?>
                <tr>
                    <td><?= $r['user_nom']; ?></td>
                    <td><?= $r['ressource_nom']; ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($r['date_debut'])); ?></td>
                    <td>
                        <form method="POST" action="/admin/reservations/update" style="display:inline;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $r['id']; ?>">
                            <select name="statut" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="en_attente" <?= $r['statut'] === 'en_attente' ? 'selected' : ''; ?>>En attente</option>
                                <option value="confirmee" <?= $r['statut'] === 'confirmee' ? 'selected' : ''; ?>>Confirmée</option>
                                <option value="refusee" <?= $r['statut'] === 'refusee' ? 'selected' : ''; ?>>Refusée</option>
                                <option value="annulee" <?= $r['statut'] === 'annulee' ? 'selected' : ''; ?>>Annulée</option>
                            </select>
                        </form>
                    </td>
                    <td><?= $r['user_email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php echo view('layouts/footer'); ?>
