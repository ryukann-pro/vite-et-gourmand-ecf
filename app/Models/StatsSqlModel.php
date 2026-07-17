<?php

require_once __DIR__ . '/../../config/database.php';

class StatsSqlModel
{
    public function getStatisticsByMenu(): array
    {
        $pdo = Database::getConnection();

        $sql = "
            SELECT
                menu.id AS menu_id,
                menu.titre AS menu,
                COUNT(commande.id) AS commandes,

                COALESCE(
                    SUM(
                        (commande.nb_personnes * commande.prix_unitaire)
                        - commande.reduction
                    ),
                    0
                ) AS chiffre_affaires,

                COALESCE(
                    AVG(
                        (commande.nb_personnes * commande.prix_unitaire)
                        - commande.reduction
                    ),
                    0
                ) AS prix_moyen

            FROM menu

            LEFT JOIN commande
                ON commande.menu_id = menu.id
                AND commande.statut_id = 7

            GROUP BY
                menu.id,
                menu.titre

            ORDER BY
                menu.id ASC
        ";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll();
    }
    public function getCompletedOrdersForStatistics(): array
    {
        $pdo = Database::getConnection();

        $sql = "
        SELECT
            commande.id AS commande_id,
            commande.menu_id,
            menu.titre AS menu,

            MAX(suivi_commande.date_changement) AS date_terminee,

            (
                commande.nb_personnes * commande.prix_unitaire
            ) - commande.reduction AS chiffre_affaires

        FROM commande

        INNER JOIN menu
            ON menu.id = commande.menu_id

        INNER JOIN suivi_commande
            ON suivi_commande.commande_id = commande.id
            AND suivi_commande.statut_id = 7

        WHERE commande.statut_id = 7

        GROUP BY
            commande.id,
            commande.menu_id,
            menu.titre,
            commande.nb_personnes,
            commande.prix_unitaire,
            commande.reduction

        ORDER BY date_terminee ASC
    ";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll();
    }
}
