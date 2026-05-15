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
}