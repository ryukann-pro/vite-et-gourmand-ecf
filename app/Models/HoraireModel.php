<?php

require_once __DIR__ . '/../../config/database.php';

class HoraireModel
{
    public function getAll(): array
    {
        $pdo = Database::getConnection();

        $sql = "
            SELECT *
            FROM horaire
            ORDER BY FIELD(
                jour_semaine,
                'Lundi',
                'Mardi',
                'Mercredi',
                'Jeudi',
                'Vendredi',
                'Samedi',
                'Dimanche'
            )
        ";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM horaire WHERE id = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        $horaire = $stmt->fetch();

        return $horaire ?: null;
    }

    public function update(
        int $id,
        string $heureOuverture,
        string $heureFermeture
    ): bool {
        $pdo = Database::getConnection();

        $sql = "
            UPDATE horaire
            SET heure_ouverture = ?,
                heure_fermeture = ?
            WHERE id = ?
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $heureOuverture,
            $heureFermeture,
            $id
        ]);
    }
}