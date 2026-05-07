<?php

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $env = parse_ini_file(__DIR__ . '/../.env');

        $host = $env['DB_HOST'];
        $dbname = $env['DB_NAME'];
        $user = $env['DB_USER'];
        $password = $env['DB_PASSWORD'];

        try {
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $user,
                $password
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}