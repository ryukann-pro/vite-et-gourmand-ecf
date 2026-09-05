<?php
require_once __DIR__ . '/../Models/ReviewModel.php';

class HomeController
{
    public function index(): void
    {
        $reviewModel = new ReviewModel();

        $reviews = $reviewModel->getValidatedReviews();
        $reviewStats = $reviewModel->getReviewsStats();

        require_once __DIR__ . '/../Views/pages/home.php';
    }

    public function legalNotice(): void
    {
        require_once __DIR__ . '/../Views/pages/legal-notice.php';
    }

    public function termsAndConditions(): void
    {
        require_once __DIR__ . '/../Views/pages/terms-and-conditions.php';
    }
}
