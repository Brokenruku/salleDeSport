<?php echo view('layouts/header'); ?>

<div class="container-fluid mt-5">
    <h2><?= isset($ressource) ? 'Éditer' : 'Ajouter'; ?> une ressource</h2>

    <form method="POST" action="/admin/ressources/save">
        <?= csrf_field() ?>
        <?php if (isset($ressource)): ?>
            <input type="hidden" name="id" value="<?= $ressource['id']; ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" required value="<?= isset($ressource) ? esc($ressource['nom']) : ''; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <input type="text" name="type" class="form-control" required value="<?= isset($ressource) ? esc($ressource['type']) : ''; ?>" placeholder="ex: salle, terrain, équipement">
        </div>

        <div class="mb-3">
            <label class="form-label">Capacité</label>
            <input type="number" name="capacite" class="form-control" required value="<?= isset($ressource) ? esc($ressource['capacite']) : ''; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"><?= isset($ressource) ? esc($ressource['description']) : ''; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="/admin/ressources" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php echo view('layouts/footer'); ?>
