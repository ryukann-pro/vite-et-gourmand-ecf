<?php

class AdminController
{
  public function dashboard(): void
  {
    require_once __DIR__ . '/../Views/pages/admin-dashboard.php';
  }

  public function employees(): void
  {
    require_once __DIR__ . '/../Views/pages/admin-employees.php';
  }

    public function createEmployee(): void
  {
    require_once __DIR__ . '/../Views/pages/admin-create-employee.php';
  }

      public function statistics(): void
  {
    require_once __DIR__ . '/../Views/pages/admin-statistics.php';
  }

  
      public function turnover(): void
  {
    require_once __DIR__ . '/../Views/pages/admin-turnover.php';
  }
}