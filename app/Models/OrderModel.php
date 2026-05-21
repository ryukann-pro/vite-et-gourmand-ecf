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
    ): bool {
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

        return $stmt->execute([
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

}