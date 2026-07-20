<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml"
        href="<?= BASE_URL ?>/assets/images/logo/Favico.svg">
    <title>Vite et Gourmand</title>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Playfair+Display:wght@600;700&family=Raleway:wght@500;600&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- CSS -->
    <link href="<?= BASE_URL ?>/assets/css/style.css" rel="stylesheet">
</head>

<body class="page-layout">

    <header class="site-header">

        <nav class="navbar navbar-expand-lg">

            <div class="container-fluid px-4">

                <!-- Logo -->
                <a class="navbar-brand" href="<?= BASE_URL ?>/">

                    <img src="<?= BASE_URL ?>/assets/images/logo/Logo.svg"
                        alt="Logo Vite et Gourmand"
                        class="logo-header">

                </a>

                <!-- Burger menu mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Menu navigation">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <!-- Navigation -->
                <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">

                    <ul class="navbar-nav gap-lg-4">

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?url=accueil">Accueil</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?url=menus">Menus</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?url=contact">Contact</a>
                        </li>

                        <?php if (isset($_SESSION['user'])): ?>

                            <?php if ($_SESSION['user']['role'] === 'Admin'): ?>

                                <li class="nav-item">
                                    <a href="index.php?url=espace-admin" class="nav-link">
                                        Espace admin
                                    </a>
                                </li>

                            <?php elseif ($_SESSION['user']['role'] === 'Employé'): ?>

                                <li class="nav-item">
                                    <a href="index.php?url=espace-employe" class="nav-link">
                                        Espace employé
                                    </a>
                                </li>

                            <?php else: ?>

                                <li class="nav-item">
                                    <a href="index.php?url=mon-compte" class="nav-link">
                                        Mon compte
                                    </a>
                                </li>

                            <?php endif; ?>

                            <li class="nav-item">
                                <a href="index.php?url=deconnexion" class="nav-link">
                                    Déconnexion
                                </a>
                            </li>

                        <?php else: ?>

                            <li class="nav-item">
                                <a href="index.php?url=connexion" class="nav-link">
                                    Connexion
                                </a>
                            </li>

                        <?php endif; ?>

                    </ul>

                </div>

            </div>

        </nav>

    </header>