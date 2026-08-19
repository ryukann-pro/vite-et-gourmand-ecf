<?php

require_once __DIR__ . '/../../config/database.php';

class PasswordResetModel
{
    public function createOrReplace(
        int $userId,
        string $tokenHash,
        string $expirationDate
    ): bool {
        $pdo = Database::getConnection();

        $sql = "
            INSERT INTO reinitialisation_mot_de_passe (
                utilisateur_id,
                token_hash,
                date_expiration
            )
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE
                token_hash = VALUES(token_hash),
                date_expiration = VALUES(date_expiration),
                date_creation = CURRENT_TIMESTAMP
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $userId,
            $tokenHash,
            $expirationDate
        ]);
    }

    public function findValidByTokenHash(
        string $tokenHash
    ): ?array {
        $pdo = Database::getConnection();

        $sql = "
        SELECT
            reinitialisation_mot_de_passe.id,
            reinitialisation_mot_de_passe.utilisateur_id,
            reinitialisation_mot_de_passe.token_hash,
            reinitialisation_mot_de_passe.date_expiration
        FROM reinitialisation_mot_de_passe
        WHERE token_hash = ?
        AND date_expiration > NOW()
        LIMIT 1
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$tokenHash]);

        $reset = $stmt->fetch();

        return $reset ?: null;
    }

    public function deleteByUserId(int $userId): bool
    {
        $pdo = Database::getConnection();

        $sql = "
        DELETE FROM reinitialisation_mot_de_passe
        WHERE utilisateur_id = ?
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([$userId]);
    }
}
