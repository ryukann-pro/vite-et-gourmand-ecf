<?php

require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/UserModel.php';

class ProfileController
{
    public function edit(): void
    {
        Auth::requireRole(['Client']);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userModel = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel->updateProfile(
                (int) $_SESSION['user']['id'],
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['telephone'],
                $_POST['adresse']
            );

            header('Location: index.php?url=mon-compte');
            exit;
        }

        $user = $userModel->findById((int) $_SESSION['user']['id']);

        require_once __DIR__ . '/../Views/pages/profile-edit.php';
    }
}