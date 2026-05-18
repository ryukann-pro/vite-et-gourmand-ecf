<?php

require_once __DIR__ . '/../Models/MenuModel.php';

class OrderController
{
    public function create(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        $menuModel = new MenuModel();

        $menu = $menuModel->getMenuById($id);
        $images = $menuModel->getImagesByMenuId($id);

        if (!$menu) {
            http_response_code(404);
            echo "Menu introuvable";
            return;
        }

        require_once __DIR__ . '/../Views/pages/order.php';
    }
}