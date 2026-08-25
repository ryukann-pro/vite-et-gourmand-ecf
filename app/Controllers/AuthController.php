<?php

require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Models/PasswordResetModel.php';
require_once __DIR__ . '/../Helpers/MailService.php';
require_once __DIR__ . '/../Entities/Utilisateur.php';

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
                } else {

                    $utilisateur = new Utilisateur(
                        $user['nom'],
                        $user['prenom'],
                        $user['email'],
                        (bool) $user['actif'],
                        $user['role']
                    );

                    if (!$utilisateur->estActif()) {
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
                        $_SESSION['last_activity'] = time();
                        if ($utilisateur->aLeRole('Admin')) {
                            header('Location: index.php?url=espace-admin');
                            exit;
                        }

                        if ($utilisateur->aLeRole('Employé')) {
                            header('Location: index.php?url=espace-employe');
                            exit;
                        }

                        header('Location: index.php?url=mon-compte');
                        exit;
                    }
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
                $adresse === '' ||
                $password === '' ||
                $confirmPassword === ''
            ) {
                $error = "Tous les champs sont obligatoires.";
            } elseif (!$utilisateur->longueursValides()) {
                $error = "Un ou plusieurs champs sont trop longs.";
            } elseif (!$utilisateur->emailValide()) {
                $error = "Adresse email invalide.";
            } elseif (!Utilisateur::telephoneValide($telephone)) {
                $error = "Numéro de téléphone invalide.";
            } elseif ($password !== $confirmPassword) {
                $error = "Les mots de passe ne correspondent pas.";
            } else {

                if (!Utilisateur::motDePasseValide($password)) {

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
                            $_SESSION['last_activity'] = time();
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
        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');

            if (
                $email === ''
                || !filter_var($email, FILTER_VALIDATE_EMAIL)
                || strlen($email) > 191
            ) {
                $error = "Adresse email invalide.";
            } else {

                $userModel = new UserModel();
                $user = $userModel->findByEmail($email);

                if ($user) {

                    $token = bin2hex(random_bytes(32));

                    $tokenHash = hash(
                        'sha256',
                        $token
                    );

                    $expirationDate = date(
                        'Y-m-d H:i:s',
                        time() + 3600
                    );

                    $passwordResetModel = new PasswordResetModel();

                    $created = $passwordResetModel->createOrReplace(
                        (int) $user['id'],
                        $tokenHash,
                        $expirationDate
                    );

                    if ($created) {

                        $resetLink = APP_URL
                            . '/index.php?url=reinitialisation-mot-de-passe&token='
                            . urlencode($token);

                        $mailService = new MailService();

                        $mailService->sendPasswordResetEmail(
                            $user['email'],
                            $user['prenom'],
                            $resetLink
                        );
                    }
                }

                $success = "Si un compte correspond à cette adresse, un lien de réinitialisation vous a été envoyé.";
            }
        }

        require_once __DIR__ . '/../Views/pages/forgot-password.php';
    }

public function logout(): void
{
    session_start();

    $_SESSION = [];
    session_destroy();

    if (($_GET['session'] ?? '') === 'expired') {
        header('Location: index.php?url=connexion&session=expired');
        exit;
    }

    header('Location: index.php');
    exit;
}

    public function resetPassword(): void
    {
        $error = null;
        $success = null;

        $token = trim($_GET['token'] ?? '');

        if ($token === '') {
            $error = "Lien de réinitialisation invalide.";
            require_once __DIR__ . '/../Views/pages/reset-password.php';
            return;
        }

        $tokenHash = hash('sha256', $token);

        $passwordResetModel = new PasswordResetModel();

        $reset = $passwordResetModel->findValidByTokenHash(
            $tokenHash
        );

        if (!$reset) {
            $error = "Ce lien de réinitialisation est invalide ou a expiré.";
            require_once __DIR__ . '/../Views/pages/reset-password.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if (
                $password === ''
                || $confirmPassword === ''
            ) {
                $error = "Tous les champs sont obligatoires.";
            } elseif ($password !== $confirmPassword) {

                $error = "Les mots de passe ne correspondent pas.";
            } else {

                if (!Utilisateur::motDePasseValide($password)) {
                    $error = "Le mot de passe doit contenir au moins 10 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
                } else {

                    $userModel = new UserModel();

                    $passwordHash = password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    );

                    $updated = $userModel->updatePassword(
                        (int) $reset['utilisateur_id'],
                        $passwordHash
                    );

                    if ($updated) {

                        $passwordResetModel->deleteByUserId(
                            (int) $reset['utilisateur_id']
                        );

                        header(
                            'Location: index.php?url=connexion'
                        );
                        exit;
                    }

                    $error = "Une erreur est survenue lors de la modification du mot de passe.";
                }
            }
        }

        require_once __DIR__ . '/../Views/pages/reset-password.php';
    }
}
