<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="admin-create-employee-page py-5">
    <section class="container">

        <div class="admin-create-employee-card">

            <h1 class="admin-create-employee-title mb-5">
                Créer un compte employé
            </h1>

            <div class="alert alert-info admin-create-employee-info mb-5">
                Le compte créé sera uniquement de type employé. Il ne sera pas possible de créer un compte administrateur depuis l’application.
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-4">
                    <label for="nom" class="form-label">Nom</label>
                    <input
                        type="text"
                        id="nom"
                        name="nom"
                        class="form-control"
                        placeholder="Nom"
                        required>
                </div>

                <div class="mb-4">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input
                        type="text"
                        id="prenom"
                        name="prenom"
                        class="form-control"
                        placeholder="Prénom"
                        required>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Adresse email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="email@exemple.fr"
                        required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Mot de passe"
                        required>

                    <small class="admin-create-employee-help">
                        L’employé recevra un mail l’informant de la création du compte,
                        mais le mot de passe ne sera pas communiqué dans le mail.
                    </small>
                </div>

                <div class="mb-5">
                    <label for="confirm_password" class="form-label">
                        Confirmation du mot de passe
                    </label>
                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        class="form-control"
                        placeholder="Confirmez le mot de passe"
                        required>
                </div>

                <div class="admin-create-employee-actions">

                    <button type="submit" class="btn admin-create-employee-btn">
                        Créer le compte employé
                    </button>

                    <a
                        href="index.php?url=admin-employes"
                        class="btn account-secondary-btn">
                        Retour aux employés
                    </a>

                </div>

            </form>

        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>