<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="employee-dashboard-page py-5">
    <section class="container">

        <div class="employee-dashboard-header mb-5">
            <h1 class="employee-dashboard-title">Espace employé</h1>
            <p class="employee-dashboard-text">
                Gérez les commandes, les menus, les plats, les horaires et les avis clients.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-12 col-md-6 col-xl-4">
                <a href="index.php?url=employe-commandes" class="employee-dashboard-card">
                    <i class="bi bi-receipt"></i>
                    <h2>Commandes</h2>
                    <p>Consulter les commandes, filtrer par statut ou client et mettre à jour leur suivi.</p>
                </a>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <a href="index.php?url=employe-menus" class="employee-dashboard-card">
                    <i class="bi bi-card-list"></i>
                    <h2>Menus</h2>
                    <p>Modifier ou supprimer les menus proposés aux clients.</p>
                </a>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <a href="index.php?url=employe-plats" class="employee-dashboard-card">
                    <i class="bi bi-egg-fried"></i>
                    <h2>Plats</h2>
                    <p>Modifier ou supprimer les plats associés aux menus.</p>
                </a>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <a href="index.php?url=employe-horaires" class="employee-dashboard-card">
                    <i class="bi bi-clock-history"></i>
                    <h2>Horaires</h2>
                    <p>Modifier les horaires d’ouverture du restaurant.</p>
                </a>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <a href="index.php?url=employe-avis" class="employee-dashboard-card">
                    <i class="bi bi-star-fill"></i>
                    <h2>Avis clients</h2>
                    <p>Valider ou refuser les avis envoyés par les utilisateurs.</p>
                </a>
            </div>

        </div>

    </section>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>