<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-management-page py-5">

    <section class="container">

        <div class="employee-management-header mb-5">

            <h1 class="employee-management-title">
                Ajouter un plat
            </h1>

            <p class="employee-management-text">
                Créez une nouvelle entrée, un plat principal ou un dessert.
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
                        required
                    >

                </div>

                <div class="mb-4">

                    <label for="type_plat" class="form-label">
                        Type du plat
                    </label>

                    <select
                        id="type_plat"
                        name="type_plat"
                        class="form-select"
                        required
                    >
                        <option value="">
                            Sélectionner
                        </option>

                        <option value="Entrée">
                            Entrée
                        </option>

                        <option value="Plat principal">
                            Plat principal
                        </option>

                        <option value="Dessert">
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
                        required
                    ></textarea>

                </div>

                <div class="d-flex gap-3">

                    <button
                        type="submit"
                        class="btn employee-management-btn"
                    >
                        Créer le plat
                    </button>

                    <a
                        href="index.php?url=employe-plats"
                        class="btn btn-secondary"
                    >
                        Retour
                    </a>

                </div>

            </form>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>