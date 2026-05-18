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
    <link href="/vite-et-gourmand-ecf/public/assets/css/style.css" rel="stylesheet">
</head>

<body class="page-layout">

    <header class="site-header">

        <nav class="navbar navbar-expand-lg">

            <div class="container-fluid px-4">

                <!-- Logo -->
                <a class="navbar-brand" href="/vite-et-gourmand-ecf/public/">

                    <img src="/vite-et-gourmand-ecf/public/assets/images/logo/logo.svg" alt="Logo Vite et Gourmand"
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
                            <a class="nav-link" href="#">Accueil</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Menus</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>

                        <?php if (isset($_SESSION['user'])): ?>

                            <a href="index.php?url=mon-compte" class="nav-link">
                                Mon compte
                            </a>

                            <a href="index.php?url=deconnexion" class="nav-link">
                                Déconnexion
                            </a>

                        <?php else: ?>

                            <a href="index.php?url=connexion" class="nav-link">
                                Connexion
                            </a>

                        <?php endif; ?>

                    </ul>

                </div>

            </div>

        </nav>

    </header>