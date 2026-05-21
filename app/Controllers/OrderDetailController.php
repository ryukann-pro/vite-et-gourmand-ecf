<?php

require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/OrderModel.php';

class OrderDetailController
{
    public function index(): void
    {
        Auth::requireRole(['Client']);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $orderId = (int) ($_GET['id'] ?? 0);

        $orderModel = new OrderModel();
        $order = $orderModel->getOrderByIdAndUserId($orderId, $_SESSION['user']['id']);

        if (!$order) {
            http_response_code(404);
            echo "Commande introuvable";
            return;
        }

        require_once __DIR__ . '/../Views/pages/order-detail.php';
    }
}