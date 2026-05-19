<?php echo view('layouts/header'); ?>

<div class="container-fluid mt-5">
    <h2>Gérer les ressources</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <a href="/admin/ressources/create" class="btn btn-success mb-3">Ajouter une ressource</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Capacité</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ressources as $r): ?>
                <tr>
                    <td><?= esc($r['nom']); ?></td>
                    <td><?= esc($r['type']); ?></td>
                    <td><?= esc($r['capacite']); ?></td>
                    <td><?= esc($r['description']); ?></td>
                    <td>
                        <a href="/admin/ressources/edit/<?= $r['id']; ?>" class="btn btn-sm btn-warning">Éditer</a>
                        <form action="/admin/ressources/delete/<?= $r['id']; ?>" method="POST" style="display:inline;">
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
