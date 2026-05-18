<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="profile-edit-page py-5">
    <section class="container">

        <div class="profile-edit-card">

            <h1 class="profile-edit-title mb-5">
                Modifier mes informations
            </h1>

            <form>

                <div class="row">

                    <div class="col-12 col-md-6 mb-4">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" value="Dupont">
                    </div>

                    <div class="col-12 col-md-6 mb-4">
                        <label class="form-label">Prénom</label>
                        <input type="text" class="form-control" value="Julie">
                    </div>

                </div>

                <div class="mb-4">
                    <label class="form-label">Adresse email</label>
                    <input type="email" class="form-control" value="julie@email.com">
                </div>

                <div class="mb-4">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" value="06 00 00 00 00">
                </div>

                <div class="mb-5">
                    <label class="form-label">Adresse postale</label>
                    <input type="text" class="form-control" value="12 rue Sainte-Catherine, 33000 Bordeaux">
                </div>

                <div class="profile-edit-actions">

                    <button type="submit" class="btn profile-edit-btn">
                        Enregistrer les modifications
                    </button>

                    <a href="index.php?url=mon-compte" class="btn account-secondary-btn">
                        Retour au compte
                    </a>

                </div>

            </form>

        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>