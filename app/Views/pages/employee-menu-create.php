<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-management-page py-5">
    <section class="container">

        <div class="employee-management-header mb-5">
            <h1 class="employee-management-title">
                Ajouter un menu
            </h1>

            <p class="employee-management-text">
                Créez un nouveau menu en sélectionnant son entrée, son plat principal et son dessert.
            </p>
        </div>

        <div class="employee-management-card">

            <?php if ($error): ?>
                <div class="alert alert-danger mb-4">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-4">
                    <label for="titre" class="form-label">Titre</label>
                    <input
                        type="text"
                        id="titre"
                        name="titre"
                        class="form-control"
                        required>
                </div>

                <div class="mb-4">
                    <label for="description_courte" class="form-label">
                        Description courte
                    </label>

                    <textarea
                        id="description_courte"
                        name="description_courte"
                        class="form-control"
                        rows="2"
                        required></textarea>
                </div>

                <div class="mb-4">
                    <label for="description_longue" class="form-label">
                        Description longue
                    </label>

                    <textarea
                        id="description_longue"
                        name="description_longue"
                        class="form-control"
                        rows="5"
                        required></textarea>
                </div>

                <div class="row">

                    <div class="col-md-6 mb-4">
                        <label for="theme_id" class="form-label">
                            Thème
                        </label>

                        <select
                            id="theme_id"
                            name="theme_id"
                            class="form-select"
                            required>

                            <option value="">Choisir...</option>

                            <?php foreach ($themes as $theme): ?>
                                <option value="<?= $theme['id'] ?>">
                                    <?= htmlspecialchars($theme['nom']) ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="regime_id" class="form-label">
                            Régime
                        </label>

                        <select
                            id="regime_id"
                            name="regime_id"
                            class="form-select"
                            required>

                            <option value="">Choisir...</option>

                            <?php foreach ($regimes as $regime): ?>
                                <option value="<?= $regime['id'] ?>">
                                    <?= htmlspecialchars($regime['nom']) ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-4">
                        <label for="nb_personnes_min" class="form-label">
                            Nombre minimum
                        </label>

                        <input
                            type="number"
                            id="nb_personnes_min"
                            name="nb_personnes_min"
                            class="form-control"
                            min="1"
                            required>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="prix_par_personne" class="form-label">
                            Prix / personne
                        </label>

                        <input
                            type="number"
                            id="prix_par_personne"
                            name="prix_par_personne"
                            class="form-control"
                            step="0.01"
                            min="0.01"
                            required>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="stock" class="form-label">
                            Stock
                        </label>

                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            class="form-control"
                            min="0"
                            required>
                    </div>

                </div>

                <div class="mb-4">
                    <label for="conditions" class="form-label">
                        Conditions
                    </label>

                    <textarea
                        id="conditions"
                        name="conditions"
                        class="form-control"
                        rows="4"
                        required></textarea>
                </div>

                <hr class="my-5">

                <h2 class="employee-management-subtitle mb-4">
                    Composition du menu
                </h2>

                <div class="mb-4">

                    <label for="entree_id" class="form-label">
                        Entrée
                    </label>

                    <select
                        id="entree_id"
                        name="entree_id"
                        class="form-select"
                        required>

                        <option value="">Choisir une entrée...</option>

                        <?php foreach ($entrees as $plat): ?>
                            <option value="<?= $plat['id'] ?>">
                                <?= htmlspecialchars($plat['nom']) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="mb-4">

                    <label for="plat_principal_id" class="form-label">
                        Plat principal
                    </label>

                    <select
                        id="plat_principal_id"
                        name="plat_principal_id"
                        class="form-select"
                        required>

                        <option value="">Choisir un plat...</option>

                        <?php foreach ($platsPrincipaux as $plat): ?>
                            <option value="<?= $plat['id'] ?>">
                                <?= htmlspecialchars($plat['nom']) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="mb-5">

                    <label for="dessert_id" class="form-label">
                        Dessert
                    </label>

                    <select
                        id="dessert_id"
                        name="dessert_id"
                        class="form-select"
                        required>

                        <option value="">Choisir un dessert...</option>

                        <?php foreach ($desserts as $plat): ?>
                            <option value="<?= $plat['id'] ?>">
                                <?= htmlspecialchars($plat['nom']) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="mb-5">

                    <label for="menuImagesInput" class="form-label">
                        Images du menu (1 à 3)
                    </label>

                    <input
                        type="file"
                        id="menuImagesInput"
                        name="images[]"
                        class="form-control"
                        accept="image/jpeg,image/png,image/webp"
                        multiple
                        required>

                    <div id="selectedImagesList" class="mt-3"></div>

                    <small class="form-text text-muted">
                        Ajoutez entre 1 et 3 images au format JPG, PNG ou WEBP.
                    </small>
                </div>

                <button type="submit" class="btn employee-management-btn">
                    Créer le menu
                </button>

            </form>

        </div>

    </section>
</main>

<script src="<?= BASE_URL ?>/assets/js/menu-images.js"></script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>