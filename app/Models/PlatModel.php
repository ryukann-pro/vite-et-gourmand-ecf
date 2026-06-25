<?php

require_once __DIR__ . '/../../config/database.php';

class PlatModel
{
  public function getAll(): array
  {
    $pdo = Database::getConnection();

    $sql = "
    SELECT
        plat.id,
        plat.nom,
        plat.type_plat,
        plat.description,
        GROUP_CONCAT(DISTINCT allergene.nom SEPARATOR ', ') AS allergenes,
        COUNT(DISTINCT menu_plat.menu_id) AS nb_menus
    FROM plat
    LEFT JOIN plat_allergene
        ON plat.id = plat_allergene.plat_id
    LEFT JOIN allergene
        ON plat_allergene.allergene_id = allergene.id
    LEFT JOIN menu_plat
        ON plat.id = menu_plat.plat_id
    GROUP BY
        plat.id,
        plat.nom,
        plat.type_plat,
        plat.description
    ORDER BY FIELD(
        plat.type_plat,
        'Entrée',
        'Plat principal',
        'Dessert'
    ),
    plat.nom ASC
";

    $stmt = $pdo->query($sql);

    return $stmt->fetchAll();
  }

  public function getById(int $id): ?array
  {
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare(
      "SELECT * FROM plat WHERE id = ?"
    );

    $stmt->execute([$id]);

    $plat = $stmt->fetch();

    return $plat ?: null;
  }

  public function create(
    string $nom,
    string $typePlat,
    string $description
  ): bool {
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare(
      "INSERT INTO plat (nom, type_plat, description)
            VALUES (?, ?, ?)"
    );

    return $stmt->execute([
      $nom,
      $typePlat,
      $description
    ]);
  }

  public function update(
    int $id,
    string $nom,
    string $typePlat,
    string $description
  ): bool {
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare(
      "UPDATE plat
            SET nom = ?,
                type_plat = ?,
                description = ?
            WHERE id = ?"
    );

    return $stmt->execute([
      $nom,
      $typePlat,
      $description,
      $id
    ]);
  }

  public function delete(int $id): bool
  {
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare(
      "DELETE FROM plat WHERE id = ?"
    );

    return $stmt->execute([$id]);
  }
  public function isUsedInMenu(int $id): bool
  {
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare(
      "SELECT COUNT(*) FROM menu_plat WHERE plat_id = ?"
    );

    $stmt->execute([$id]);

    return (int) $stmt->fetchColumn() > 0;
  }
  public function getByType(string $type): array
  {
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        SELECT id, nom
        FROM plat
        WHERE type_plat = ?
        ORDER BY nom ASC
    ");

    $stmt->execute([$type]);

    return $stmt->fetchAll();
  }
}