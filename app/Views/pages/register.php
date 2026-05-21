<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="register-page py-5">

    <section class="container">

        <div class="register-card">

            <h1 class="register-title mb-5">
                Créer un compte
            </h1>

            <form method="POST">
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                <div class="mb-4">
                    <label for="lastname" class="form-label">
                        Nom
                    </label>

                    <input type="text" id="lastname" name="nom" class="form-control" placeholder="Votre nom" required
                        autocomplete="family-name">
                </div>

                <div class="mb-4">
                    <label for="firstname" class="form-label">
                        Prénom
                    </label>

                    <input type="text" id="firstname" name="prenom" class="form-control" placeholder="Votre prénom"
                        required autocomplete="given-name">
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label">
                        Numéro de téléphone
                    </label>

                    <input type="tel" id="phone" name="telephone" class="form-control"
                        placeholder="Votre numéro de téléphone" pattern="^0[1-9][0-9]{8}$"
                        title="Veuillez entrer un numéro français valide à 10 chiffres." required>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">
                        Adresse email
                    </label>

                    <input type="email" id="email" name="email" class="form-control" maxlength="191"
                        autocomplete="email" placeholder="Votre adresse email" required>
                </div>

                <div class="mb-4">
                    <label for="address" class="form-label">
                        Adresse postale
                    </label>

                    <input type="text" id="address" name="adresse" class="form-control" placeholder="Votre adresse"
                        required autocomplete="street-address">
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">
                        Mot de passe
                    </label>

                    <input type="password" id="password" name="password" class="form-control" minlength="10"
                        maxlength="255" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{10,}"
                        title="Le mot de passe doit contenir au moins 10 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial."
                        placeholder="Votre mot de passe" required autocomplete="new-password">

                    <small class="password-help">
                        10 caractères minimum avec majuscule,
                        minuscule, chiffre et caractère spécial.
                    </small>
                </div>

                <div class="mb-4">
                    <label for="confirm-password" class="form-label">
                        Confirmer le mot de passe
                    </label>

                    <input type="password" id="confirm-password" name="confirm_password" class="form-control"
                        minlength="10" maxlength="255" placeholder="Confirmez votre mot de passe" required
                        autocomplete="new-password">
                </div>

                <button type="submit" class="btn register-btn w-100 mb-4">
                    S'inscrire
                </button>

                <p class="login-text mb-0">
                    Vous avez déjà un compte ?

                    <a href="index.php?url=connexion" class="login-link">
                        Se connecter
                    </a>
                </p>

            </form>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>