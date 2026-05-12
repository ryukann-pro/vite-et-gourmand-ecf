<?php

class AuthController
{
    public function login(): void
    {
        require_once __DIR__ . '/../Views/pages/login.php';
    }

    public function register(): void
    {
        require_once __DIR__ . '/../Views/pages/register.php';
    }
}