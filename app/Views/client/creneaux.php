<?php echo view('layouts/header'); ?>

<div class="container-fluid mt-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2>Créneaux disponibles</h2>
        <span class="text-muted"><?= $total ?> créneau<?= $total > 1 ? 'x' : '' ?> trouvé<?= $total > 1 ? 's' : '' ?></span>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <div class="mb-3 d-flex gap-2 flex-wrap">
        <a href="/client/creneaux" class="btn btn-sm <?= $filtre_actif === 'tous' ? 'btn-primary' : 'btn-outline-secondary' ?>">Tous</a>
        <?php foreach ($types as $type): ?>
            <a href="/client/creneaux?type=<?= urlencode($type) ?>"
               class="btn btn-sm <?= $filtre_actif === $type ? 'btn-primary' : 'btn-outline-secondary' ?>">
                <?= esc($type) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if (empty($creneaux)): ?>
        <div class="alert alert-info">Aucun créneau disponible pour ce filtre.</div>
    <?php else: ?>
        <div class="row g-3">
            <?php foreach ($creneaux as $c): ?>
                <?php
                    $debut    = new DateTime($c['date_debut']);
                    $fin      = new DateTime($c['date_fin']);
                    $places   = (int)$c['places_dispo'];
                    $capacite = (int)$c['capacite'];
                    $complet  = $places === 0;
                    $pct      = $capacite > 0 ? round((($capacite - $places) / $capacite) * 100) : 100;
                ?>
                <div class="col-md-4">
                    <div class="card h-100 <?= $complet ? 'border-danger' : '' ?>">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-secondary"><?= esc($c['ressource_type']) ?></span>
                                <?php if ($complet): ?>
                                    <span class="badge bg-danger">Complet</span>
                                <?php endif; ?>
                            </div>
                            <h5 class="card-title"><?= esc($c['ressource_nom']) ?></h5>
                            <?php if (!empty($c['description'])): ?>
                                <p class="card-text text-muted small"><?= esc(mb_strimwidth($c['description'], 0, 80, '…')) ?></p>
                            <?php endif; ?>
                            <div class="mt-auto">
                                <p class="mb-1 small">
                                    <strong><?= $debut->format('d/m/Y') ?></strong>
                                    &nbsp;<?= $debut->format('H:i') ?> – <?= $fin->format('H:i') ?>
                                </p>
                                <div class="progress mb-1" style="height:6px;">
                                    <div class="progress-bar <?= $pct >= 90 ? 'bg-danger' : ($pct >= 60 ? 'bg-warning' : 'bg-success') ?>"
                                         style="width:<?= $pct ?>%"></div>
                                </div>
                                <p class="small text-muted mb-3"><?= $places ?> place<?= $places > 1 ? 's' : '' ?> restante<?= $places > 1 ? 's' : '' ?> / <?= $capacite ?></p>
                                <?php if ($complet): ?>
                                    <button class="btn btn-secondary btn-sm w-100" disabled>Complet</button>
                                <?php else: ?>
                                    <form method="POST" action="/client/reserve">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="creneau_id" value="<?= $c['id']; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm w-100">Réserver</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php echo view('layouts/footer'); ?>
