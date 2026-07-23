<?php

require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/OrderModel.php';
require_once __DIR__ . '/../Models/ReviewModel.php';

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
        $tracking = $orderModel->getOrderTracking($orderId);
        $reviewModel = new ReviewModel();
        $hasReview = $reviewModel->hasReviewForOrder($orderId);

        if (!$order) {
            http_response_code(404);
            echo "Commande introuvable";
            return;
        }

        require_once __DIR__ . '/../Views/pages/order-detail.php';
    }
    public function cancel(): void
    {
        Auth::requireRole(['Client']);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $orderId = (int) ($_GET['id'] ?? 0);

        $orderModel = new OrderModel();

        $cancelled = $orderModel->cancelCompleteOrder(
            $orderId,
            (int) $_SESSION['user']['id'],
            (int) $_SESSION['user']['id'],
            false
        );

        header('Location: index.php?url=detail-commande&id=' . $orderId);
        exit;
    }
}
