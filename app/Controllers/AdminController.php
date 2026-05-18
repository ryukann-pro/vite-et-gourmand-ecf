<?php

class AdminController
{
    public function dashboard(): void
    {
        require_once __DIR__ . '/../Views/pages/admin-dashboard.php';
    }
}