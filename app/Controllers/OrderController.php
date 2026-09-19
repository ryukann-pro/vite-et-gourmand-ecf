<?php

require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/OrderModel.php';
require_once __DIR__ . '/../Models/MenuModel.php';
require_once __DIR__ . '/../Models/CityModel.php';
require_once __DIR__ . '/../Entities/Commande.php';
require_once __DIR__ . '/../Entities/Menu.php';
require_once __DIR__ . '/../Entities/Utilisateur.php';

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
        $cityModel = new CityModel();
        $cities = $cityModel->getAllCities();
        $menuModel = new MenuModel();
        $menu = $menuModel->getMenuById($menuId);
        $images = $menuModel->getImagesByMenuId($menuId);


        if (!$menu) {
            header('Location: index.php?url=menus');
            exit;
        }
        $menuEntity = new Menu(
            $menu['titre'],
            (int) $menu['nb_personnes_min'],
            (float) $menu['prix_par_personne'],
            (int) $menu['stock']
        );
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $villeId = filter_input(
                INPUT_POST,
                'ville_id',
                FILTER_VALIDATE_INT
            );

            $nbPersonnes = filter_input(
                INPUT_POST,
                'nb_personnes',
                FILTER_VALIDATE_INT
            );

            $nomClient = trim($_POST['nom_client'] ?? '');
            $prenomClient = trim($_POST['prenom_client'] ?? '');
            $telephoneClient = trim($_POST['telephone_client'] ?? '');
            $emailClient = trim($_POST['email_client'] ?? '');
            $adresseLivraison = trim($_POST['adresse_livraison'] ?? '');

            $dateLivraison = $_POST['date_livraison'] ?? '';
            $heureLivraison = $_POST['heure_livraison'] ?? '';

            
            $pretMateriel = isset($_POST['pret_materiel']);

            $dateObject = DateTime::createFromFormat(
                'Y-m-d',
                $dateLivraison
            );

            $dateValide =
                $dateObject !== false &&
                $dateObject->format('Y-m-d') === $dateLivraison;

            $heureObject = DateTime::createFromFormat(
                'H:i',
                $heureLivraison
            );

            $heureValide =
                $heureObject !== false &&
                $heureObject->format('H:i') === $heureLivraison;

            $dateHeureLivraison = DateTime::createFromFormat(
                'Y-m-d H:i',
                $dateLivraison . ' ' . $heureLivraison
            );

            $maintenant = new DateTime();
            if (
                $villeId === false ||
                $villeId === null ||
                $villeId <= 0 ||
                $nbPersonnes === false ||
                $nbPersonnes === null ||
                $nbPersonnes <= 0 ||
                $nomClient === '' ||
                $prenomClient === '' ||
                $telephoneClient === '' ||
                $emailClient === '' ||
                $adresseLivraison === '' ||
                $dateLivraison === '' ||
                $heureLivraison === ''
            ) {
                $error = "Tous les champs sont obligatoires et doivent être valides.";

            } elseif (!filter_var($emailClient, FILTER_VALIDATE_EMAIL)) {
                $error = "Adresse email invalide.";

            } elseif (!Utilisateur::telephoneValide($telephoneClient)) {
                $error = "Numéro de téléphone invalide.";
            } elseif (!$dateValide) {
                $error = "Date de livraison invalide.";

            } elseif (!$heureValide) {
                $error = "Heure de livraison invalide.";

            } elseif (
                $dateHeureLivraison === false ||
                $dateHeureLivraison <= $maintenant
            ) {
                $error = "La date et l'heure de livraison doivent être dans le futur.";

            } else {

                $city = $cityModel->getCityById($villeId);

                if (!$city) {
                    $error = "Ville invalide.";

                } elseif (!$menuEntity->respecteMinimum($nbPersonnes)) {
                    $error = "Le nombre minimum de personnes pour ce menu est de "
                        . $menuEntity->getNbPersonnesMin()
                        . ".";

                } elseif (!$menuEntity->aAssezDeStock($nbPersonnes)) {
                    $error = "Il ne reste que "
                        . $menuEntity->getStock()
                        . " places disponibles pour ce menu.";
                } else {

                    $commande = new Commande(
                        $nbPersonnes,
                        $menuEntity->getPrixParPersonne(),
                        $menuEntity->getNbPersonnesMin(),
                        (float) $city['distance_km']
                    );

                    $prixUnitaire = $menuEntity->getPrixParPersonne();

                    $fraisLivraison = $commande->calculerFraisLivraison();
                    $reduction = $commande->calculerReduction();
                    $prixTotal = $commande->calculerTotal();

                    $orderModel = new OrderModel();

                    $orderId = $orderModel->createCompleteOrder(
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

                    if ($orderId > 0) {
                        $order = $orderModel->getOrderByIdAndUserId(
                            $orderId,
                            $_SESSION['user']['id']
                        );

                        $mailService = new MailService();

                        $mailService->sendOrderConfirmationEmail($order);

                        header('Location: index.php?url=mon-compte');
                        exit;
                    }

                    $error = "Erreur lors de la commande.";
                }
            }
        }

        require_once __DIR__ . '/../Views/pages/order.php';
    }
}
