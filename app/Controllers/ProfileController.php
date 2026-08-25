<?php

require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Entities/Utilisateur.php';

class ProfileController
{
    public function edit(): void
    {
        Auth::requireRole(['Client']);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userModel = new UserModel();

        $error = null;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telephone = trim($_POST['telephone'] ?? '');
            $adresse = trim($_POST['adresse'] ?? '');

            $utilisateur = new Utilisateur(
                $nom,
                $prenom,
                $email,
                true,
                'Client'
            );

            if (
                !$utilisateur->informationsValides() ||
                $telephone === '' ||
                $adresse === ''
            ) {
                $error = "Tous les champs sont obligatoires.";
            } elseif (!$utilisateur->longueursValides()) {
                $error = "Un ou plusieurs champs sont trop longs.";
            } elseif (!$utilisateur->emailValide()) {
                $error = "Adresse email invalide.";
            } elseif (!Utilisateur::telephoneValide($telephone)) {
                $error = "Numéro de téléphone invalide.";
            } else {
                $existingUser = $userModel->findByEmail($email);

                if (
                    $existingUser &&
                    (int) $existingUser['id'] !== (int) $_SESSION['user']['id']
                ) {
                    $error = "Cette adresse email existe déjà.";
                } else {

                    $userModel->updateProfile(
                        (int) $_SESSION['user']['id'],
                        $nom,
                        $prenom,
                        $email,
                        $telephone,
                        $adresse
                    );

                    header('Location: index.php?url=mon-compte');
                    exit;
                }
            }
        }
        $user = $userModel->findById((int) $_SESSION['user']['id']);

        require_once __DIR__ . '/../Views/pages/profile-edit.php';
    }
}
