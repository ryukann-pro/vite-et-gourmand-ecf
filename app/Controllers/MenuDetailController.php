<?php

require_once __DIR__ . '/../Models/MenuModel.php';

class MenuDetailController
{
    public function index(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        $menuModel = new MenuModel();

        $menu = $menuModel->getMenuById($id);
        $images = $menuModel->getImagesByMenuId($id);
        $plats = $menuModel->getPlatsByMenuId($id);

        if (!$menu) {
            http_response_code(404);
            echo "Menu introuvable";
            return;
        }

        require_once __DIR__ . '/../Views/pages/menu-detail.php';
    }
}