<?php echo view('layouts/header'); ?>

<div class="container-fluid mt-5">
    <h2><?= isset($creneau) ? 'Éditer' : 'Ajouter'; ?> un créneau</h2>

    <form method="POST" action="/admin/creneaux/save">
        <?= csrf_field() ?>
        <?php if (isset($creneau)): ?>
            <input type="hidden" name="id" value="<?= $creneau['id']; ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Ressource</label>
            <select name="ressource_id" class="form-control" required>
                <option value="">Sélectionner une ressource</option>
                <?php foreach ($ressources as $r): ?>
                    <option value="<?= $r['id']; ?>" <?= (isset($creneau) && $creneau['ressource_id'] == $r['id']) ? 'selected' : ''; ?>>
                        <?= $r['nom']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date/Heure début</label>
            <input type="datetime-local" name="date_debut" class="form-control" required value="<?= isset($creneau) ? date('Y-m-d\TH:i', strtotime($creneau['date_debut'])) : ''; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Date/Heure fin</label>
            <input type="datetime-local" name="date_fin" class="form-control" required value="<?= isset($creneau) ? date('Y-m-d\TH:i', strtotime($creneau['date_fin'])) : ''; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Places disponibles</label>
            <input type="number" name="places_dispo" class="form-control" required value="<?= isset($creneau) ? $creneau['places_dispo'] : ''; ?>">
        </div>

        <div class="mb-3">
            <label>
                <input type="checkbox" name="actif" <?= (isset($creneau) && $creneau['actif']) ? 'checked' : ''; ?>>
                Actif
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="/admin/creneaux" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php echo view('layouts/footer'); ?>
