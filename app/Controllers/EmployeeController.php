<?php

require_once __DIR__ . '/../Helpers/Auth.php';

class EmployeeController
{
    public function dashboard(): void
    {
        Auth::requireRole(['Employé', 'Admin']);
        require_once __DIR__ . '/../Views/pages/employee-dashboard.php';
    }

    public function orders(): void
    {
        Auth::requireRole(['Employé', 'Admin']);
        require_once __DIR__ . '/../Views/pages/employee-orders.php';
    }

    public function orderDetail(): void
    {
        Auth::requireRole(['Employé', 'Admin']);
        require_once __DIR__ . '/../Views/pages/employee-order-detail.php';
    }

    public function reviews(): void
    {
        Auth::requireRole(['Employé', 'Admin']);
        require_once __DIR__ . '/../Views/pages/employee-reviews.php';
    }

    public function menus(): void
    {
        Auth::requireRole(['Employé', 'Admin']);
        require_once __DIR__ . '/../Views/pages/employee-menus.php';
    }

    public function plates(): void
    {
        Auth::requireRole(['Employé', 'Admin']);
        require_once __DIR__ . '/../Views/pages/employee-plates.php';
    }

    public function hours(): void
    {
        Auth::requireRole(['Employé', 'Admin']);
        require_once __DIR__ . '/../Views/pages/employee-hours.php';
    }
}