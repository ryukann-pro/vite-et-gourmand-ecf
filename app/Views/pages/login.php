<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="login-page py-5">

    <section class="container">

        <div class="login-card">

            <h1 class="login-title mb-5">
                Connexion
            </h1>
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form method="post">

                <div class="mb-4">
                    <label for="email" class="form-label">
                        Adresse email
                    </label>

                    <input type="email" id="email" name="email" class="form-control" placeholder="Votre adresse email"
                        maxlength="191" autocomplete="email" required>
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">
                        Mot de passe
                    </label>

                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Votre mot de passe" minlength="10" maxlength="255" autocomplete="current-password"
                        required>
                </div>

                <div class="text-end mb-4 text-center">
                    <a href="#" class="forgot-password-link">
                        Mot de passe oublié ?
                    </a>
                </div>

                <button type="submit" class="btn login-btn w-100 mb-4">
                    Se connecter
                </button>

                <p class="register-text mb-0">
                    Vous n’avez pas de compte ?

                    <a href="index.php?url=inscription" class="register-link">
                        Créer un compte
                    </a>
                </p>

            </form>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>