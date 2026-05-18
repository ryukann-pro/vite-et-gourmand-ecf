<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="admin-dashboard-page py-5">

    <section class="container">

        <div class="admin-dashboard-header mb-5">

            <h1 class="admin-dashboard-title">
                Espace administrateur
            </h1>

            <p class="admin-dashboard-text">
                Gérez les employés, les statistiques, le chiffre d’affaires et l’ensemble de l’activité.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-12 col-md-6 col-xl-4">

                <a href="index.php?url=admin-employes" class="admin-dashboard-card">

                    <i class="bi bi-people-fill"></i>

                    <h2>
                        Employés
                    </h2>

                    <p>
                        Créer, consulter ou désactiver les comptes employés.
                    </p>

                </a>

            </div>

            <div class="col-12 col-md-6 col-xl-4">

                <a href="index.php?url=admin-statistiques" class="admin-dashboard-card">

                    <i class="bi bi-bar-chart-fill"></i>

                    <h2>
                        Statistiques
                    </h2>

                    <p>
                        Visualiser les commandes par menu et comparer les performances.
                    </p>

                </a>

            </div>

            <div class="col-12 col-md-6 col-xl-4">

                <a href="index.php?url=admin-chiffre-affaires" class="admin-dashboard-card">

                    <i class="bi bi-cash-stack"></i>

                    <h2>
                        Chiffre d’affaires
                    </h2>

                    <p>
                        Consulter le chiffre d’affaires avec filtres par menu et période.
                    </p>

                </a>

            </div>

            <div class="col-12 col-md-6 col-xl-4">

                <a href="index.php?url=employe-commandes" class="admin-dashboard-card">

                    <i class="bi bi-receipt"></i>

                    <h2>
                        Commandes
                    </h2>

                    <p>
                        Accéder à toutes les commandes et leur suivi.
                    </p>

                </a>

            </div>

            <div class="col-12 col-md-6 col-xl-4">

                <a href="index.php?url=employe-menus" class="admin-dashboard-card">

                    <i class="bi bi-card-list"></i>

                    <h2>
                        Menus & plats
                    </h2>

                    <p>
                        Gérer les menus et plats disponibles sur le site.
                    </p>

                </a>

            </div>

            <div class="col-12 col-md-6 col-xl-4">

                <a href="index.php?url=employe-avis" class="admin-dashboard-card">

                    <i class="bi bi-star-fill"></i>

                    <h2>
                        Avis clients
                    </h2>

                    <p>
                        Valider ou refuser les avis laissés par les utilisateurs.
                    </p>

                </a>

            </div>

        </div>

    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>