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

    public function apiSearch(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $theme = $_GET['theme'] ?? null;
        $regime = $_GET['regime'] ?? null;
        $prixMin = isset($_GET['prix_min']) && $_GET['prix_min'] !== ''
            ? (float) $_GET['prix_min']
            : null;

        $prixMax = isset($_GET['prix_max']) && $_GET['prix_max'] !== ''
            ? (float) $_GET['prix_max']
            : null;
        $personnes = isset($_GET['personnes']) && $_GET['personnes'] !== ''
            ? (int) $_GET['personnes']
            : null;
        $menuModel = new MenuModel();
        $menus = $menuModel->searchMenus(
            $theme,
            $regime,
            $prixMin,
            $prixMax,
            $personnes
        );

        echo json_encode($menus);
        exit;
    }
}