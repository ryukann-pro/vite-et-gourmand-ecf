<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/MenuModel.php';

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
        $stmt->execute([$orderId, $userId]);

        return $stmt->rowCount() > 0;
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
    public function addOrderTracking(int $orderId, int $statusId, ?int $userId = null): bool
    {
        $pdo = Database::getConnection();

        $sql = "
        INSERT INTO suivi_commande (
            commande_id,
            statut_id,
            utilisateur_id,
            date_changement
        )
        VALUES (?, ?, ?, NOW())
    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([$orderId, $statusId, $userId]);
    }

    public function getOrderTracking(int $orderId): array
    {
        $pdo = Database::getConnection();

        $sql = "
        SELECT
            suivi_commande.date_changement,
            statut_commande.nom AS statut,
            utilisateur.nom AS auteur_nom,
            utilisateur.prenom AS auteur_prenom,
            role.nom AS auteur_role
        FROM suivi_commande
        INNER JOIN statut_commande 
            ON suivi_commande.statut_id = statut_commande.id
        LEFT JOIN utilisateur
            ON suivi_commande.utilisateur_id = utilisateur.id
        LEFT JOIN role
            ON utilisateur.role_id = role.id
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
        $stmt->execute([$orderId]);

        return $stmt->rowCount() > 0;
    }
    public function getOrderStockData(int $orderId): ?array
    {
        $pdo = Database::getConnection();

        $sql = "
        SELECT
            menu_id,
            nb_personnes
        FROM commande
        WHERE id = ?
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$orderId]);

        $order = $stmt->fetch();

        return $order ?: null;
    }

    public function createCompleteOrder(
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
        try {
            $pdo->beginTransaction();

            $orderId = $this->createOrder(
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
                $pretMateriel,
                $utilisateurId,
                $menuId,
                $villeId,
                $statutId
            );
            if ($orderId === 0) {
                throw new Exception("Impossible de créer la commande.");
            }
            $menuModel = new MenuModel();

            $stockUpdated = $menuModel->decrementStock(
                $menuId,
                $nbPersonnes
            );
            if (!$stockUpdated) {
                throw new Exception("Impossible de mettre à jour le stock.");
            }
            $trackingAdded = $this->addOrderTracking(
                $orderId,
                1
            );
            // TEST UNIQUEMENT $trackingAdded = false; 
            if (!$trackingAdded) {
                throw new Exception("Impossible de créer le suivi de commande.");
            }
            $pdo->commit();
            return $orderId;
        } catch (Exception $e) {
            $pdo->rollBack();
            return 0;
        }
    }

    public function cancelCompleteOrder(
        int $orderId,
        ?int $userId,
        int $trackingUserId,
        bool $isEmployee
    ): bool {

        $pdo = Database::getConnection();

        try {

            $pdo->beginTransaction();

            // La logique arrivera ensuite
            $order = $this->getOrderStockData($orderId);

            if ($order === null) {
                throw new Exception("Commande introuvable.");
            }
            if ($isEmployee) {

                $cancelled = $this->cancelOrderByEmployee($orderId);
            } else {

                $cancelled = $this->cancelOrder(
                    $orderId,
                    $userId
                );
            }

            if (!$cancelled) {
                throw new Exception("Impossible d'annuler la commande.");
            }
            $menuModel = new MenuModel();

            $stockUpdated = $menuModel->incrementStock(
                (int) $order['menu_id'],
                (int) $order['nb_personnes']
            );

            if (!$stockUpdated) {
                throw new Exception("Impossible de remettre le stock.");
            }
            $trackingAdded = $this->addOrderTracking(
                $orderId,
                8,
                $trackingUserId
            );

            if (!$trackingAdded) {
                throw new Exception("Impossible d'ajouter le suivi de commande.");
            }
            $pdo->commit();
            return true;
        } catch (Exception $e) {

            $pdo->rollBack();
            return false;
        }
    }
}
