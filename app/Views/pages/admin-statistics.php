<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="admin-statistics-page py-5">
    <section class="container">

        <div class="admin-statistics-header mb-5">
            <h1 class="admin-statistics-title">Statistiques des commandes</h1>
            <p class="admin-statistics-text">
                Visualisez le nombre de commandes par menu et comparez les performances.
            </p>
        </div>

        <div class="admin-statistics-card mb-5">
            <h2 class="admin-statistics-subtitle mb-4">Commandes par menu</h2>

            <div class="statistics-chart-placeholder">
                <div class="statistics-bar" style="height: 75%;">
                    <span>12</span>
                    <p>Buffet</p>
                </div>

                <div class="statistics-bar" style="height: 50%;">
                    <span>8</span>
                    <p>Noël végé</p>
                </div>

                <div class="statistics-bar" style="height: 65%;">
                    <span>10</span>
                    <p>Vegan</p>
                </div>

                <div class="statistics-bar" style="height: 35%;">
                    <span>5</span>
                    <p>Pâques</p>
                </div>

                <div class="statistics-bar" style="height: 45%;">
                    <span>7</span>
                    <p>Cocktail</p>
                </div>

                <div class="statistics-bar" style="height: 90%;">
                    <span>15</span>
                    <p>Festif</p>
                </div>
            </div>
        </div>

        <div class="admin-statistics-card">
            <h2 class="admin-statistics-subtitle mb-4">Détail comparatif</h2>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Nombre de commandes</th>
                            <th>Part approximative</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Buffet Signature Réception</td>
                            <td>12</td>
                            <td>21%</td>
                        </tr>

                        <tr>
                            <td>Festin Végétarien de Noël</td>
                            <td>8</td>
                            <td>14%</td>
                        </tr>

                        <tr>
                            <td>Menu Vegan Équilibré</td>
                            <td>10</td>
                            <td>18%</td>
                        </tr>

                        <tr>
                            <td>Tradition Gourmande de Pâques</td>
                            <td>5</td>
                            <td>9%</td>
                        </tr>

                        <tr>
                            <td>Cocktail Vegan Événementiel</td>
                            <td>7</td>
                            <td>12%</td>
                        </tr>

                        <tr>
                            <td>Menu Festif Traditionnel</td>
                            <td>15</td>
                            <td>26%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>