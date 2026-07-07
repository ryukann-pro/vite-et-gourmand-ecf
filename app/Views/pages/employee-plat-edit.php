<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-management-page py-5">

    <section class="container">

        <div class="employee-management-header mb-5">
            <h1 class="employee-management-title">
                Modifier un plat
            </h1>

            <p class="employee-management-text">
                Modifiez les informations du plat sélectionné.
            </p>
        </div>

        <div class="employee-management-card">

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-4">
                    <label for="nom" class="form-label">
                        Nom du plat
                    </label>

                    <input
                        type="text"
                        id="nom"
                        name="nom"
                        class="form-control"
                        value="<?= htmlspecialchars($plat['nom']) ?>"
                        required>
                </div>

                <div class="mb-4">
                    <label for="type_plat" class="form-label">
                        Type du plat
                    </label>

                    <select
                        id="type_plat"
                        name="type_plat"
                        class="form-select"
                        required>
                        <option value="Entrée" <?= $plat['type_plat'] === 'Entrée' ? 'selected' : '' ?>>
                            Entrée
                        </option>

                        <option value="Plat principal" <?= $plat['type_plat'] === 'Plat principal' ? 'selected' : '' ?>>
                            Plat principal
                        </option>

                        <option value="Dessert" <?= $plat['type_plat'] === 'Dessert' ? 'selected' : '' ?>>
                            Dessert
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        rows="5"
                        required><?= htmlspecialchars($plat['description']) ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label">
                        Allergènes
                    </label>

                    <div class="row">

                        <?php foreach ($allergenes as $allergene): ?>

                            <div class="col-md-4 mb-2">
                                <div class="form-check">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="allergenes[]"
                                        value="<?= (int) $allergene['id'] ?>"
                                        id="allergene<?= (int) $allergene['id'] ?>"
                                        <?= in_array((int) $allergene['id'], array_map('intval', $selectedAllergenes), true) ? 'checked' : '' ?>>

                                    <label
                                        class="form-check-label"
                                        for="allergene<?= (int) $allergene['id'] ?>">

                                        <?= htmlspecialchars($allergene['nom']) ?>

                                    </label>

                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>

                    <small class="form-text text-muted">
                        Cochez les allergènes présents dans ce plat.
                    </small>
                </div>

                <div class="d-flex gap-3">

                    <button
                        type="submit"
                        class="btn employee-management-btn">
                        Enregistrer les modifications
                    </button>

                    <a
                        href="index.php?url=employe-plats"
                        class="btn btn-secondary">
                        Retour
                    </a>

                </div>

            </form>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>