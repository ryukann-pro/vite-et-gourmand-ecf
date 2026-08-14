<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="admin-create-employee-page py-5">
    <section class="container">

        <div class="admin-create-employee-card">

            <h1 class="admin-create-employee-title mb-5">
                Modifier un employé
            </h1>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-4">
                    <label class="form-label">Nom</label>
                    <input
                        type="text"
                        name="nom"
                        class="form-control"
                        value="<?= htmlspecialchars($employee['nom'], ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label">Prénom</label>
                    <input
                        type="text"
                        name="prenom"
                        class="form-control"
                        value="<?= htmlspecialchars($employee['prenom'], ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                </div>

                <div class="mb-5">
                    <label class="form-label">Adresse email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= htmlspecialchars($employee['email'], ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                </div>

                <div class="admin-create-employee-actions">

                    <button type="submit" class="btn admin-create-employee-btn">
                        Enregistrer les modifications
                    </button>

                    <a href="index.php?url=admin-employes"
                        class="btn account-secondary-btn">
                        Retour aux employés
                    </a>

                </div>

            </form>

        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>