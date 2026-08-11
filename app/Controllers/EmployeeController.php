<?php

require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/HoraireModel.php';
require_once __DIR__ . '/../Models/PlatModel.php';
require_once __DIR__ . '/../Models/OrderModel.php';
require_once __DIR__ . '/../Models/MenuModel.php';

class EmployeeController
{
    public function dashboard(): void
    {
        Auth::requireRole(['Employé', 'Admin']);
        require_once __DIR__ . '/../Views/pages/employee-dashboard.php';
    }

    public function orders(): void
    {
        Auth::requireRole(['Employé', 'Admin']);

        $statusId = isset($_GET['statut_id']) ? (int) $_GET['statut_id'] : 0;
        $clientSearch = trim($_GET['client'] ?? '');

        $orderModel = new OrderModel();

        $orders = $orderModel->searchOrders(
            $statusId > 0 ? $statusId : null,
            $clientSearch !== '' ? $clientSearch : null
        );

        require_once __DIR__ . '/../Views/pages/employee-orders.php';
    }

    public function orderDetail(): void
    {
        Auth::requireRole(['Employé', 'Admin']);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $orderId = (int) ($_GET['id'] ?? 0);

        $orderModel = new OrderModel();
        $order = $orderModel->getOrderByIdForEmployee($orderId);

        if (!$order) {
            http_response_code(404);
            echo "Commande introuvable";
            return;
        }

        // ANNULATION COMMANDE
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['cancel_order'])
        ) {
            $modeContact = $_POST['mode_contact'] ?? '';
            $clientContacte = $_POST['client_contacte'] ?? '';
            $motifAnnulation = trim($_POST['motif_annulation'] ?? '');

            if (
                $modeContact !== ''
                && $clientContacte === 'oui'
                && $motifAnnulation !== ''
            ) {
                $cancelled = $orderModel->cancelCompleteOrder(
                    $orderId,
                    null,
                    (int) $_SESSION['user']['id'],
                    true
                );
            }

            header('Location: index.php?url=employe-detail-commande&id=' . $orderId);
            exit;
        }

        // CHANGEMENT DE STATUT
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $statusId = (int) ($_POST['statut_id'] ?? 0);

            $currentStatus = (int) $order['statut_id'];
            $hasEquipmentLoan = (bool) $order['pret_materiel'];

            $nextStatuses = [
                1 => [2],
                2 => [3],
                3 => [4],
                4 => [5],
                6 => [7]
            ];

            if ($currentStatus === 5) {
                $nextStatuses[5] = $hasEquipmentLoan
                    ? [6]
                    : [7];
            }

            $allowedStatuses = $nextStatuses[$currentStatus] ?? [];
            if (in_array($statusId, $allowedStatuses, true)) {
                $updated = $orderModel->updateCompleteStatus(
                    $orderId,
                    $statusId,
                    (int) $_SESSION['user']['id']
                );

                if ($updated && $statusId === 7) {
                    $order = $orderModel->getOrderByIdForEmployee(
                        $orderId
                    );

                    $reviewLink = APP_URL
                        . '/index.php?url=detail-commande&id='
                        . $orderId;
                    $mailService = new MailService();

                    $mailService->sendReviewInvitationEmail(
                        $order,
                        $reviewLink
                    );
                }
                
                if ($updated && $statusId === 6) {
                    $order = $orderModel->getOrderByIdForEmployee(
                        $orderId
                    );

                    $mailService = new MailService();

                    $mailService->sendEquipmentReturnEmail(
                        $order
                    );
                }
            }

            header('Location: index.php?url=employe-detail-commande&id=' . $orderId);
            exit;
        }

        $tracking = $orderModel->getOrderTracking($orderId);

        require_once __DIR__ . '/../Views/pages/employee-order-detail.php';
    }
    public function reviews(): void
    {
        Auth::requireRole(['Employé', 'Admin']);
        require_once __DIR__ . '/../Views/pages/employee-reviews.php';
    }

    public function menus(): void
    {
        Auth::requireRole(['Employé', 'Admin']);

        $menuModel = new MenuModel();
        $menus = $menuModel->getAllForEmployee();

        require_once __DIR__ . '/../Views/pages/employee-menus.php';
    }


    public function hours(): void
    {
        Auth::requireRole(['Employé', 'Admin']);

        $horaireModel = new HoraireModel();

        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['horaires'])
        ) {

            foreach ($_POST['horaires'] as $id => $horaire) {

                $horaireModel->update(
                    (int) $id,
                    $horaire['ouverture'],
                    $horaire['fermeture']
                );
            }

            header('Location: index.php?url=employe-horaires');
            exit;
        }

        $horaires = $horaireModel->getAll();

        require_once __DIR__ . '/../Views/pages/employee-hours.php';
    }
    public function plats(): void
    {
        Auth::requireRole(['Employé', 'Admin']);

        $platModel = new PlatModel();

        $plats = $platModel->getAll();

        require_once __DIR__ . '/../Views/pages/employee-plats.php';
    }
    public function createPlat(): void
    {
        Auth::requireRole(['Employé', 'Admin']);

        $platModel = new PlatModel();
        $allergenes = $platModel->getAllAllergenes();

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $typePlat = trim($_POST['type_plat'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $allergeneIds = $_POST['allergenes'] ?? [];

            if ($nom === '' || $typePlat === '' || $description === '') {
                $error = "Tous les champs sont obligatoires.";
            } elseif (!in_array(
                $typePlat,
                ['Entrée', 'Plat principal', 'Dessert'],
                true
            )) {
                $error = "Type de plat invalide.";
            } else {
                $platId = $platModel->create(
                    $nom,
                    $typePlat,
                    $description
                );

                if ($platId > 0) {
                    foreach ($allergeneIds as $allergeneId) {
                        $platModel->attachAllergeneToPlat(
                            $platId,
                            (int) $allergeneId
                        );
                    }

                    header('Location: index.php?url=employe-plats');
                    exit;
                }

                $error = "Erreur lors de la création du plat.";
            }
        }

        require_once __DIR__ . '/../Views/pages/employee-plat-create.php';
    }
    public function editPlat(): void
    {
        Auth::requireRole(['Employé', 'Admin']);

        $platModel = new PlatModel();

        $platId = (int) ($_GET['id'] ?? 0);
        $plat = $platModel->getById($platId);
        $allergenes = $platModel->getAllAllergenes();
        $selectedAllergenes = $platModel->getAllergeneIdsByPlatId($platId);
        if (!$plat) {
            http_response_code(404);
            echo "Plat introuvable";
            return;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $typePlat = trim($_POST['type_plat'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $allergeneIds = $_POST['allergenes'] ?? [];

            if ($nom === '' || $typePlat === '' || $description === '') {
                $error = "Tous les champs sont obligatoires.";
            } elseif (!in_array($typePlat, ['Entrée', 'Plat principal', 'Dessert'])) {
                $error = "Type de plat invalide.";
            } else {
                $updated = $platModel->update(
                    $platId,
                    $nom,
                    $typePlat,
                    $description
                );

                if ($updated) {
                    $platModel->detachAllergenesFromPlat($platId);

                    foreach ($allergeneIds as $allergeneId) {
                        $platModel->attachAllergeneToPlat(
                            $platId,
                            (int) $allergeneId
                        );
                    }
                    header('Location: index.php?url=employe-plats');
                    exit;
                }

                $error = "Erreur lors de la modification du plat.";
            }
        }

        require_once __DIR__ . '/../Views/pages/employee-plat-edit.php';
    }

    public function deletePlat(): void
    {
        Auth::requireRole(['Employé', 'Admin']);

        $platId = (int) ($_GET['id'] ?? 0);

        $platModel = new PlatModel();

        if ($platModel->isUsedInMenu($platId)) {

            header(
                'Location: index.php?url=employe-plats&error=used'
            );

            exit;
        }

        $platModel->delete($platId);

        header(
            'Location: index.php?url=employe-plats'
        );

        exit;
    }
    public function createMenu(): void
    {
        Auth::requireRole(['Employé', 'Admin']);

        $menuModel = new MenuModel();
        $platModel = new PlatModel();

        $themes = $menuModel->getThemes();
        $regimes = $menuModel->getRegimes();

        $entrees = $platModel->getByType('Entrée');
        $platsPrincipaux = $platModel->getByType('Plat principal');
        $desserts = $platModel->getByType('Dessert');

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $titre = trim($_POST['titre'] ?? '');
            $descriptionCourte = trim($_POST['description_courte'] ?? '');
            $descriptionLongue = trim($_POST['description_longue'] ?? '');
            $nbPersonnesMin = (int) ($_POST['nb_personnes_min'] ?? 0);
            $prixParPersonne = (float) ($_POST['prix_par_personne'] ?? 0);
            $stock = (int) ($_POST['stock'] ?? 0);
            $conditions = trim($_POST['conditions'] ?? '');

            $themeId = (int) ($_POST['theme_id'] ?? 0);
            $regimeId = (int) ($_POST['regime_id'] ?? 0);

            $entreeId = (int) ($_POST['entree_id'] ?? 0);
            $platPrincipalId = (int) ($_POST['plat_principal_id'] ?? 0);
            $dessertId = (int) ($_POST['dessert_id'] ?? 0);

            $imageCount = count(array_filter($_FILES['images']['name'] ?? []));

            if (
                $titre === '' ||
                $descriptionCourte === '' ||
                $descriptionLongue === '' ||
                $nbPersonnesMin <= 0 ||
                $prixParPersonne <= 0 ||
                $stock < 0 ||
                $conditions === '' ||
                $themeId <= 0 ||
                $regimeId <= 0 ||
                $entreeId <= 0 ||
                $platPrincipalId <= 0 ||
                $dessertId <= 0 ||
                $imageCount < 1 ||
                $imageCount > 3
            ) {
                $error = "Tous les champs sont obligatoires et vous devez ajouter entre 1 et 3 images.";
            } else {

                $menuId = $menuModel->createMenu(
                    $titre,
                    $descriptionCourte,
                    $descriptionLongue,
                    $nbPersonnesMin,
                    $prixParPersonne,
                    $stock,
                    $conditions,
                    $themeId,
                    $regimeId
                );

                $menuModel->attachPlatToMenu($menuId, $entreeId);
                $menuModel->attachPlatToMenu($menuId, $platPrincipalId);
                $menuModel->attachPlatToMenu($menuId, $dessertId);

                $themeName = $menuModel->getThemeNameById($themeId);

                if ($themeName === null) {
                    $error = "Thème invalide.";
                } else {
                    $imagesSaved = $menuModel->saveMenuImages(
                        $menuId,
                        $titre,
                        $themeName,
                        $_FILES['images']
                    );

                    if ($imagesSaved) {
                        header('Location: index.php?url=employe-menus');
                        exit;
                    }

                    $error = "Erreur lors de l'enregistrement des images.";
                }
            }
        }

        require_once __DIR__ . '/../Views/pages/employee-menu-create.php';
    }
    public function editMenu(): void
    {
        Auth::requireRole(['Employé', 'Admin']);

        $menuModel = new MenuModel();
        $platModel = new PlatModel();

        $menuId = (int) ($_GET['id'] ?? 0);
        $menu = $menuModel->getByIdForEmployee($menuId);

        if (!$menu) {
            http_response_code(404);
            echo "Menu introuvable";
            return;
        }

        $themes = $menuModel->getThemes();
        $regimes = $menuModel->getRegimes();

        $entrees = $platModel->getByType('Entrée');
        $platsPrincipaux = $platModel->getByType('Plat principal');
        $desserts = $platModel->getByType('Dessert');
        $images = $menuModel->getImagesByMenuId($menuId);

        $selectedPlats = [
            'Entrée' => 0,
            'Plat principal' => 0,
            'Dessert' => 0
        ];

        foreach ($menuModel->getPlatIdsByMenuId($menuId) as $plat) {
            $selectedPlats[$plat['type_plat']] = (int) $plat['id'];
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $titre = trim($_POST['titre'] ?? '');
            $descriptionCourte = trim($_POST['description_courte'] ?? '');
            $descriptionLongue = trim($_POST['description_longue'] ?? '');
            $nbPersonnesMin = (int) ($_POST['nb_personnes_min'] ?? 0);
            $prixParPersonne = (float) ($_POST['prix_par_personne'] ?? 0);
            $stock = (int) ($_POST['stock'] ?? 0);
            $conditions = trim($_POST['conditions'] ?? '');

            $themeId = (int) ($_POST['theme_id'] ?? 0);
            $regimeId = (int) ($_POST['regime_id'] ?? 0);

            $entreeId = (int) ($_POST['entree_id'] ?? 0);
            $platPrincipalId = (int) ($_POST['plat_principal_id'] ?? 0);
            $dessertId = (int) ($_POST['dessert_id'] ?? 0);

            $imageCount = count(array_filter($_FILES['images']['name'] ?? []));

            if (
                $titre === '' ||
                $descriptionCourte === '' ||
                $descriptionLongue === '' ||
                $nbPersonnesMin <= 0 ||
                $prixParPersonne <= 0 ||
                $stock < 0 ||
                $conditions === '' ||
                $themeId <= 0 ||
                $regimeId <= 0 ||
                $entreeId <= 0 ||
                $platPrincipalId <= 0 ||
                $dessertId <= 0 ||
                $imageCount > 3
            ) {
                $error = "Tous les champs sont obligatoires. Vous pouvez ajouter au maximum 3 images.";
            } else {

                $menuModel->updateMenu(
                    $menuId,
                    $titre,
                    $descriptionCourte,
                    $descriptionLongue,
                    $nbPersonnesMin,
                    $prixParPersonne,
                    $stock,
                    $conditions,
                    $themeId,
                    $regimeId
                );

                $menuModel->detachPlatsFromMenu($menuId);

                $menuModel->attachPlatToMenu($menuId, $entreeId);
                $menuModel->attachPlatToMenu($menuId, $platPrincipalId);
                $menuModel->attachPlatToMenu($menuId, $dessertId);

                if ($imageCount > 0) {
                    $themeName = $menuModel->getThemeNameById($themeId);

                    if ($themeName === null) {
                        $error = "Thème invalide.";
                    } else {
                        $imagesReplaced = $menuModel->replaceMenuImages(
                            $menuId,
                            $titre,
                            $themeName,
                            $_FILES['images']
                        );

                        if (!$imagesReplaced) {
                            $error = "Erreur lors du remplacement des images.";
                        }
                    }
                }

                if ($error === null) {
                    header('Location: index.php?url=employe-menus');
                    exit;
                }
            }
        }

        require_once __DIR__ . '/../Views/pages/employee-menu-edit.php';
    }
    public function deleteMenu(): void
    {
        Auth::requireRole(['Employé', 'Admin']);

        $menuId = (int) ($_GET['id'] ?? 0);

        $menuModel = new MenuModel();

        if ($menuModel->isUsedInOrder($menuId)) {
            header('Location: index.php?url=employe-menus&error=used');
            exit;
        }

        $menuModel->deleteMenu($menuId);

        header('Location: index.php?url=employe-menus');
        exit;
    }
}
