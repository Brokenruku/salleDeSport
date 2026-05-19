<?php echo view('layouts/header'); ?>

<div class="container-fluid mt-5">
    <h2>Mes réservations</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <?php if (empty($reservations)): ?>
        <div class="alert alert-info">Vous n'avez pas de réservations pour le moment.</div>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ressource</th>
                    <th>Date/Heure</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $r): ?>
                    <tr>
                        <td><?= $r['ressource_nom']; ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($r['date_debut'])); ?></td>
                        <td>
                            <span class="badge bg-<?= $r['statut'] === 'confirmee' ? 'success' : ($r['statut'] === 'refusee' ? 'danger' : 'warning'); ?>">
                                <?= ucfirst(str_replace('_', ' ', $r['statut'])); ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($r['statut'] === 'en_attente'): ?>
                                <form method="POST" action="/client/cancel-reservation" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="reservation_id" value="<?= $r['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Annuler</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="/client/creneaux" class="btn btn-primary mt-3">Voir les créneau disponibles</a>
</div>

<?php echo view('layouts/footer'); ?>
