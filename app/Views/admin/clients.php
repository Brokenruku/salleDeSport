<?php echo view('layouts/header'); ?>

<div class="container-fluid mt-5">
    <h2>Clients inscrits</h2>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Inscrit le</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $c): ?>
                <tr>
                    <td><?= $c['id']; ?></td>
                    <td><?= esc($c['nom']); ?></td>
                    <td><?= esc($c['email']); ?></td>
                    <td><?= $c['created_at'] ? date('d/m/Y', strtotime($c['created_at'])) : '—'; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($clients)): ?>
                <tr><td colspan="4" class="text-center text-muted">Aucun client inscrit.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php echo view('layouts/footer'); ?>
