<?php

require_once __DIR__ . '/../../config/database.php';

class MenuModel
{
  public function getAllMenus(): array
  {
    $pdo = Database::getConnection();

    $sql = "
      SELECT 
          menu.id,
          menu.titre,
          menu.description_courte,
          menu.nb_personnes_min,
          menu.prix_par_personne,
            regime.nom AS regime,
            image.url AS image_url,
            image.texte_alternatif
        FROM menu
        INNER JOIN regime ON menu.regime_id = regime.id
        LEFT JOIN image 
          ON image.menu_id = menu.id 
          AND image.ordre_affichage = 1
      ORDER BY menu.id ASC
    ";

    $stmt = $pdo->query($sql);

    return $stmt->fetchAll();
  }

  public function getMenuById(int $id): ?array
  {
    $pdo = Database::getConnection();

    $sql = "
        SELECT
            menu.id,
            menu.titre,
            menu.description_longue,
            menu.nb_personnes_min,
            menu.prix_par_personne,
            menu.conditions,
            regime.nom AS regime,
            theme.nom AS theme
        FROM menu
        INNER JOIN regime ON menu.regime_id = regime.id
        INNER JOIN theme ON menu.theme_id = theme.id
        WHERE menu.id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $menu = $stmt->fetch();

    return $menu ?: null;
  }

  public function getImagesByMenuId(int $id): array
  {
    $pdo = Database::getConnection();

    $sql = "
        SELECT url, texte_alternatif
        FROM image
        WHERE menu_id = ?
        ORDER BY ordre_affichage ASC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetchAll();
  }

  public function getPlatsByMenuId(int $id): array
  {
    $pdo = Database::getConnection();

    $sql = "
        SELECT
            plat.id,
            plat.nom,
            plat.type_plat,
            plat.description,
            GROUP_CONCAT(allergene.nom SEPARATOR ', ') AS allergenes
        FROM plat
        INNER JOIN menu_plat ON plat.id = menu_plat.plat_id
        LEFT JOIN plat_allergene ON plat.id = plat_allergene.plat_id
        LEFT JOIN allergene ON plat_allergene.allergene_id = allergene.id
        WHERE menu_plat.menu_id = ?
        GROUP BY plat.id
        ORDER BY FIELD(plat.type_plat, 'Entrée', 'Plat principal', 'Dessert')
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetchAll();
  }
  public function searchMenus(?string $theme, ?string $regime, ?float $prixMin, ?float $prixMax, ?int $personnes): array
  {
    $pdo = Database::getConnection();

    $sql = "
        SELECT 
            menu.id,
            menu.titre,
            menu.description_courte,
            menu.nb_personnes_min,
            menu.prix_par_personne,
            regime.nom AS regime,
            theme.nom AS theme,
            image.url AS image_url,
            image.texte_alternatif
        FROM menu
        INNER JOIN regime ON menu.regime_id = regime.id
        INNER JOIN theme ON menu.theme_id = theme.id
        LEFT JOIN image 
            ON image.menu_id = menu.id 
            AND image.ordre_affichage = 1
        WHERE 1 = 1
    ";

    $params = [];

    if ($theme !== null && $theme !== '') {
      $sql .= " AND theme.nom = ?";
      $params[] = $theme;
    }

    if ($regime !== null && $regime !== '') {
      $sql .= " AND regime.nom = ?";
      $params[] = $regime;
    }

    if ($prixMin !== null) {
      $sql .= " AND menu.prix_par_personne >= ?";
      $params[] = $prixMin;
    }

    if ($prixMax !== null) {
      $sql .= " AND menu.prix_par_personne <= ?";
      $params[] = $prixMax;
    }
    if ($personnes !== null) {
      $sql .= " AND menu.nb_personnes_min <= ?";
      $params[] = $personnes;
    }

    $sql .= " ORDER BY menu.id ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll();
  }
  public function getThemes(): array
  {
    $pdo = Database::getConnection();

    $stmt = $pdo->query("
        SELECT id, nom
        FROM theme
        ORDER BY nom ASC
    ");

    return $stmt->fetchAll();
  }

  public function getRegimes(): array
  {
    $pdo = Database::getConnection();

    $stmt = $pdo->query("
        SELECT id, nom
        FROM regime
        ORDER BY nom ASC
    ");

    return $stmt->fetchAll();
  }

  public function getAllForEmployee(): array
  {
    $pdo = Database::getConnection();

    $sql = "
        SELECT
            menu.id,
            menu.titre,
            menu.prix_par_personne,
            menu.stock,
            theme.nom AS theme,
            regime.nom AS regime,
            COUNT(commande.id) AS nb_commandes
        FROM menu
        INNER JOIN theme ON menu.theme_id = theme.id
        INNER JOIN regime ON menu.regime_id = regime.id
        LEFT JOIN commande ON commande.menu_id = menu.id
        GROUP BY
            menu.id,
            menu.titre,
            menu.prix_par_personne,
            menu.stock,
            theme.nom,
            regime.nom
        ORDER BY menu.id DESC
    ";

    $stmt = $pdo->query($sql);

    return $stmt->fetchAll();
  }
  public function createMenu(
    string $titre,
    string $descriptionCourte,
    string $descriptionLongue,
    int $nbPersonnesMin,
    float $prixParPersonne,
    int $stock,
    string $conditions,
    int $themeId,
    int $regimeId,
    int $restaurantId = 1
  ): int {
    $pdo = Database::getConnection();

    $sql = "
        INSERT INTO menu (
            titre,
            description_courte,
            description_longue,
            nb_personnes_min,
            prix_par_personne,
            stock,
            conditions,
            theme_id,
            regime_id,
            restaurant_id
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
      $titre,
      $descriptionCourte,
      $descriptionLongue,
      $nbPersonnesMin,
      $prixParPersonne,
      $stock,
      $conditions,
      $themeId,
      $regimeId,
      $restaurantId
    ]);

    return (int) $pdo->lastInsertId();
  }
  public function attachPlatToMenu(int $menuId, int $platId): bool
  {
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        INSERT INTO menu_plat (menu_id, plat_id)
        VALUES (?, ?)
    ");

    return $stmt->execute([$menuId, $platId]);
  }
  public function getByIdForEmployee(int $id): ?array
  {
    $pdo = Database::getConnection();

    $sql = "
        SELECT *
        FROM menu
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $menu = $stmt->fetch();

    return $menu ?: null;
  }
  public function getPlatIdsByMenuId(int $menuId): array
{
    $pdo = Database::getConnection();

    $sql = "
        SELECT plat.id, plat.type_plat
        FROM plat
        INNER JOIN menu_plat ON plat.id = menu_plat.plat_id
        WHERE menu_plat.menu_id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$menuId]);

    return $stmt->fetchAll();
}
public function updateMenu(
    int $id,
    string $titre,
    string $descriptionCourte,
    string $descriptionLongue,
    int $nbPersonnesMin,
    float $prixParPersonne,
    int $stock,
    string $conditions,
    int $themeId,
    int $regimeId
): bool {
    $pdo = Database::getConnection();

    $sql = "
        UPDATE menu
        SET titre = ?,
            description_courte = ?,
            description_longue = ?,
            nb_personnes_min = ?,
            prix_par_personne = ?,
            stock = ?,
            conditions = ?,
            theme_id = ?,
            regime_id = ?
        WHERE id = ?
    ";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        $titre,
        $descriptionCourte,
        $descriptionLongue,
        $nbPersonnesMin,
        $prixParPersonne,
        $stock,
        $conditions,
        $themeId,
        $regimeId,
        $id
    ]);
}
public function detachPlatsFromMenu(int $menuId): bool
{
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        DELETE FROM menu_plat
        WHERE menu_id = ?
    ");

    return $stmt->execute([$menuId]);
}
public function isUsedInOrder(int $menuId): bool
{
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        SELECT COUNT(*)
        FROM commande
        WHERE menu_id = ?
    ");

    $stmt->execute([$menuId]);

    return (int) $stmt->fetchColumn() > 0;
}

public function deleteMenu(int $menuId): bool
{
    $this->deleteImagesByMenuId($menuId);
    $this->detachPlatsFromMenu($menuId);

    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        DELETE FROM menu
        WHERE id = ?
    ");

    return $stmt->execute([$menuId]);
}
private function slugify(string $text): string
{
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = trim($text, '-');

    return $text ?: 'menu';
}
public function getThemeNameById(int $id): ?string
{
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        SELECT nom
        FROM theme
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    $theme = $stmt->fetchColumn();

    return $theme ?: null;
}
public function saveMenuImages(
    int $menuId,
    string $titre,
    string $theme,
    array $images
): bool {
    $allowedTypes = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp'
    ];

    $themeSlug = $this->getThemeFolder($theme);
    $menuSlug = $menuId . '-' . $this->slugify($titre);

    $relativeDir = "assets/images/menus/$themeSlug/$menuSlug";
    $absoluteDir = __DIR__ . "/../../public/$relativeDir";

    if (!is_dir($absoluteDir)) {
        mkdir($absoluteDir, 0777, true);
    }

    $pdo = Database::getConnection();

    foreach ($images['name'] as $index => $name) {
        if ($images['error'][$index] !== UPLOAD_ERR_OK) {
            return false;
        }

        $tmpName = $images['tmp_name'][$index];
        $mimeType = mime_content_type($tmpName);

        if (!isset($allowedTypes[$mimeType])) {
            return false;
        }

        $order = $index + 1;
        $extension = $allowedTypes[$mimeType];

        $fileName = "image-$order.$extension";
        $relativePath = "$relativeDir/$fileName";
        $absolutePath = "$absoluteDir/$fileName";

        if (!move_uploaded_file($tmpName, $absolutePath)) {
            return false;
        }

        $stmt = $pdo->prepare("
            INSERT INTO image (
                url,
                texte_alternatif,
                ordre_affichage,
                menu_id
            )
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([
            $relativePath,
            $titre,
            $order,
            $menuId
        ]);
    }

    return true;
}
private function getThemeFolder(string $theme): string
{
    return match ($theme) {
        'Classique' => 'classique',
        'Événement' => 'evenement',
        'Noël' => 'noel',
        'Pâques' => 'paques',
        default => $this->slugify($theme),
    };
}
public function deleteImagesByMenuId(int $menuId): bool
{
    $images = $this->getImagesByMenuId($menuId);

    $oldDirectory = null;

    if (!empty($images)) {
        $oldDirectory = dirname(__DIR__ . '/../../public/' . $images[0]['url']);
    }

    foreach ($images as $image) {
        $absolutePath = __DIR__ . '/../../public/' . $image['url'];

        if (file_exists($absolutePath)) {
            unlink($absolutePath);
        }
    }

    if ($oldDirectory !== null && is_dir($oldDirectory)) {
        $filesInDirectory = array_diff(scandir($oldDirectory), ['.', '..']);

        if (empty($filesInDirectory)) {
            rmdir($oldDirectory);
        }
    }

    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        DELETE FROM image
        WHERE menu_id = ?
    ");

    return $stmt->execute([$menuId]);
}
public function replaceMenuImages(
    int $menuId,
    string $titre,
    string $theme,
    array $files
): bool {

    // Récupère les anciennes images
    $images = $this->getImagesByMenuId($menuId);

    $oldDirectory = null;

    // Récupère le dossier des anciennes images
    if (!empty($images)) {
        $oldDirectory = dirname(__DIR__ . '/../../public/' . $images[0]['url']);
    }

    // Supprime les anciens fichiers
    foreach ($images as $image) {

        $absolutePath = __DIR__ . '/../../public/' . $image['url'];

        if (file_exists($absolutePath)) {
            unlink($absolutePath);
        }
    }

    // Supprime le dossier s'il est vide
    if (
        $oldDirectory !== null &&
        is_dir($oldDirectory)
    ) {

        $filesInDirectory = array_diff(scandir($oldDirectory), ['.', '..']);

        if (empty($filesInDirectory)) {
            rmdir($oldDirectory);
        }
    }

    // Supprime les anciennes lignes de la base
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        DELETE FROM image
        WHERE menu_id = ?
    ");

    $stmt->execute([$menuId]);

    // Enregistre les nouvelles images
    return $this->saveMenuImages(
        $menuId,
        $titre,
        $theme,
        $files
    );
}
}