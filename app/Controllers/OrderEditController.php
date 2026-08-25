<?php

require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/OrderModel.php';
require_once __DIR__ . '/../Models/CityModel.php';
require_once __DIR__ . '/../Entities/Commande.php';

class OrderEditController
{
    public function edit(): void
    {
        Auth::requireRole(['Client']);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = null;

        $orderId = (int) ($_GET['id'] ?? 0);

        $orderModel = new OrderModel();

        $order = $orderModel->getOrderByIdAndUserId(
            $orderId,
            $_SESSION['user']['id']
        );

        if (!$order) {
            http_response_code(404);
            echo "Commande introuvable";
            return;
        }

        if (!in_array($order['statut_id'], [1, 2])) {
            echo "Cette commande ne peut plus être modifiée.";
            return;
        }

        $cityModel = new CityModel();
        $cities = $cityModel->getAllCities();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $villeId = (int) ($_POST['ville_id'] ?? 0);

            $city = $cityModel->getCityById($villeId);

            $adresseLivraison = trim($_POST['adresse_livraison'] ?? '');

            $dateLivraison = $_POST['date_livraison'] ?? '';
            $heureLivraison = $_POST['heure_livraison'] ?? '';

            $nbPersonnes = (int) ($_POST['nb_personnes'] ?? 0);

            $pretMateriel = isset($_POST['pret_materiel']);

            $dateToday = date('Y-m-d');

            $maxPersonnes =
                (int) $order['menu_stock']
                + (int) $order['nb_personnes'];

            if (
                !$city ||
                $adresseLivraison === '' ||
                $dateLivraison === '' ||
                $heureLivraison === '' ||
                $nbPersonnes <= 0
            ) {
                $error = "Tous les champs sont obligatoires.";
            } elseif ($nbPersonnes < (int) $order['menu_nb_personnes_min']) {
                $error = "Le nombre minimum de personnes pour ce menu est de "
                    . (int) $order['menu_nb_personnes_min']
                    . ".";
            } elseif ($nbPersonnes > $maxPersonnes) {
                $error = "Il ne reste pas assez de stock disponible pour cette quantité.";
            } elseif ($dateLivraison < $dateToday) {
                $error = "La date de livraison ne peut pas être dans le passé.";
            } else {

                $commande = new Commande(
                    $nbPersonnes,
                    (float) $order['prix_unitaire'],
                    (int) $order['menu_nb_personnes_min'],
                    (float) $city['distance_km']
                );
                

                $fraisLivraison = $commande->calculerFraisLivraison();
                $reduction = $commande->calculerReduction();
                $prixTotal = $commande->calculerTotal();

                $updated = $orderModel->updateCompleteOrder(
                    $orderId,
                    $_SESSION['user']['id'],
                    $adresseLivraison,
                    $dateLivraison,
                    $heureLivraison,
                    $nbPersonnes,
                    $villeId,
                    $fraisLivraison,
                    $reduction,
                    $prixTotal,
                    $pretMateriel
                );

                if ($updated) {

                    header('Location: index.php?url=detail-commande&id=' . $orderId);
                    exit;
                }

                $error = "Erreur lors de la modification.";
            }
        }

        require_once __DIR__ . '/../Views/pages/order-edit.php';
    }
}
