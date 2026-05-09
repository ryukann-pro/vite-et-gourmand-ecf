<?php

require_once __DIR__ . '/../config/database.php';

$database = new Database();
$pdo = $database->getPDO();

echo "Connexion PDO réussie";