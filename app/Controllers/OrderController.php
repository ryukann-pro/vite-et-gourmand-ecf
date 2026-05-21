<?php

require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/OrderModel.php';
require_once __DIR__ . '/../Models/MenuModel.php';

class OrderController
{
    public function create(): void
    {
        Auth::requireRole(['Client']);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = null;

        $menuId = (int) ($_GET['id'] ?? 0);
        $villeId = (int) ($_POST['ville_id'] ?? 0);
        $menuModel = new MenuModel();
        $menu = $menuModel->getMenuById($menuId);
        $images = $menuModel->getImagesByMenuId($menuId);

        if (!$menu) {
            header('Location: index.php?url=menus');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nomClient = trim($_POST['nom_client'] ?? '');
            $prenomClient = trim($_POST['prenom_client'] ?? '');
            $telephoneClient = trim($_POST['telephone_client'] ?? '');
            $emailClient = trim($_POST['email_client'] ?? '');

            $nbPersonnes = (int) ($_POST['nb_personnes'] ?? 0);

            $adresseLivraison = trim($_POST['adresse_livraison'] ?? '');

            $dateLivraison = $_POST['date_livraison'] ?? '';
            $dateToday = date('Y-m-d');
            $heureLivraison = $_POST['heure_livraison'] ?? '';

            $pretMateriel = isset($_POST['pret_materiel']);

            if (
                $villeId <= 0 ||
                $nomClient === '' ||
                $prenomClient === '' ||
                $telephoneClient === '' ||
                $emailClient === '' ||
                $nbPersonnes <= 0 ||
                $adresseLivraison === '' ||
                $dateLivraison === '' ||
                $heureLivraison === ''
            ) {
                $error = "Tous les champs sont obligatoires.";
            } elseif ($nbPersonnes < (int) $menu['nb_personnes_min']) {
                $error = "Le nombre minimum de personnes pour ce menu est de " . (int) $menu['nb_personnes_min'] . ".";
            } elseif ($dateLivraison < $dateToday) {
                $error = "La date de livraison ne peut pas être dans le passé.";
            } else {

                $prixUnitaire = (float) $menu['prix_par_personne'];

                $fraisLivraison = 0;
                $reduction = 0;

                $prixTotal = $prixUnitaire * $nbPersonnes;

                $orderModel = new OrderModel();

                $orderCreated = $orderModel->createOrder(
                    $nomClient,
                    $prenomClient,
                    $telephoneClient,
                    $emailClient,
                    $nbPersonnes,
                    $prixUnitaire,
                    $adresseLivraison,
                    $dateLivraison,
                    $heureLivraison,
                    $fraisLivraison,
                    $reduction,
                    $prixTotal,
                    $pretMateriel,
                    $_SESSION['user']['id'],
                    $menuId,
                    $villeId,
                    1
                );

                if ($orderCreated) {

                    header('Location: index.php?url=mon-compte');
                    exit;
                }

                $error = "Erreur lors de la commande.";
            }
        }

        require_once __DIR__ . '/../Views/pages/order.php';
    }
}