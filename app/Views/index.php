<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitSpace - Réservation de créneaux</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

    <section id="page-accueil">

        <!-- NAV -->
        <nav class="nav-public">
            <a href="/" class="brand">Fit<span>Space</span></a>
            <div class="nav-links">
                <a href="/client/creneaux">Nos créneaux</a>
                <a href="#">Tarifs</a>
                <?php if (session()->get('user_id')): ?>
                    <span style="color:rgba(255,255,255,0.6);font-size:0.85rem;">
                        <?= esc((string)session()->get('user_name')) ?>
                    </span>
                    <a href="/logout" class="btn-nav-primary">Déconnexion</a>
                <?php else: ?>
                    <a href="/login" class="btn-nav-primary">Connexion</a>
                    <a href="/register" class="btn-nav-primary">S'inscrire</a>
                <?php endif; ?>
            </div>
        </nav>

        <!-- HERO -->
        <div class="hero">
            <div class="hero-eyebrow"><i class="bi bi-lightning-charge-fill"></i> Réservation en ligne</div>
            <h1>Votre espace bien-être,<br><em>réservé en 30 secondes.</em></h1>
            <p>Cours collectifs, salles et terrains disponibles 7j/7. Créez un compte gratuit et réservez votre prochain créneau.</p>
            <div class="hero-ctas">
                <a href="/client/creneaux" class="btn-hero btn-hero-primary">Voir les créneaux disponibles</a>
                <?php if (!session()->get('user_id')): ?>
                    <a href="/register" class="btn-hero btn-hero-outline">Créer mon compte</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- STATS DYNAMIQUES -->
        <div class="stats-band">
            <div class="stat-item">
                <div class="num"><?= $total_creneaux_semaine ?></div>
                <div class="lbl">Créneaux / semaine</div>
            </div>
            <div class="stat-item">
                <div class="num"><?= $total_types_ressources ?></div>
                <div class="lbl">Types de ressources</div>
            </div>
            <div class="stat-item">
                <div class="num"><?= $delai_annulation ?></div>
                <div class="lbl">Délai d'annulation</div>
            </div>
            <div class="stat-item">
                <div class="num"><?= $gratuit ?></div>
                <div class="lbl">Gratuit à l'inscription</div>
            </div>
        </div>

    </section>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/script.js"></script>
</body>

</html>