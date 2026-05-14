<?php

require_once __DIR__ . '/../config/database.php';

try {

    $pdo = Database::getConnection();

    echo "Connexion à la base de données réussie";

} catch (PDOException $e) {

    echo "Erreur : " . $e->getMessage();
}