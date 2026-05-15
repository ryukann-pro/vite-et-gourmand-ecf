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
    <section class="container menus-list-section">
        <div class="row g-5">

            <div class="col-12 col-md-6 col-xl-4">
                <article class="menu-card">
                    <div class="menu-card-img-wrapper">
                        <img src="/vite-et-gourmand-ecf/public/assets/images/menus/evenement/buffet-signature-reception/standard-1.jpg"
                            alt="Buffet Signature Réception" class="menu-card-img">
                    </div>

                    <div class="menu-card-body">
                        <h2 class="menu-card-title">Buffet Signature Réception</h2>

                        <p class="menu-card-description">
                            Buffet traiteur complet pour réceptions professionnelles ou privées, équilibré et gourmand.
                        </p>

                        <div class="menu-card-info">
                            <span>Min. 10 personnes</span>
                            <span>Classique</span>
                            <strong>18 € par personne</strong>
                        </div>

                        <a href="#" class="btn menu-card-btn">Voir les détails du menu</a>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <article class="menu-card">
                    <div class="menu-card-img-wrapper">
                        <img src="/vite-et-gourmand-ecf/public/assets/images/menus/noel/festin-vegetarien-de-noel/vegetarien-1.jpg"
                            alt="Festin Végétarien de Noël" class="menu-card-img">
                    </div>

                    <div class="menu-card-body">
                        <h2 class="menu-card-title">Festin Végétarien de Noël</h2>

                        <p class="menu-card-description">
                            Menu festif végétarien de Noël avec plats chauds et accompagnements de saison.
                        </p>

                        <div class="menu-card-info">
                            <span>Min. 8 personnes</span>
                            <span>Végétarien</span>
                            <strong>22 € par personne</strong>
                        </div>

                        <a href="#" class="btn menu-card-btn">Voir les détails du menu</a>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <article class="menu-card">
                    <div class="menu-card-img-wrapper">
                        <img src="/vite-et-gourmand-ecf/public/assets/images/menus/classique/menu-vegan-equilibre/vegan-1.jpg"
                            alt="Menu Vegan Équilibré" class="menu-card-img">
                    </div>

                    <div class="menu-card-body">
                        <h2 class="menu-card-title">Menu Vegan Équilibré</h2>

                        <p class="menu-card-description">
                            Menu vegan complet et équilibré pour repas du quotidien.
                        </p>

                        <div class="menu-card-info">
                            <span>Min. 6 personnes</span>
                            <span>Vegan</span>
                            <strong>20 € par personne</strong>
                        </div>

                        <a href="#" class="btn menu-card-btn">Voir les détails du menu</a>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <article class="menu-card">
                    <div class="menu-card-img-wrapper">
                        <img src="/vite-et-gourmand-ecf/public/assets/images/menus/paques/tradition-gourmande-de-paques/standard-1.jpg"
                            alt="Tradition Gourmande de Pâques" class="menu-card-img">
                    </div>

                    <div class="menu-card-body">
                        <h2 class="menu-card-title">Tradition Gourmande de Pâques</h2>

                        <p class="menu-card-description">
                            Menu traditionnel de Pâques avec plats rôtis et garnitures printanières.
                        </p>

                        <div class="menu-card-info">
                            <span>Min. 8 personnes</span>
                            <span>Classique</span>
                            <strong>24 € par personne</strong>
                        </div>

                        <a href="#" class="btn menu-card-btn">Voir les détails du menu</a>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <article class="menu-card">
                    <div class="menu-card-img-wrapper">
                        <img src="/vite-et-gourmand-ecf/public/assets/images/menus/evenement/cocktail-vegan-evenementiel/vegan-1.jpg"
                            alt="Cocktail Vegan Événementiel" class="menu-card-img">
                    </div>

                    <div class="menu-card-body">
                        <h2 class="menu-card-title">Cocktail Vegan Événementiel</h2>

                        <p class="menu-card-description">
                            Buffet vegan moderne avec finger food pour événements.
                        </p>

                        <div class="menu-card-info">
                            <span>Min. 15 personnes</span>
                            <span>Vegan</span>
                            <strong>21 € par personne</strong>
                        </div>

                        <a href="#" class="btn menu-card-btn">Voir les détails du menu</a>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <article class="menu-card">
                    <div class="menu-card-img-wrapper">
                        <img src="/vite-et-gourmand-ecf/public/assets/images/menus/noel/menu-festif-traditionnel/standard-1.jpg"
                            alt="Menu festif traditionnel" class="menu-card-img">
                    </div>

                    <div class="menu-card-body">
                        <h2 class="menu-card-title">Menu festif traditionnel</h2>

                        <p class="menu-card-description">
                            Menu festif traditionnel de Noël avec plats chauds et accompagnements de saison.
                        </p>

                        <div class="menu-card-info">
                            <span>Min. 5 personnes</span>
                            <span>Classique</span>
                            <strong>32 € par personne</strong>
                        </div>

                        <a href="#" class="btn menu-card-btn">Voir les détails du menu</a>
                    </div>
                </article>
            </div>

        </div>
    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>