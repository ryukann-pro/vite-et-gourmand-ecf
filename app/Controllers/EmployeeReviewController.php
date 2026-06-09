<?php

require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/ReviewModel.php';

class EmployeeReviewController
{
  public function index(): void
  {
    Auth::requireRole(['Employé', 'Admin']);

    $reviewModel = new ReviewModel();

    $reviews = $reviewModel->getPendingReviews();

    require_once __DIR__ . '/../Views/pages/employee-reviews.php';
  }

  public function validate(): void
  {
    Auth::requireRole(['Employé', 'Admin']);

    $reviewId = (int) ($_GET['id'] ?? 0);

    $reviewModel = new ReviewModel();
    $reviewModel->validateReview($reviewId);

    header('Location: index.php?url=employe-avis');
    exit;
  }
  public function delete(): void
  {
    Auth::requireRole(['Employé', 'Admin']);

    $reviewId = (int) ($_GET['id'] ?? 0);

    $reviewModel = new ReviewModel();
    $reviewModel->deleteReview($reviewId);

    header('Location: index.php?url=employe-avis');
    exit;
  }
}