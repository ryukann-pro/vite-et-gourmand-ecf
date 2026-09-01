<?php require_once __DIR__ . '/../layouts/header.php';
?>

<main class="menus-page py-5">

    <section class="container">
        <div class="filters-card">

            <h1 class="filters-title mb-5">Filtres</h1>

            <div class="row g-4 align-items-start">

                <div class="col-12 col-md-6 col-lg">
                    <div class="filter-item">
                        <label for="peopleFilter" class="form-label">
                            Nombre de personnes
                        </label>

                        <input
                            type="number"
                            id="peopleFilter"
                            class="form-control"
                            min="1"
                            placeholder="Ex : 10">

                        <small class="filter-help">
                            Nombre de personnes prévu
                        </small>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg">
                    <div class="filter-item">
                        <label for="regimeFilter" class="form-label">
                            Régime
                        </label>

                        <select id="regimeFilter" class="form-select">
                            <option value="">Tous les régimes</option>
                            <option value="Standard">Standard</option>
                            <option value="Vegan">Vegan</option>
                            <option value="Végétarien">Végétarien</option>
                        </select>

                        <small class="filter-help invisible">
                            placeholder
                        </small>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg">
                    <div class="filter-item">

                        <label for="priceMinFilter" class="form-label">
                            Prix minimum
                        </label>

                        <input
                            type="number"
                            id="priceMinFilter"
                            class="form-control"
                            min="0"
                            placeholder="Ex : 20">

                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg">
                    <div class="filter-item">

                        <label for="priceMaxFilter" class="form-label">
                            Prix maximum
                        </label>

                        <input
                            type="number"
                            id="priceMaxFilter"
                            class="form-control"
                            min="0"
                            placeholder="Ex : 50">

                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg">
                    <div class="filter-item">
                        <label for="themeFilter" class="form-label">
                            Thème
                        </label>

                        <select id="themeFilter" class="form-select">
                            <option value="">Tous les thèmes</option>
                            <option value="Classique">Classique</option>
                            <option value="Événement">Événement</option>
                            <option value="Noël">Noël</option>
                            <option value="Pâques">Pâques</option>
                        </select>

                        <small class="filter-help invisible">
                            placeholder
                        </small>
                    </div>
                </div>

            </div>

            <div class="col-12 mt-3 d-flex justify-content-center">
                <button
                    type="button"
                    id="resetFilters"
                    class="btn btn-outline-secondary">
                    Réinitialiser les filtres
                </button>
            </div>

        </div>
    </section>

    <section class="container menus-list-section">
        <div id="menusContainer" class="row g-5">

            <?php foreach ($menus as $menu): ?>

                <div class="col-12 col-md-6 col-xl-4">
                    <article class="menu-card">

                        <div class="menu-card-img-wrapper">
                            <img
                                src="<?= BASE_URL ?>/<?= htmlspecialchars($menu['image_url'] ?? 'assets/images/menus/default.jpg') ?>"
                                alt="<?= htmlspecialchars($menu['texte_alternatif'] ?? $menu['titre']) ?>"
                                class="menu-card-img">
                        </div>

                        <div class="menu-card-body">

                            <h2 class="menu-card-title">
                                <?= htmlspecialchars($menu['titre']) ?>
                            </h2>

                            <p class="menu-card-description">
                                <?= htmlspecialchars($menu['description_courte']) ?>
                            </p>

                            <div class="menu-card-info">
                                <span>
                                    Min. <?= (int) $menu['nb_personnes_min'] ?> personnes
                                </span>

                                <span>
                                    <?= htmlspecialchars($menu['regime']) ?>
                                </span>

                                <strong>
                                    <?= number_format($menu['prix_par_personne'], 0, ',', ' ') ?> € par personne
                                </strong>
                            </div>

                            <a
                                href="index.php?url=menu-detail&id=<?= (int) $menu['id'] ?>"
                                class="btn menu-card-btn">
                                Voir les détails du menu
                            </a>

                        </div>

                    </article>
                </div>

            <?php endforeach; ?>

        </div>
    </section>

</main>

<script>
    window.APP_BASE_URL = <?= json_encode(BASE_URL) ?>;
</script>

<script src="<?= BASE_URL ?>/assets/js/menu-filters.js"></script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>