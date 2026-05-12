<?php

require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/MenuController.php';

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

    default:
        http_response_code(404);
        echo "Page introuvable";
        break;
}