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
                utilisateur.actif,
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
            utilisateur.actif,
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
    public function getAllEmployees(): array
    {
        $pdo = Database::getConnection();

        $sql = "
        SELECT
            utilisateur.id,
            utilisateur.nom,
            utilisateur.prenom,
            utilisateur.email,
            utilisateur.actif,
            role.nom AS role
        FROM utilisateur
        INNER JOIN role ON utilisateur.role_id = role.id
        WHERE role.nom = 'Employé'
        ORDER BY utilisateur.nom ASC, utilisateur.prenom ASC
    ";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function createEmployee(
        string $nom,
        string $prenom,
        string $email,
        string $passwordHash
    ): bool {
        $pdo = Database::getConnection();

        $sql = "
        INSERT INTO utilisateur (
            nom,
            prenom,
            email,
            mot_de_passe_hash,
            date_inscription,
            actif,
            role_id
        )
        VALUES (?, ?, ?, ?, NOW(), 1, 2)
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $nom,
            $prenom,
            $email,
            $passwordHash
        ]);
    }

    public function getEmployeeById(int $id): ?array
    {
        $pdo = Database::getConnection();

        $sql = "
        SELECT
            utilisateur.id,
            utilisateur.nom,
            utilisateur.prenom,
            utilisateur.email,
            utilisateur.actif,
            role.nom AS role
        FROM utilisateur
        INNER JOIN role ON utilisateur.role_id = role.id
        WHERE utilisateur.id = ?
        AND role.nom = 'Employé'
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        $employee = $stmt->fetch();

        return $employee ?: null;
    }

    public function updateEmployee(
        int $id,
        string $nom,
        string $prenom,
        string $email
    ): bool {
        $pdo = Database::getConnection();

        $sql = "
        UPDATE utilisateur
        SET
            nom = ?,
            prenom = ?,
            email = ?
        WHERE id = ?
        AND role_id = 2
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $nom,
            $prenom,
            $email,
            $id
        ]);
    }

    public function updateEmployeeStatus(
        int $id,
        bool $active
    ): bool {
        $pdo = Database::getConnection();

        $sql = "
        UPDATE utilisateur
        SET actif = ?
        WHERE id = ?
        AND role_id = 2
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $active ? 1 : 0,
            $id
        ]);
    }

    public function updatePassword(
        int $userId,
        string $passwordHash
    ): bool {
        $pdo = Database::getConnection();

        $sql = "
        UPDATE utilisateur
        SET mot_de_passe_hash = ?
        WHERE id = ?
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $passwordHash,
            $userId
        ]);
    }
}
