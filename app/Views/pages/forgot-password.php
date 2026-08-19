<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="forgot-password-page py-5">

  <section class="container">

    <div class="forgot-password-card">

      <h1 class="forgot-password-title mb-4">
        Mot de passe oublié
      </h1>

      <p class="forgot-password-text mb-5">
        Entrez votre adresse email afin de recevoir
        un lien de réinitialisation.
      </p>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
          <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="alert alert-success">
          <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="index.php?url=mot-de-passe-oublie">

        <div class="mb-4">
          <label for="email" class="form-label">
            Adresse email
          </label>

          <input
            type="email"
            id="email"
            name="email"
            class="form-control"
            placeholder="Votre adresse email"
            required
          >
        </div>

        <button
          type="submit"
          class="btn forgot-password-btn w-100 mb-4">
          Valider
        </button>

      </form>

    </div>

  </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>