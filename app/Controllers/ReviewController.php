<?php

require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/ReviewModel.php';

class ReviewController
{
    public function create(): void
    {
        Auth::requireRole(['Client']);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $orderId = (int) ($_GET['id'] ?? 0);

        $reviewModel = new ReviewModel();

        if (!$reviewModel->canLeaveReview($orderId, $_SESSION['user']['id'])) {
            header('Location: index.php?url=detail-commande&id=' . $orderId);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $note = (int) ($_POST['note'] ?? 0);
            $commentaire = trim($_POST['commentaire'] ?? '');

            if ($note >= 1 && $note <= 5 && $commentaire !== '') {
                $reviewModel->createReview(
                    $note,
                    $commentaire,
                    $orderId,
                    $_SESSION['user']['id']
                );
            }
        }

        header('Location: index.php?url=detail-commande&id=' . $orderId);
        exit;
    }
}