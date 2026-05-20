<?php
require_once __DIR__ . '/../Helpers/Auth.php';
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
    require_once __DIR__ . '/../Views/pages/admin-statistics.php';
  }

  
      public function turnover(): void
  {
    Auth::requireRole(['Admin']);
    require_once __DIR__ . '/../Views/pages/admin-turnover.php';
  }
}