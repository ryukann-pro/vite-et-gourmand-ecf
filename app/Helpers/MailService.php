<?php

use Brevo\Brevo;
use Brevo\TransactionalEmails\Requests\SendTransacEmailRequest;
use Brevo\TransactionalEmails\Types\SendTransacEmailRequestSender;
use Brevo\TransactionalEmails\Types\SendTransacEmailRequestToItem;

class MailService
{
    private Brevo $client;
    private string $senderEmail;
    private string $senderName;
    private string $contactEmail;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/brevo.php';

        $this->client = $config['client'];
        $this->senderEmail = $config['sender_email'];
        $this->senderName = $config['sender_name'];
        $this->contactEmail = $config['contact_email'];
    }


    public function sendWelcomeEmail(
        string $recipientEmail,
        string $firstName,
        string $lastName
    ): bool {
        $fullName = trim($firstName . ' ' . $lastName);

        $htmlContent = $this->renderView(
            'welcome',
            [
                'firstName' => $firstName
            ]
        );

        return $this->send(
            $recipientEmail,
            $fullName,
            'Bienvenue chez Vite & Gourmand',
            $htmlContent
        );
    }

    public function sendOrderConfirmationEmail(
        array $order
    ): bool {

        $fullName = trim(
            $order['prenom_client']
                . ' '
                . $order['nom_client']
        );

        $htmlContent = $this->renderView(
            'order-confirmation',
            [
                'order' => $order
            ]
        );

        return $this->send(
            $order['email_client'],
            $fullName,
            'Confirmation de votre commande',
            $htmlContent
        );
    }

    public function sendReviewInvitationEmail(
        array $order,
        string $reviewLink
    ): bool {
        $fullName = trim(
            $order['prenom_client']
                . ' '
                . $order['nom_client']
        );

        $htmlContent = $this->renderView(
            'review-invitation',
            [
                'order' => $order,
                'reviewLink' => $reviewLink
            ]
        );

        return $this->send(
            $order['email_client'],
            $fullName,
            'Partagez votre avis sur votre commande',
            $htmlContent
        );
    }

    public function sendEquipmentReturnEmail(
        array $order
    ): bool {
        $fullName = trim(
            $order['prenom_client']
                . ' '
                . $order['nom_client']
        );

        $htmlContent = $this->renderView(
            'equipment-return',
            [
                'order' => $order
            ]
        );

        return $this->send(
            $order['email_client'],
            $fullName,
            'Retour du matériel prêté',
            $htmlContent
        );
    }

    public function sendContactEmail(
        string $lastName,
        string $firstName,
        string $email,
        ?string $phone,
        string $title,
        string $message
    ): bool {
        $htmlContent = $this->renderView(
            'contact',
            [
                'lastName' => $lastName,
                'firstName' => $firstName,
                'email' => $email,
                'phone' => $phone,
                'title' => $title,
                'message' => $message
            ]
        );

        return $this->send(
            $this->contactEmail,
            'Vite & Gourmand',
            'Nouvelle demande de contact : ' . $title,
            $htmlContent
        );
    }
    
    private function send(
        string $recipientEmail,
        string $recipientName,
        string $subject,
        string $htmlContent
    ): bool {
        try {
            $email = new SendTransacEmailRequest([
                'subject' => $subject,
                'htmlContent' => $htmlContent,

                'sender' => new SendTransacEmailRequestSender([
                    'name' => $this->senderName,
                    'email' => $this->senderEmail,
                ]),

                'to' => [
                    new SendTransacEmailRequestToItem([
                        'email' => $recipientEmail,
                        'name' => $recipientName,
                    ]),
                ],
            ]);

            $this->client
                ->transactionalEmails
                ->sendTransacEmail($email);

            return true;
        } catch (\Throwable $exception) {
            error_log(
                'Erreur lors de l’envoi du mail Brevo : '
                    . $exception->getMessage()
            );

            return false;
        }
    }

    private function renderView(
        string $view,
        array $data = []
    ): string {

        extract($data);

        ob_start();

        require __DIR__ . '/../Views/emails/' . $view . '.php';

        return ob_get_clean();
    }
}
