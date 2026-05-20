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

                if (!$user || !password_verify($password, $user['mot_de_passe_hash'])) {
                    $error = "Email ou mot de passe incorrect.";
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