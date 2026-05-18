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
            $password = trim($_POST['password'] ?? '');

            $userModel = new UserModel();

            $user = $userModel->findByEmail($email);

            if (!$user) {
                $error = "Email ou mot de passe incorrect.";
            } else {

                if (!password_verify($password, $user['mot_de_passe_hash'])) {
                    $error = "Email ou mot de passe incorrect.";
                } else {

                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'nom' => $user['nom'],
                        'prenom' => $user['prenom'],
                        'email' => $user['email'],
                        'role' => $user['role']
                    ];

                    header('Location: index.php');
                    exit;
                }
            }
        }

        require_once __DIR__ . '/../Views/pages/login.php';
    }

    public function register(): void
    {
        require_once __DIR__ . '/../Views/pages/register.php';
    }

    public function forgotPassword(): void
    {
        require_once __DIR__ . '/../Views/pages/forgot-password.php';
    }
}