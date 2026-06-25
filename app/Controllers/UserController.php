<?php

require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/OrderModel.php';
require_once __DIR__ . '/../Models/UserModel.php';

class UserController
{
    public function account(): void
    {
        Auth::requireRole(['Client']);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userModel = new UserModel();
        $user = $userModel->findById($_SESSION['user']['id']);

        $orderModel = new OrderModel();
        $orders = $orderModel->getOrdersByUserId($user['id']);

        require_once __DIR__ . '/../Views/pages/account.php';
    }
}
