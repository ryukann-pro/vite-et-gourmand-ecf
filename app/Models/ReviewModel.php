<?php

require_once __DIR__ . '/../../config/database.php';

class ReviewModel
{
  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = Database::getConnection();
  }
  public function canLeaveReview(int $orderId, int $userId): bool
  {
    $sql = "
        SELECT COUNT(*) 
        FROM commande
        WHERE id = ?
        AND utilisateur_id = ?
        AND statut_id = 7
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$orderId, $userId]);

    $orderExists = (int) $stmt->fetchColumn();

    if ($orderExists === 0) {
      return false;
    }

    $sql = "
        SELECT COUNT(*)
        FROM avis
        WHERE commande_id = ?
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$orderId]);

    $reviewExists = (int) $stmt->fetchColumn();

    return $reviewExists === 0;
  }

  public function createReview(
    int $note,
    string $commentaire,
    int $orderId,
    int $userId
  ): bool {

    $sql = "
        INSERT INTO avis (
            note,
            commentaire,
            est_valide,
            commande_id,
            utilisateur_id
        )
        VALUES (?, ?, 0, ?, ?)
    ";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
      $note,
      $commentaire,
      $orderId,
      $userId
    ]);
  }
  public function hasReviewForOrder(int $orderId): bool
  {
    $sql = "
        SELECT COUNT(*)
        FROM avis
        WHERE commande_id = ?
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$orderId]);

    return (int) $stmt->fetchColumn() > 0;
  }
  public function getPendingReviews(): array
  {
    $sql = "
        SELECT
            avis.id,
            avis.note,
            avis.commentaire,
            commande.id AS commande_id,
            utilisateur.prenom,
            utilisateur.nom
        FROM avis
        INNER JOIN commande ON avis.commande_id = commande.id
        INNER JOIN utilisateur ON avis.utilisateur_id = utilisateur.id
        WHERE avis.est_valide = 0
        ORDER BY avis.id DESC
    ";

    $stmt = $this->pdo->query($sql);

    return $stmt->fetchAll();
  }
  public function validateReview(int $reviewId): bool
  {
    $sql = "
        UPDATE avis
        SET est_valide = 1
        WHERE id = ?
    ";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([$reviewId]);
  }
  public function deleteReview(int $reviewId): bool
  {
    $sql = "
        DELETE FROM avis
        WHERE id = ?
    ";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([$reviewId]);
  }
  public function getValidatedReviews(): array
  {
    $sql = "
        SELECT
            avis.note,
            avis.commentaire,
            utilisateur.prenom,
            utilisateur.nom
        FROM avis
        INNER JOIN utilisateur ON avis.utilisateur_id = utilisateur.id
        WHERE avis.est_valide = 1
        ORDER BY avis.id DESC
        LIMIT 4
    ";

    $stmt = $this->pdo->query($sql);

    return $stmt->fetchAll();
  }
}