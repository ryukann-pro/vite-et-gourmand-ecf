<?php

require_once __DIR__ . '/../../config/database.php';

class MessageContactModel
{
    public function createMessage(
        string $nom,
        string $prenom,
        string $email,
        ?string $telephone,
        string $titre,
        string $message,
        int $restaurantId = 1
    ): bool {
        $pdo = Database::getConnection();

        $sql = "
            INSERT INTO message_contact (
                nom,
                prenom,
                email,
                telephone,
                titre,
                message,
                restaurant_id
            )
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $nom,
            $prenom,
            $email,
            $telephone,
            $titre,
            $message,
            $restaurantId
        ]);
    }
}