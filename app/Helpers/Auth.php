<?php

require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Entities/Utilisateur.php';

class Auth
{
    private const SESSION_TIMEOUT = 60;

    private static function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private static function checkSessionTimeout(): void
    {
        if (!isset($_SESSION['user'])) {
            return;
        }

        if (
            isset($_SESSION['last_activity']) &&
            time() - $_SESSION['last_activity'] > self::SESSION_TIMEOUT
        ) {
            $_SESSION = [];
            session_destroy();

            header('Location: index.php?url=connexion&session=expired');
            exit;
        }

        $_SESSION['last_activity'] = time();
    }

    public static function isLogged(): bool
    {
        self::startSession();

        return isset($_SESSION['user']);
    }

    public static function requireRole(array $roles): void
    {
        self::startSession();
        self::checkSessionTimeout();

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?url=connexion');
            exit;
        }

        $userModel = new UserModel();

        $user = $userModel->findById(
            (int) $_SESSION['user']['id']
        );

        if (!$user) {
            $_SESSION = [];
            session_destroy();

            header('Location: index.php?url=connexion');
            exit;
        }

        $utilisateur = new Utilisateur(
            $user['nom'],
            $user['prenom'],
            $user['email'],
            (bool) $user['actif'],
            $user['role']
        );

        if (!$utilisateur->estActif()) {
            $_SESSION = [];
            session_destroy();

            header('Location: index.php?url=connexion');
            exit;
        }

        if (!$utilisateur->aUnDesRoles($roles)) {
            header('Location: index.php');
            exit;
        }
    }
}