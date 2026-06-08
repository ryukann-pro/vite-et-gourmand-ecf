<?php

require_once __DIR__ . '/../../config/database.php';

class OrderModel
{
    public function createOrder(
        string $nomClient,
        string $prenomClient,
        string $telephoneClient,
        string $emailClient,
        int $nbPersonnes,
        float $prixUnitaire,
        string $adresseLivraison,
        string $dateLivraison,
        string $heureLivraison,
        float $fraisLivraison,
        float $reduction,
        float $prixTotal,
        bool $pretMateriel,
        int $utilisateurId,
        int $menuId,
        int $villeId,
        int $statutId
    ): int {
        $pdo = Database::getConnection();

        $sql = "
            INSERT INTO commande (
                nom_client,
                prenom_client,
                telephone_client,
                email_client,
                nb_personnes,
                prix_unitaire,
                adresse_livraison,
                date_livraison,
                heure_livraison,
                frais_livraison,
                reduction,
                prix_total,
                pret_materiel,
                utilisateur_id,
                menu_id,
                ville_id,
                statut_id
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt = $pdo->prepare($sql);

        $created = $stmt->execute([
            $nomClient,
            $prenomClient,
            $telephoneClient,
            $emailClient,
            $nbPersonnes,
            $prixUnitaire,
            $adresseLivraison,
            $dateLivraison,
            $heureLivraison,
            $fraisLivraison,
            $reduction,
            $prixTotal,
            $pretMateriel ? 1 : 0,
            $utilisateurId,
            $menuId,
            $villeId,
            $statutId
        ]);

        if ($created) {
            return (int) $pdo->lastInsertId();
        }

        return 0;
    }

    public function getOrdersByUserId(int $userId): array
    {
        $pdo = Database::getConnection();

        $sql = "
        SELECT 
            commande.id,
            commande.date_creation,
            commande.prix_total,
            menu.titre AS menu_titre,
            statut_commande.nom AS statut
        FROM commande
        INNER JOIN menu ON commande.menu_id = menu.id
        INNER JOIN statut_commande ON commande.statut_id = statut_commande.id
        WHERE commande.utilisateur_id = ?
        ORDER BY commande.date_creation DESC
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    public function getOrderByIdAndUserId(int $orderId, int $userId): ?array
    {
        $pdo = Database::getConnection();

        $sql = "
        SELECT
            commande.*,
            menu.titre AS menu_titre,
            statut_commande.nom AS statut,
            ville_commande.nom AS ville
        FROM commande
        INNER JOIN menu ON commande.menu_id = menu.id
        INNER JOIN statut_commande ON commande.statut_id = statut_commande.id
        INNER JOIN ville_commande ON commande.ville_id = ville_commande.id
        WHERE commande.id = ?
        AND commande.utilisateur_id = ?
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$orderId, $userId]);

        $order = $stmt->fetch();

        return $order ?: null;
    }

    public function updateOrder(
        int $orderId,
        int $userId,
        string $adresseLivraison,
        string $dateLivraison,
        string $heureLivraison,
        int $nbPersonnes,
        int $villeId,
        float $fraisLivraison,
        float $reduction,
        float $prixTotal,
        bool $pretMateriel
    ): bool {
        $pdo = Database::getConnection();

        $sql = "
        UPDATE commande
        SET
            adresse_livraison = ?,
            date_livraison = ?,
            heure_livraison = ?,
            nb_personnes = ?,
            ville_id = ?,
            frais_livraison = ?,
            reduction = ?,
            prix_total = ?,
            pret_materiel = ?
        WHERE id = ?
        AND utilisateur_id = ?
        AND statut_id IN (1, 2)
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $adresseLivraison,
            $dateLivraison,
            $heureLivraison,
            $nbPersonnes,
            $villeId,
            $fraisLivraison,
            $reduction,
            $prixTotal,
            $pretMateriel ? 1 : 0,
            $orderId,
            $userId
        ]);
    }

    public function cancelOrder(int $orderId, int $userId): bool
    {
        $pdo = Database::getConnection();

        $sql = "
        UPDATE commande
        SET statut_id = 8
        WHERE id = ?
        AND utilisateur_id = ?
        AND statut_id = 1
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $orderId,
            $userId
        ]);
    }

    public function getAllOrders(): array
    {
        $pdo = Database::getConnection();

        $sql = "
        SELECT
            commande.id,
            commande.date_creation,
            commande.date_livraison,
            commande.prix_total,
            commande.nom_client,
            commande.prenom_client,
            menu.titre AS menu_titre,
            statut_commande.nom AS statut
        FROM commande
        INNER JOIN menu ON commande.menu_id = menu.id
        INNER JOIN statut_commande ON commande.statut_id = statut_commande.id
        ORDER BY commande.date_creation DESC
    ";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll();
    }
    public function getOrderByIdForEmployee(int $orderId): ?array
    {
        $pdo = Database::getConnection();

        $sql = "
        SELECT
            commande.*,
            menu.titre AS menu_titre,
            statut_commande.nom AS statut,
            ville_commande.nom AS ville
        FROM commande
        INNER JOIN menu ON commande.menu_id = menu.id
        INNER JOIN statut_commande ON commande.statut_id = statut_commande.id
        INNER JOIN ville_commande ON commande.ville_id = ville_commande.id
        WHERE commande.id = ?
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$orderId]);

        $order = $stmt->fetch();

        return $order ?: null;
    }

    public function updateStatus(int $orderId, int $statusId): bool
    {
        $pdo = Database::getConnection();

        $sql = "
        UPDATE commande
        SET statut_id = ?
        WHERE id = ?
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([$statusId, $orderId]);
    }
    public function addOrderTracking(int $orderId, int $statusId): bool
    {
        $pdo = Database::getConnection();

        $sql = "
        INSERT INTO suivi_commande (
            commande_id,
            statut_id,
            date_changement
        )
        VALUES (?, ?, NOW())
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([$orderId, $statusId]);
    }

    public function getOrderTracking(int $orderId): array
    {
        $pdo = Database::getConnection();

        $sql = "
        SELECT
            suivi_commande.date_changement,
            statut_commande.nom AS statut
        FROM suivi_commande
        INNER JOIN statut_commande 
            ON suivi_commande.statut_id = statut_commande.id
        WHERE suivi_commande.commande_id = ?
        ORDER BY suivi_commande.date_changement ASC
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$orderId]);

        return $stmt->fetchAll();
    }
    public function searchOrders(?int $statusId, ?string $clientSearch): array
    {
        $pdo = Database::getConnection();

        $sql = "
        SELECT
            commande.id,
            commande.date_creation,
            commande.date_livraison,
            commande.prix_total,
            commande.nom_client,
            commande.prenom_client,
            commande.email_client,
            menu.titre AS menu_titre,
            statut_commande.nom AS statut
        FROM commande
        INNER JOIN menu ON commande.menu_id = menu.id
        INNER JOIN statut_commande ON commande.statut_id = statut_commande.id
        WHERE 1 = 1
    ";

        $params = [];

        if ($statusId !== null && $statusId > 0) {
            $sql .= " AND commande.statut_id = ?";
            $params[] = $statusId;
        }

        if ($clientSearch !== null && $clientSearch !== '') {
            $sql .= "
            AND (
                commande.nom_client LIKE ?
                OR commande.prenom_client LIKE ?
                OR commande.email_client LIKE ?
            )
        ";

            $search = '%' . $clientSearch . '%';

            $params[] = $search;
            $params[] = $search;
            $params[] = $search;
        }

        $sql .= " ORDER BY commande.date_creation DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
    public function cancelOrderByEmployee(int $orderId): bool
    {
        $pdo = Database::getConnection();

        $sql = "
        UPDATE commande
        SET statut_id = 8
        WHERE id = ?
        AND statut_id IN (1, 2, 3)
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([$orderId]);
    }
}
