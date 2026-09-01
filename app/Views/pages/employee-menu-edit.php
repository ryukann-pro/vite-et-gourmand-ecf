<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-management-page py-5">
    <section class="container">

        <div class="employee-management-header mb-5">
            <h1 class="employee-management-title">
                Modifier un menu
            </h1>

            <p class="employee-management-text">
                Modifiez les informations et la composition du menu.
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
                    <label for="titre" class="form-label">
                        Titre
                    </label>

                    <input
                        type="text"
                        id="titre"
                        name="titre"
                        class="form-control"
                        value="<?= htmlspecialchars($menu['titre']) ?>"
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
                        required><?= htmlspecialchars($menu['description_courte']) ?></textarea>
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
                        required><?= htmlspecialchars($menu['description_longue']) ?></textarea>
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
                                <option
                                    value="<?= (int) $theme['id'] ?>"
                                    <?= (int) $theme['id'] === (int) $menu['theme_id'] ? 'selected' : '' ?>>
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
                                <option
                                    value="<?= (int) $regime['id'] ?>"
                                    <?= (int) $regime['id'] === (int) $menu['regime_id'] ? 'selected' : '' ?>>
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
                            value="<?= (int) $menu['nb_personnes_min'] ?>"
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
                            value="<?= htmlspecialchars($menu['prix_par_personne']) ?>"
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
                            value="<?= (int) $menu['stock'] ?>"
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
                        required><?= htmlspecialchars($menu['conditions']) ?></textarea>
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
                            <option
                                value="<?= (int) $plat['id'] ?>"
                                <?= (int) $plat['id'] === (int) $selectedPlats['Entrée'] ? 'selected' : '' ?>>
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
                            <option
                                value="<?= (int) $plat['id'] ?>"
                                <?= (int) $plat['id'] === (int) $selectedPlats['Plat principal'] ? 'selected' : '' ?>>
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
                            <option
                                value="<?= (int) $plat['id'] ?>"
                                <?= (int) $plat['id'] === (int) $selectedPlats['Dessert'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($plat['nom']) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="mb-5">

                    <p class="form-label">
                        Images actuelles
                    </p>

                    <div class="d-flex gap-3 flex-wrap mb-3">
                        <?php foreach ($images as $image): ?>
                            <img
                                src="<?= BASE_URL ?>/<?= htmlspecialchars($image['url']) ?>"
                                alt="<?= htmlspecialchars($image['texte_alternatif'] ?? $menu['titre']) ?>"
                                style="width: 160px; height: 100px; object-fit: cover; border-radius: 8px;">
                        <?php endforeach; ?>
                    </div>

                    <label for="menuImagesInput" class="form-label">
                        Remplacer les images du menu
                    </label>

                    <input
                        type="file"
                        id="menuImagesInput"
                        name="images[]"
                        class="form-control"
                        accept="image/jpeg,image/png,image/webp"
                        multiple>

                    <div id="selectedImagesList" class="mt-3"></div>

                    <small class="form-text text-muted">
                        Laissez vide pour conserver les images actuelles.
                        Sinon, ajoutez entre 1 et 3 nouvelles images.
                    </small>
                </div>

                <button type="submit" class="btn employee-management-btn">
                    Enregistrer les modifications
                </button>

                <a
                    href="index.php?url=employe-menus"
                    class="btn btn-secondary ms-2">
                    Retour
                </a>

            </form>

        </div>

    </section>
</main>

<script src="<?= BASE_URL ?>/assets/js/menu-images.js"></script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>