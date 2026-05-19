<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="admin-turnover-page py-5">
    <section class="container">

        <div class="admin-turnover-header mb-5">
            <h1 class="admin-turnover-title">Chiffre d’affaires</h1>
            <p class="admin-turnover-text">
                Consultez le chiffre d’affaires par menu avec des filtres par menu et par période.
            </p>
        </div>

        <div class="admin-turnover-card mb-5">
            <h2 class="admin-turnover-subtitle mb-4">Filtres</h2>

            <div class="row g-4">
                <div class="col-12 col-lg-4">
                    <label class="form-label">Menu</label>
                    <select class="form-select">
                        <option>Tous les menus</option>
                        <option>Buffet Signature Réception</option>
                        <option>Festin Végétarien de Noël</option>
                        <option>Menu Vegan Équilibré</option>
                        <option>Tradition Gourmande de Pâques</option>
                        <option>Cocktail Vegan Événementiel</option>
                        <option>Menu Festif Traditionnel</option>
                    </select>
                </div>

                <div class="col-12 col-lg-3">
                    <label class="form-label">Date début</label>
                    <input type="date" class="form-control">
                </div>

                <div class="col-12 col-lg-3">
                    <label class="form-label">Date fin</label>
                    <input type="date" class="form-control">
                </div>

                <div class="col-12 col-lg-2 d-flex align-items-end">
                    <button class="btn admin-turnover-btn w-100">
                        Filtrer
                    </button>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-12 col-md-4">
                <div class="admin-turnover-stat-card">
                    <span>Total CA</span>
                    <strong>4 850 €</strong>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="admin-turnover-stat-card">
                    <span>Commandes</span>
                    <strong>57</strong>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="admin-turnover-stat-card">
                    <span>Menu le plus rentable</span>
                    <strong>Menu Festif</strong>
                </div>
            </div>
        </div>

        <div class="admin-turnover-card">
            <h2 class="admin-turnover-subtitle mb-4">Chiffre d’affaires par menu</h2>

            <div class="table-responsive">
                <table class="table align-middle admin-turnover-table">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Commandes</th>
                            <th>Chiffre d’affaires</th>
                            <th>Prix moyen</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Buffet Signature Réception</td>
                            <td>12</td>
                            <td>1 080 €</td>
                            <td>90 €</td>
                        </tr>

                        <tr>
                            <td>Festin Végétarien de Noël</td>
                            <td>8</td>
                            <td>704 €</td>
                            <td>88 €</td>
                        </tr>

                        <tr>
                            <td>Menu Vegan Équilibré</td>
                            <td>10</td>
                            <td>800 €</td>
                            <td>80 €</td>
                        </tr>

                        <tr>
                            <td>Tradition Gourmande de Pâques</td>
                            <td>5</td>
                            <td>600 €</td>
                            <td>120 €</td>
                        </tr>

                        <tr>
                            <td>Cocktail Vegan Événementiel</td>
                            <td>7</td>
                            <td>735 €</td>
                            <td>105 €</td>
                        </tr>

                        <tr>
                            <td>Menu Festif Traditionnel</td>
                            <td>15</td>
                            <td>1 920 €</td>
                            <td>128 €</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>