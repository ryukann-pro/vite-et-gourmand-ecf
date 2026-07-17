<?php
require_once __DIR__ . '/../Helpers/Auth.php';
require_once __DIR__ . '/../Models/StatsSqlModel.php';
require_once __DIR__ . '/../Models/StatsModel.php';

class AdminController
{
  public function dashboard(): void
  {
    Auth::requireRole(['Admin']);
    require_once __DIR__ . '/../Views/pages/admin-dashboard.php';
  }

  public function employees(): void
  {
    Auth::requireRole(['Admin']);
    require_once __DIR__ . '/../Views/pages/admin-employees.php';
  }

  public function createEmployee(): void
  {
    Auth::requireRole(['Admin']);
    require_once __DIR__ . '/../Views/pages/admin-create-employee.php';
  }

  public function statistics(): void
  {
    Auth::requireRole(['Admin']);

    $statsSqlModel = new StatsSqlModel();
    $statsMongoModel = new StatsModel();

    // 1. Calcul depuis MySQL
    $statisticsFromSql = $statsSqlModel->getStatisticsByMenu();

    // 2. Synchronisation vers MongoDB
    $statsMongoModel->synchronizeFromSql($statisticsFromSql);

    // 3. Lecture depuis MongoDB
    $statistics = $statsMongoModel->getAll();

    // 4. Total des commandes pour les pourcentages
    $totalCommandes = array_sum(
      array_column($statistics, 'commandes')
    );

    require_once __DIR__ . '/../Views/pages/admin-statistics.php';
  }


  public function turnover(): void
  {
    Auth::requireRole(['Admin']);

    $statsSqlModel = new StatsSqlModel();
    $statsMongoModel = new StatsModel();

    // Synchronisation MySQL vers MongoDB
    $completedOrders = $statsSqlModel->getCompletedOrdersForStatistics();

    $statsMongoModel->synchronizeTurnoverFromSql(
      $completedOrders
    );

    // Récupération des filtres GET
    $menuId = (int) ($_GET['menu_id'] ?? 0);
    $dateDebut = trim($_GET['date_debut'] ?? '');
    $dateFin = trim($_GET['date_fin'] ?? '');

    // Petite validation des dates
    $filterError = null;

    if (
      $dateDebut !== '' &&
      $dateFin !== '' &&
      $dateDebut > $dateFin
    ) {
      $filterError = "La date de début doit être antérieure à la date de fin.";
      $statistics = [];
    } else {
      // Lecture filtrée depuis MongoDB
      $statistics = $statsMongoModel->getTurnoverStatistics(
        $menuId > 0 ? $menuId : null,
        $dateDebut !== '' ? $dateDebut : null,
        $dateFin !== '' ? $dateFin : null
      );
    }

    require_once __DIR__ . '/../Views/pages/admin-turnover.php';
  }
}
