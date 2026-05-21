<?php

require_once __DIR__ . '/../../config/database.php';

class CityModel
{
    public function getAllCities(): array
    {
        $pdo = Database::getConnection();

        $sql = "
            SELECT id, nom, distance_km
            FROM ville_commande
            ORDER BY id ASC
        ";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function getCityById(int $id): ?array
    {
        $pdo = Database::getConnection();

        $sql = "
            SELECT id, nom, distance_km
            FROM ville_commande
            WHERE id = ?
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        $city = $stmt->fetch();

        return $city ?: null;
    }
}