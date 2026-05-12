<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="menus-page py-5">

    <section class="container">
        <div class="filters-card">

            <h1 class="filters-title mb-5">Filtres</h1>

            <div class="row g-4 align-items-start">

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="filter-item">
                        <label class="form-label">Nombre de personnes</label>
                        <select class="form-select">
                            <option>Tous</option>
                            <option>10 personnes</option>
                            <option>15 personnes</option>
                            <option>20 personnes</option>
                        </select>
                        <small class="filter-help">À partir de X personnes</small>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="filter-item">
                        <label class="form-label">Régime</label>
                        <select class="form-select">
                            <option>Tous les régimes</option>
                            <option>Standard</option>
                            <option>Végétarien</option>
                            <option>Vegan</option>
                        </select>
                        <small class="filter-help invisible">placeholder</small>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="filter-item">
                        <label class="form-label">Prix par personne</label>
                        <input type="range" class="form-range" min="20" max="100" value="60">
                        <div class="d-flex justify-content-between filter-help">
                            <span>20 €</span>
                            <span>100 €</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="filter-item">
                        <label class="form-label">Thème</label>
                        <select class="form-select">
                            <option>Tous les thèmes</option>
                            <option>Classique</option>
                            <option>Événement</option>
                            <option>Pâques</option>
                            <option>Noël</option>
                        </select>
                        <small class="filter-help invisible">placeholder</small>
                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>