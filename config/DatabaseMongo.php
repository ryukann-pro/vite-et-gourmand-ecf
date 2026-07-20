<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;
use MongoDB\Database;

class DatabaseMongo
{
    private static ?Client $client = null;

    public static function getConnection(): Client
    {
        if (self::$client === null) {
            $host = getenv('MONGO_HOST') ?: 'localhost';
            $port = getenv('MONGO_PORT') ?: '27017';

            self::$client = new Client(
                "mongodb://{$host}:{$port}"
            );
        }

        return self::$client;
    }

    public static function getDatabase(): Database
    {
        $database = getenv('MONGO_DATABASE')
            ?: 'vite_et_gourmand_stats';

        return self::getConnection()->selectDatabase($database);
    }
}