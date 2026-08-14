<?php

require_once __DIR__ . '/../Models/UserModel.php';

class Auth
{
    private static function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function isLogged(): bool
    {
        self::startSession();

        return isset($_SESSION['user']);
    }

    public static function requireRole(array $roles): void
    {
        self::startSession();

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?url=connexion');
            exit;
        }

        $userModel = new UserModel();

        $user = $userModel->findById(
            (int) $_SESSION['user']['id']
        );

        if (!$user || !(bool) $user['actif']) {
            $_SESSION = [];
            session_destroy();

            header('Location: index.php?url=connexion');
            exit;
        }

        $userRole = $user['role'];

        if (!in_array($userRole, $roles, true)) {
            header('Location: index.php');
            exit;
        }
    }
}
