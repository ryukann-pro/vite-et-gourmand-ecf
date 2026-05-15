<?php

require_once __DIR__ . '/../Models/MenuModel.php';

class MenuController
{
    public function index(): void
    {
        $menuModel = new MenuModel();

        $menus = $menuModel->getAllMenus();

        require_once __DIR__ . '/../Views/pages/menus.php';
    }
}