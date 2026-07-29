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

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/brevo.php';

        $this->client = $config['client'];
        $this->senderEmail = $config['sender_email'];
        $this->senderName = $config['sender_name'];
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
