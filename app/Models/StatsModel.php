<?php

require_once __DIR__ . '/../../config/DatabaseMongo.php';

class StatsModel
{
    private MongoDB\Collection $statisticsCollection;
    private MongoDB\Collection $turnoverCollection;
    public function __construct()
    {
        $database = DatabaseMongo::getDatabase();

        $this->statisticsCollection = $database->statistiques_menu;
        $this->turnoverCollection = $database->chiffre_affaires_commandes;
    }

    public function getAll(): array
    {
        $cursor = $this->statisticsCollection->find(
            [],
            [
                'sort' => ['menu_id' => 1],
                'typeMap' => [
                    'root' => 'array',
                    'document' => 'array',
                    'array' => 'array'
                ]
            ]
        );

        return $cursor->toArray();
    }
    public function getTurnoverStatistics(
        ?int $menuId = null,
        ?string $dateDebut = null,
        ?string $dateFin = null
    ): array {
        $filter = [];

        if ($menuId !== null && $menuId > 0) {
            $filter['menu_id'] = $menuId;
        }

        if ($dateDebut !== null && $dateDebut !== '') {
            $filter['date_terminee']['$gte'] = $dateDebut . ' 00:00:00';
        }

        if ($dateFin !== null && $dateFin !== '') {
            $filter['date_terminee']['$lte'] = $dateFin . ' 23:59:59';
        }

        $cursor = $this->turnoverCollection->find(
            $filter,
            [
                'sort' => [
                    'date_terminee' => 1,
                    'menu_id' => 1
                ],
                'typeMap' => [
                    'root' => 'array',
                    'document' => 'array',
                    'array' => 'array'
                ]
            ]
        );

        return $cursor->toArray();
    }

    public function insert(array $statistique): bool
    {
        $result = $this->statisticsCollection->insertOne($statistique);

        return $result->isAcknowledged();
    }

    public function deleteAll(): bool
    {
        $result = $this->statisticsCollection->deleteMany([]);

        return $result->isAcknowledged();
    }
    public function synchronizeFromSql(array $statistics): bool
    {
        $this->deleteAll();

        foreach ($statistics as $statistic) {
            $inserted = $this->insert([
                'menu_id' => (int) $statistic['menu_id'],
                'menu' => $statistic['menu'],
                'commandes' => (int) $statistic['commandes'],
                'chiffre_affaires' => (float) $statistic['chiffre_affaires'],
                'prix_moyen' => (float) $statistic['prix_moyen'],
                'date_synchronisation' => new MongoDB\BSON\UTCDateTime()
            ]);

            if (!$inserted) {
                return false;
            }
        }

        return true;
    }
    public function insertTurnoverOrder(array $order): bool
    {
        $result = $this->turnoverCollection->insertOne($order);

        return $result->isAcknowledged();
    }

    public function deleteAllTurnoverOrders(): bool
    {
        $result = $this->turnoverCollection->deleteMany([]);

        return $result->isAcknowledged();
    }

    public function synchronizeTurnoverFromSql(array $orders): bool
    {
        $this->deleteAllTurnoverOrders();

        foreach ($orders as $order) {

            $inserted = $this->insertTurnoverOrder([
                'commande_id' => (int) $order['commande_id'],
                'menu_id' => (int) $order['menu_id'],
                'menu' => $order['menu'],
                'date_terminee' => $order['date_terminee'],
                'chiffre_affaires' => (float) $order['chiffre_affaires']
            ]);

            if (!$inserted) {
                return false;
            }
        }

        return true;
    }
}
