<?php

require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/HoraireModel.php';

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
                $modeContact !== '' &&
                $clientContacte === 'oui' &&
                $motifAnnulation !== ''
            ) {

                $orderModel->cancelOrderByEmployee($orderId);

                $orderModel->addOrderTracking(
                    $orderId,
                    8
                );
            }

            header(
                'Location: index.php?url=employe-detail-commande&id=' . $orderId
            );
            exit;
        }

        // CHANGEMENT DE STATUT
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $statusId = (int) ($_POST['statut_id'] ?? 0);

            if ($statusId >= 1 && $statusId <= 7) {

                $orderModel->updateStatus(
                    $orderId,
                    $statusId
                );

                $orderModel->addOrderTracking(
                    $orderId,
                    $statusId
                );
            }

            header(
                'Location: index.php?url=employe-detail-commande&id=' . $orderId
            );
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
        require_once __DIR__ . '/../Views/pages/employee-menus.php';
    }

    public function plates(): void
    {
        Auth::requireRole(['Employé', 'Admin']);
        require_once __DIR__ . '/../Views/pages/employee-plates.php';
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
}