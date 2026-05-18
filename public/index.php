<?php

require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/MenuController.php';
require_once __DIR__ . '/../app/Controllers/MenuDetailController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/ContactController.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';
require_once __DIR__ . '/../app/Controllers/OrderController.php';

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
    case 'deconnexion':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'inscription':
        $controller = new AuthController();
        $controller->register();
        break;
    case 'mot-de-passe-oublie':
        $controller = new AuthController();
        $controller->forgotPassword();
        break;
    case 'contact':
        $controller = new ContactController();
        $controller->index();
        break;
    case 'mon-compte':
        $controller = new UserController();
        $controller->account();
        break;
    case 'commande':
        $controller = new OrderController();
        $controller->create();
        break;
    default:
        http_response_code(404);
        echo "Page introuvable";
        break;
}