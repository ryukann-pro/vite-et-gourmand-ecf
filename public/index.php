<?php

require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/MenuController.php';
require_once __DIR__ . '/../app/Controllers/MenuDetailController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';

$url = $_GET['url'] ?? 'accueil';

switch ($url) {

    case 'accueil':
        $controller = new HomeController();
        $controller->index();
        break;

    case 'menus':
        $controller = new MenuController();
        $controller->index();
        break;
    case 'menu-detail':
        $controller = new MenuDetailController();
        $controller->index();
        break;
    case 'connexion':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'inscription':
        $controller = new AuthController();
        $controller->register();
        break;
    default:
        http_response_code(404);
        echo "Page introuvable";
        break;
}