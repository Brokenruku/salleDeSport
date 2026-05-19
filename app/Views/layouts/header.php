<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FitSpace</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet" />
  <style>
    :root {
      --primary:    #1a1a2e;
      --accent:     #e94560;
      --accent2:    #0f3460;
      --surface:    #f7f7fa;
      --border:     #e2e2ea;
      --text:       #1a1a2e;
      --muted:      #7b7b96;
      --success-bg: #e9f7ef;
      --success-tx: #1a6b39;
      --danger-bg:  #fdecea;
      --danger-tx:  #8b1a1a;
      --nav-h:      64px;
    }
    *, *::before, *::after { box-sizing: border-box; }
    body { font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--text); margin: 0; }
    h1, h2, h3, .brand { font-family: 'Syne', sans-serif; }

    .nav-public { background: var(--primary); height: var(--nav-h); display: flex; align-items: center; padding: 0 2rem; gap: 2rem; }
    .nav-public .brand { color: #fff; font-size: 1.4rem; font-weight: 800; text-decoration: none; letter-spacing: -0.5px; }
    .nav-public .brand span { color: var(--accent); }
    .nav-public .nav-links { margin-left: auto; display: flex; align-items: center; gap: 1rem; }
    .nav-public .nav-links a { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: color 0.15s; }
    .nav-public .nav-links a:hover { color: #fff; }
    .btn-nav-primary { background: var(--accent); color: #fff !important; border-radius: 6px; padding: 8px 18px; }
    .btn-nav-primary:hover { background: #c73250 !important; }

    .auth-wrapper { min-height: calc(100vh - var(--nav-h)); display: flex; align-items: center; justify-content: center; padding: 2rem; background: var(--surface); }
    .auth-card { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 420px; }
    .auth-logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.5rem; color: var(--primary); margin-bottom: 0.25rem; }
    .auth-logo span { color: var(--accent); }
    .auth-subtitle { font-size: 0.85rem; color: var(--muted); margin-bottom: 2rem; }
    .auth-divider { border: none; border-top: 1px solid var(--border); margin: 1.5rem 0; }
    .form-label { font-size: 0.85rem; font-weight: 500; color: var(--text); margin-bottom: 5px; }
    .form-control { border: 1.5px solid var(--border); border-radius: 8px; padding: 10px 12px; font-size: 0.9rem; transition: border-color 0.15s; }
    .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(233,69,96,0.08); outline: none; }
    .btn-primary-custom { background: var(--accent); border: none; color: #fff; border-radius: 8px; padding: 11px; font-weight: 600; font-size: 0.95rem; width: 100%; cursor: pointer; transition: background 0.15s; }
    .btn-primary-custom:hover { background: #c73250; }
    .auth-footer { text-align: center; margin-top: 1.25rem; font-size: 0.85rem; color: var(--muted); }
    .auth-footer a { color: var(--accent); text-decoration: none; font-weight: 500; }
    .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    @media (max-width: 640px) { .form-grid-2 { grid-template-columns: 1fr; } }
    .form-group { display: flex; flex-direction: column; gap: 5px; }
    .flash-message { padding: 12px 16px; border-radius: 8px; font-size: 0.875rem; font-weight: 500; display: flex; align-items: center; gap: 10px; margin-bottom: 1.25rem; }
    .flash-success { background: var(--success-bg); color: var(--success-tx); border: 1px solid #aadebc; }
    .flash-error   { background: var(--danger-bg);  color: var(--danger-tx);  border: 1px solid #f5b8b8; }
    .field-error { color: var(--accent); font-size: 0.78rem; margin-top: 3px; }
  </style>
</head>
<body>
<nav class="nav-public">
  <a href="/" class="brand">Fit<span>Space</span></a>
  <div class="nav-links">
    <?php if (session()->get('user_id')): ?>
      <?php if (session()->get('user_role') === 'admin'): ?>
        <a href="/admin/dashboard">Tableau de bord</a>
        <a href="/admin/creneaux">Créneau</a>
        <a href="/admin/reservations">Réservations</a>
        <a href="/admin/ressources">Ressources</a>
        <a href="/admin/clients">Clients</a>
      <?php else: ?>
        <a href="/client/dashboard">Tableau de bord</a>
        <a href="/client/creneaux">Créneau</a>
        <a href="/client/reservations">Mes réservations</a>
      <?php endif; ?>
      <a href="/logout" class="btn-nav-primary">Déconnexion</a>
    <?php else: ?>
      <a href="/login" class="btn-nav-primary">Connexion</a>
    <?php endif; ?>
  </div>
</nav>

