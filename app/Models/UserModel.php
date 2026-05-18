<?php

require_once __DIR__ . '/../../config/database.php';

class UserModel
{
    public function findByEmail(string $email): ?array
    {
        $pdo = Database::getConnection();

        $sql = "
            SELECT 
                utilisateur.id,
                utilisateur.nom,
                utilisateur.prenom,
                utilisateur.email,
                utilisateur.telephone,
                utilisateur.adresse,
                utilisateur.mot_de_passe_hash,
                role.nom AS role
            FROM utilisateur
            INNER JOIN role ON utilisateur.role_id = role.id
            WHERE utilisateur.email = ?
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $user = $stmt->fetch();

        return $user ?: null;
    }
}