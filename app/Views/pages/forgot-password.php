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

      <form>

        <div class="mb-4">
          <label for="email" class="form-label">
            Adresse email
          </label>

          <input type="email" id="email" class="form-control" placeholder="Votre adresse email">
        </div>

        <button type="submit" class="btn forgot-password-btn w-100 mb-4">
          Valider
        </button>
      </form>

    </div>

  </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>