<?php

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

        $userRole = $_SESSION['user']['role'];

        if (!in_array($userRole, $roles, true)) {
            header('Location: index.php');
            exit;
        }
    }
}