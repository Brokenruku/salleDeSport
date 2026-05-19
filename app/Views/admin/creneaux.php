<?php echo view('layouts/header'); ?>

<div class="container-fluid mt-5">
    <h2>Gérer les créneau</h2>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <a href="/admin/creneaux/create" class="btn btn-success mb-3">Ajouter un créneau</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ressource</th>
                <th>Date/Heure</th>
                <th>Places</th>
                <th>Actif</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($creneaux as $c): ?>
                <tr>
                    <td><?= $c['ressource_nom']; ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($c['date_debut'])); ?></td>
                    <td><?= $c['places_dispo']; ?></td>
                    <td><?= $c['actif'] ? 'Oui' : 'Non'; ?></td>
                    <td>
                        <a href="/admin/creneaux/edit/<?= $c['id']; ?>" class="btn btn-sm btn-warning">Éditer</a>
                        <form action="/admin/creneaux/delete/<?= $c['id']; ?>" method="POST" style="display:inline;">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php echo view('layouts/footer'); ?>
