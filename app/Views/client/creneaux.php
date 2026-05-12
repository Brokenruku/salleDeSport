<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créneaux — FitSpace</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <section id="page-creneaux" style="padding-top:1rem;">

        <nav class="nav-public">
            <a href="/" class="brand">Fit<span>Space</span></a>
            <div class="nav-links">
                <a href="/creneaux">Créneaux</a>
                <a href="/logout" class="btn-nav-primary">Déconnexion</a>
            </div>
        </nav>

        <div class="page-section">
            <div class="section-head">
                <h2>Créneaux disponibles</h2>
                <span class="count"><?= $total ?> créneau<?= $total > 1 ? 'x' : '' ?> trouvé<?= $total > 1 ? 's' : '' ?></span>
            </div>

            <!-- Filtres dynamiques -->
            <div class="filter-bar">
                <a href="/creneaux"
                   class="filter-pill <?= $filtre_actif === 'tous' ? 'active' : '' ?>">
                    Tous
                </a>
                <?php foreach ($types as $type): ?>
                    <?php
                        $icon = match(strtolower($type)) {
                            'sport'     => 'bi-lightning-charge-fill',
                            'fitness'   => 'bi-heart-pulse-fill',
                            'bien-être' => 'bi-peace-fill',
                            'aquatique' => 'bi-water',
                            'artistique'=> 'bi-music-note-beamed',
                            default     => 'bi-tag-fill',
                        };
                    ?>
                    <a href="/creneaux?type=<?= urlencode($type) ?>"
                       class="filter-pill <?= $filtre_actif === $type ? 'active' : '' ?>">
                        <i class="bi <?= $icon ?>"></i> <?= esc((string)$type) ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Grille créneaux -->
            <div class="creneaux-grid">

                <?php if (empty($creneaux)): ?>
                    <div style="grid-column:1/-1;text-align:center;padding:3rem;color:var(--muted);">
                        <i class="bi bi-calendar-x" style="font-size:2.5rem;"></i>
                        <p style="margin-top:1rem;">Aucun créneau disponible pour ce filtre.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($creneaux as $c): ?>
                        <?php
                            $debut      = new DateTime($c['date_debut']);
                            $fin        = new DateTime($c['date_fin']);
                            $places     = (int)$c['places_dispo'];
                            $capacite   = (int)$c['capacite'];
                            $complet    = $places === 0;
                            $pct        = $capacite > 0 ? round((($capacite - $places) / $capacite) * 100) : 100;

                            // Icône et classe CSS selon le type
                            $typeClass = match(strtolower($c['ressource_type'])) {
                                'sport'     => 'type-cours',
                                'fitness'   => 'type-salle',
                                'aquatique' => 'type-salle',
                                'bien-être' => 'type-cours',
                                'artistique'=> 'type-terrain',
                                default     => 'type-cours',
                            };
                            $typeIcon = match(strtolower($c['ressource_type'])) {
                                'sport'     => 'bi-lightning-charge-fill',
                                'fitness'   => 'bi-heart-pulse-fill',
                                'aquatique' => 'bi-water',
                                'bien-être' => 'bi-peace-fill',
                                'artistique'=> 'bi-music-note-beamed',
                                default     => 'bi-tag-fill',
                            };

                            // Couleur barre de places
                            $barColor = $pct >= 90 ? 'var(--accent)' : ($pct >= 60 ? 'var(--warning-tx)' : 'var(--accent2)');

                            // Formatage dates
                            $jours = ['Sunday'=>'Dim','Monday'=>'Lun','Tuesday'=>'Mar',
                                      'Wednesday'=>'Mer','Thursday'=>'Jeu','Friday'=>'Ven','Saturday'=>'Sam'];
                            $mois  = ['January'=>'jan','February'=>'fév','March'=>'mar','April'=>'avr',
                                      'May'=>'mai','June'=>'juin','July'=>'juil','August'=>'août',
                                      'September'=>'sep','October'=>'oct','November'=>'nov','December'=>'déc'];
                            $jourNom  = $jours[$debut->format('l')] ?? $debut->format('l');
                            $moisNom  = $mois[$debut->format('F')] ?? $debut->format('F');
                            $dateAff  = $jourNom . ' ' . $debut->format('j') . ' ' . $moisNom;
                        ?>

                        <div class="creneau-card <?= $complet ? 'full' : '' ?>">

                            <div class="creneau-header">
                                <span class="creneau-type <?= $typeClass ?>">
                                    <i class="bi <?= $typeIcon ?>"></i>
                                    <?= esc((string)$c['ressource_type']) ?>
                                </span>
                                <span style="font-size:0.75rem;color:var(--muted);"><?= $dateAff ?></span>
                            </div>

                            <p class="creneau-title"><?= esc((string)$c['ressource_nom']) ?></p>

                            <div class="creneau-meta">
                                <div class="meta-row">
                                    <i class="bi bi-clock"></i>
                                    <?= $debut->format('H\hi') ?> — <?= $fin->format('H\hi') ?>
                                </div>
                                <?php if (!empty($c['description'])): ?>
                                <div class="meta-row" style="color:var(--muted);font-size:0.82rem;">
                                    <i class="bi bi-info-circle"></i>
                                    <?= esc((string)mb_strimwidth($c['description'], 0, 55, '…')) ?>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div>
                                <div class="places-bar">
                                    <div class="places-fill"
                                         style="width:<?= $pct ?>%;background:<?= $barColor ?>">
                                    </div>
                                </div>
                                <?php if ($complet): ?>
                                    <div class="places-label">Complet — 0 place restante</div>
                                <?php else: ?>
                                    <div class="places-label">
                                        <?= $places ?> place<?= $places > 1 ? 's' : '' ?> restante<?= $places > 1 ? 's' : '' ?>
                                        sur <?= $capacite ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if ($complet): ?>
                                <button class="btn-reserver disabled" disabled>Complet</button>
                            <?php else: ?>
                                <a href="/reserver/<?= $c['id'] ?>" class="btn-reserver">
                                    Réserver ce créneau
                                </a>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div><!-- /creneaux-grid -->
        </div><!-- /page-section -->

        <div class="footer-public">
            FitSpace &copy; 2025 — Projet CodeIgniter 4 · Tous droits <span>réservés</span>
        </div>

    </section>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>