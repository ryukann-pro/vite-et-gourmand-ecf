<?php

require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Entities/Utilisateur.php';

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
