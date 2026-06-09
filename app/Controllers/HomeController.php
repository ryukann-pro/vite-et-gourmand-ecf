<?php
require_once __DIR__ . '/../Models/ReviewModel.php';

class HomeController
{
    public function index(): void
    {
        $reviewModel = new ReviewModel();
        $reviews = $reviewModel->getValidatedReviews();
        require_once __DIR__ . '/../Views/pages/home.php';
    }
}