<?php

require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/MenuController.php';
require_once __DIR__ . '/../app/Controllers/MenuDetailController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/ContactController.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';
require_once __DIR__ . '/../app/Controllers/OrderController.php';
require_once __DIR__ . '/../app/Controllers/OrderDetailController.php';
require_once __DIR__ . '/../app/Controllers/OrderEditController.php';
require_once __DIR__ . '/../app/Controllers/ProfileController.php';
require_once __DIR__ . '/../app/Controllers/EmployeeController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';
require_once __DIR__ . '/../app/Helpers/Auth.php';
require_once __DIR__ . '/../app/Controllers/ReviewController.php';
require_once __DIR__ . '/../app/Controllers/EmployeeReviewController.php';

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
    case 'modifier-profil':
        $controller = new ProfileController();
        $controller->edit();
        break;
    case 'commande':
        $controller = new OrderController();
        $controller->create();
        break;
    case 'detail-commande':
        $controller = new OrderDetailController();
        $controller->index();
        break;
    case 'modifier-commande':
        $controller = new OrderEditController();
        $controller->edit();
        break;
    case 'espace-employe':
        $controller = new EmployeeController();
        $controller->dashboard();
        break;
    case 'employe-commandes':
        $controller = new EmployeeController();
        $controller->orders();
        break;
    case 'employe-detail-commande':
        $controller = new EmployeeController();
        $controller->orderDetail();
        break;
    case 'employe-avis':
        $controller = new EmployeeReviewController();
        $controller->index();
        break;
    case 'employe-menus':
        $controller = new EmployeeController();
        $controller->menus();
        break;
    case 'employe-plats':
        $controller = new EmployeeController();
        $controller->plates();
        break;
    case 'employe-horaires':
        $controller = new EmployeeController();
        $controller->hours();
        break;
    case 'espace-admin':
        $controller = new AdminController();
        $controller->dashboard();
        break;
    case 'admin-employes':
        $controller = new AdminController();
        $controller->employees();
        break;
    case 'admin-creation-employe':
        $controller = new AdminController();
        $controller->createEmployee();
        break;
    case 'admin-statistiques':
        $controller = new AdminController();
        $controller->statistics();
        break;
    case 'admin-chiffre-affaires':
        $controller = new AdminController();
        $controller->turnover();
        break;
    case 'annuler-commande':
        $controller = new OrderDetailController();
        $controller->cancel();
        break;
    case 'laisser-avis':
        $controller = new ReviewController();
        $controller->create();
        break;
    case 'valider-avis':
        $controller = new EmployeeReviewController();
        $controller->validate();
        break;
    case 'refuser-avis':
        $controller = new EmployeeReviewController();
        $controller->delete();
        break;
    case 'supprimer-avis':
        $controller = new EmployeeReviewController();
        $controller->delete();
        break;
    case 'api-menus':
        $controller = new MenuController();
        $controller->apiSearch();
        break;
    default:
        http_response_code(404);
        echo "Page introuvable";
        break;
}