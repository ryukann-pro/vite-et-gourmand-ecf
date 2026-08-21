<?php

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $envPath = __DIR__ . '/../.env';

            $envFile = file_exists($envPath)
                ? (parse_ini_file($envPath, false, INI_SCANNER_RAW) ?: [])
                : [];

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

            $jawsDbUrl = getenv('JAWSDB_URL');

            if ($jawsDbUrl) {
                $parts = parse_url($jawsDbUrl);

                $host = $parts['host'] ?? null;
                $port = (string) ($parts['port'] ?? 3306);
                $dbname = isset($parts['path'])
                    ? ltrim($parts['path'], '/')
                    : null;
                $user = $parts['user'] ?? null;
                $password = $parts['pass'] ?? null;
            } else {
                $host = $getEnvValue('DB_HOST', 'localhost');
                $port = $getEnvValue('DB_PORT', '3306');
                $dbname = $getEnvValue('DB_NAME');
                $user = $getEnvValue('DB_USER');
                $password = $getEnvValue('DB_PASSWORD');
            }

            if (!$host || !$dbname || !$user || $password === null) {
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
