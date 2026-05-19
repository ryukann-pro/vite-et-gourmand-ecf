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

            <form>

                <div class="mb-4">
                    <label class="form-label">Adresse email</label>
                    <input
                        type="email"
                        class="form-control"
                        placeholder="email@exemple.fr"
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label">Mot de passe</label>
                    <input
                        type="password"
                        class="form-control"
                        placeholder="Mot de passe"
                    >
                    <small class="admin-create-employee-help">
                        L’employé recevra un mail l’informant de la création du compte, mais le mot de passe ne sera pas communiqué dans le mail.
                    </small>
                </div>

                <div class="mb-5">
                    <label class="form-label">Confirmation du mot de passe</label>
                    <input
                        type="password"
                        class="form-control"
                        placeholder="Confirmez le mot de passe"
                    >
                </div>

                <div class="admin-create-employee-actions">

                    <button type="submit" class="btn admin-create-employee-btn">
                        Créer le compte employé
                    </button>

                    <a href="index.php?url=admin-employes" class="btn account-secondary-btn">
                        Retour aux employés
                    </a>

                </div>

            </form>

        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>