<?php

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $envFile = parse_ini_file(
                __DIR__ . '/../.env',
                false,
                INI_SCANNER_RAW
            ) ?: [];

            /*
             * Dans Docker, getenv() récupère les variables transmises
             * par compose.yaml.
             *
             * Sous WAMP, si la variable système n'existe pas,
             * on utilise la valeur du fichier .env.
             */
            $getEnvValue = static function (
                string $key,
                ?string $default = null
            ) use ($envFile): ?string {
                $systemValue = getenv($key);

                if ($systemValue !== false) {
                    return $systemValue;
                }

                return $envFile[$key] ?? $default;
            };

            $host = $getEnvValue('DB_HOST', 'localhost');
            $port = $getEnvValue('DB_PORT', '3306');
            $dbname = $getEnvValue('DB_NAME');
            $user = $getEnvValue('DB_USER');
            $password = $getEnvValue('DB_PASSWORD');

            if (!$dbname || !$user || $password === null) {
                throw new RuntimeException(
                    'La configuration de la base de données est incomplète.'
                );
            }

            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                $host,
                $port,
                $dbname
            );

            self::$pdo = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        }

        return self::$pdo;
    }
}