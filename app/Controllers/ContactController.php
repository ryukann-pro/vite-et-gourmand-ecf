<?php
require_once __DIR__ . '/../Models/MessageContactModel.php';
class ContactController
{
    public function index(): void
    {
        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telephone = trim($_POST['telephone'] ?? '');
            $titre = trim($_POST['titre'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if (
                $nom === '' ||
                $prenom === '' ||
                $email === '' ||
                $titre === '' ||
                $message === '' ||
                !filter_var($email, FILTER_VALIDATE_EMAIL)
            ) {
                $error = "Veuillez remplir correctement tous les champs obligatoires.";
            } else {
                $model = new MessageContactModel();

                $created = $model->createMessage(
                    $nom,
                    $prenom,
                    $email,
                    $telephone !== '' ? $telephone : null,
                    $titre,
                    $message
                );

                if ($created) {
                    $mailService = new MailService();

                    $mailService->sendContactEmail(
                        $nom,
                        $prenom,
                        $email,
                        $telephone !== '' ? $telephone : null,
                        $titre,
                        $message
                    );

                    $success = "Votre message a bien été envoyé.";
                } else {
                    $error = "Une erreur est survenue lors de l'envoi du message.";
                }
            }
        }

        require_once __DIR__ . '/../Views/pages/contact.php';
    }
}
