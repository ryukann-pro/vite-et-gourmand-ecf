<?php

require_once __DIR__ . '/../Helpers/Auth.php';

class UserController
{
    public function account(): void
    {
        Auth::requireRole(['Client']);

        require_once __DIR__ . '/../Views/pages/account.php';
    }
}