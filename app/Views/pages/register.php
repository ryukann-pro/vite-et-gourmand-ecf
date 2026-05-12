<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="register-page py-5">

    <section class="container">

        <div class="register-card">

            <h1 class="register-title mb-5">
                Créer un compte
            </h1>

            <form>

                <div class="mb-4">
                    <label for="lastname" class="form-label">
                        Nom
                    </label>

                    <input
                        type="text"
                        id="lastname"
                        class="form-control"
                        placeholder="Votre nom"
                    >
                </div>

                <div class="mb-4">
                    <label for="firstname" class="form-label">
                        Prénom
                    </label>

                    <input
                        type="text"
                        id="firstname"
                        class="form-control"
                        placeholder="Votre prénom"
                    >
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label">
                        Numéro de téléphone
                    </label>

                    <input
                        type="tel"
                        id="phone"
                        class="form-control"
                        placeholder="Votre numéro de téléphone"
                    >
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">
                        Adresse email
                    </label>

                    <input
                        type="email"
                        id="email"
                        class="form-control"
                        placeholder="Votre adresse email"
                    >
                </div>

                <div class="mb-4">
                    <label for="address" class="form-label">
                        Adresse postale
                    </label>

                    <input
                        type="text"
                        id="address"
                        class="form-control"
                        placeholder="Votre adresse"
                    >
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">
                        Mot de passe
                    </label>

                    <input
                        type="password"
                        id="password"
                        class="form-control"
                        placeholder="Votre mot de passe"
                    >

                    <small class="password-help">
                        10 caractères minimum avec majuscule,
                        minuscule, chiffre et caractère spécial.
                    </small>
                </div>

                <div class="mb-4">
                    <label for="confirm-password" class="form-label">
                        Confirmer le mot de passe
                    </label>

                    <input
                        type="password"
                        id="confirm-password"
                        class="form-control"
                        placeholder="Confirmez votre mot de passe"
                    >
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