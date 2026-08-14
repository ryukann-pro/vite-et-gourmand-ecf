<?php

require_once __DIR__ . '/../Models/UserModel.php';

class AuthController
{
    public function login(): void
    {
        session_start();

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (
                $email === '' ||
                $password === '' ||
                !filter_var($email, FILTER_VALIDATE_EMAIL) ||
                strlen($email) > 191 ||
                strlen($password) > 255
            ) {
                $error = "Email ou mot de passe incorrect.";
            } else {

                $userModel = new UserModel();
                $user = $userModel->findByEmail($email);

                if (
                    !$user ||
                    !password_verify(
                        $password,
                        $user['mot_de_passe_hash']
                    )
                ) {
                    $error = "Email ou mot de passe incorrect.";
                } elseif (!(bool) $user['actif']) {

                    $error = "Ce compte est désactivé.";
                } else {

                    session_regenerate_id(true);

                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'nom' => $user['nom'],
                        'prenom' => $user['prenom'],
                        'email' => $user['email'],
                        'role' => $user['role']
                    ];

                    if ($user['role'] === 'Admin') {
                        header('Location: index.php?url=espace-admin');
                        exit;
                    }

                    if ($user['role'] === 'Employé') {
                        header('Location: index.php?url=espace-employe');
                        exit;
                    }

                    header('Location: index.php?url=mon-compte');
                    exit;
                }
            }
        }

        require_once __DIR__ . '/../Views/pages/login.php';
    }
    public function register(): void
    {
        session_start();

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telephone = trim($_POST['telephone'] ?? '');
            $adresse = trim($_POST['adresse'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if (
                $nom === '' ||
                $prenom === '' ||
                $email === '' ||
                $telephone === '' ||
                $adresse === '' ||
                $password === '' ||
                $confirmPassword === ''
            ) {
                $error = "Tous les champs sont obligatoires.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Adresse email invalide.";
            } elseif (!preg_match('/^0[1-9][0-9]{8}$/', $telephone)) {
                $error = "Numéro de téléphone invalide.";
            } elseif ($password !== $confirmPassword) {
                $error = "Les mots de passe ne correspondent pas.";
            } else {

                $regexPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{10,}$/';

                if (!preg_match($regexPassword, $password)) {

                    $error = "Le mot de passe doit contenir au moins 10 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
                } else {

                    $userModel = new UserModel();

                    if ($userModel->emailExists($email)) {

                        $error = "Cette adresse email existe déjà.";
                    } else {

                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                        $userCreated = $userModel->createUser(
                            $nom,
                            $prenom,
                            $email,
                            $telephone,
                            $adresse,
                            $passwordHash
                        );

                        if ($userCreated) {

                            $user = $userModel->findByEmail($email);

                            session_regenerate_id(true);

                            $_SESSION['user'] = [
                                'id' => $user['id'],
                                'nom' => $user['nom'],
                                'prenom' => $user['prenom'],
                                'email' => $user['email'],
                                'role' => $user['role']
                            ];
                            $mailService = new MailService();
                            $mailService->sendWelcomeEmail(
                                $email,
                                $prenom,
                                $nom
                            );
                            header('Location: index.php?url=mon-compte');
                            exit;
                        }

                        $error = "Erreur lors de la création du compte.";
                    }
                }
            }
        }

        require_once __DIR__ . '/../Views/pages/register.php';
    }

    public function forgotPassword(): void
    {
        require_once __DIR__ . '/../Views/pages/forgot-password.php';
    }
    public function logout(): void
    {
        session_start();

        $_SESSION = [];

        session_destroy();

        header('Location: index.php');
        exit;
    }
}
