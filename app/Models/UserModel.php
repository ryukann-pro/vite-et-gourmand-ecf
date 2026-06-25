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

    public function emailExists(string $email): bool
    {
        $pdo = Database::getConnection();

        $sql = "SELECT id FROM utilisateur WHERE email = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        return (bool) $stmt->fetch();
    }

    public function createUser(
        string $nom,
        string $prenom,
        string $email,
        string $telephone,
        string $adresse,
        string $passwordHash
    ): bool {
        $pdo = Database::getConnection();

        $sql = "
        INSERT INTO utilisateur (
            nom,
            prenom,
            email,
            telephone,
            adresse,
            mot_de_passe_hash,
            date_inscription,
            role_id
        )
        VALUES (?, ?, ?, ?, ?, ?, NOW(), 1)
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $nom,
            $prenom,
            $email,
            $telephone,
            $adresse,
            $passwordHash
        ]);
    }
    public function findById(int $id): ?array
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
        WHERE utilisateur.id = ?
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function updateProfile(
        int $id,
        string $nom,
        string $prenom,
        string $email,
        string $telephone,
        string $adresse
    ): bool {
        $pdo = Database::getConnection();

        $sql = "
        UPDATE utilisateur
        SET nom = ?, prenom = ?, email = ?, telephone = ?, adresse = ?
        WHERE id = ?
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $nom,
            $prenom,
            $email,
            $telephone,
            $adresse,
            $id
        ]);
    }
}
