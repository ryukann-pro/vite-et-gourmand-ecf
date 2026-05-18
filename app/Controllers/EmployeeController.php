<?php

class EmployeeController
{
  public function dashboard():void
  {
    require_once __DIR__ . '/../Views/pages/employee-dashboard.php';
  }

  public function orders():void
  {
    require_once __DIR__ . '/../Views/pages/employee-orders.php';
  }

    public function orderDetail():void
  {
    require_once __DIR__ . '/../Views/pages/employee-order-detail.php';
  }

      public function reviews():void
  {
    require_once __DIR__ . '/../Views/pages/employee-reviews.php';
  }
  
  public function menus():void
  {
    require_once __DIR__ . '/../Views/pages/employee-menus.php';
  }

    public function plates():void
  {
    require_once __DIR__ . '/../Views/pages/employee-plates.php';
  }
}