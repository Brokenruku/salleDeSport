<?= view('layouts/header') ?>

<nav class="nav-public">
  <a href="<?= base_url('/') ?>" class="brand">Fit<span>Space</span></a>
</nav>

<div class="auth-wrapper">
  <div class="auth-card">
    <div class="auth-logo">Fit<span>Space</span></div>
    <div class="auth-subtitle">Créez votre compte client gratuitement.</div>

    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

    <form action="<?= base_url('/register') ?>" method="post">
      <?= csrf_field() ?>

      <div class="form-grid-2 mb-3">
        <div class="form-group">
          <label class="form-label">Nom complet</label>
          <input type="text" name="nom" class="form-control" placeholder="Jean Dupont" value="<?= old('nom') ?>" required />
          <?php if (isset($errors['nom'])): ?>
            <span class="field-error"><?= $errors['nom'] ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label class="form-label">Adresse email</label>
          <input type="email" name="email" class="form-control" placeholder="jean@email.com" value="<?= old('email') ?>" required />
          <?php if (isset($errors['email'])): ?>
            <span class="field-error"><?= $errors['email'] ?></span>
          <?php endif; ?>
        </div>
      </div>

      <div class="form-group mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control" placeholder="8 caractères minimum" required />
        <?php if (isset($errors['password'])): ?>
          <span class="field-error"><?= $errors['password'] ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group mb-4">
        <label class="form-label">Confirmer le mot de passe</label>
        <input type="password" name="password_confirm" class="form-control" placeholder="Retapez votre mot de passe" required />
        <?php if (isset($errors['password_confirm'])): ?>
          <span class="field-error"><?= $errors['password_confirm'] ?></span>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn-primary-custom">Créer mon compte</button>
    </form>

    <hr class="auth-divider" />
    <div class="auth-footer">Déjà inscrit ? <a href="<?= base_url('/login') ?>">Se connecter</a></div>
  </div>
</div>

<?= view('layouts/footer') ?>
