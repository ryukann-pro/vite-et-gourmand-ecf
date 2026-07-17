<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

class DatabaseMongo
{
    private static ?Client $client = null;

    public static function getConnection(): Client
    {
        if (self::$client === null) {
            self::$client = new Client('mongodb://localhost:27017');
        }

        return self::$client;
    }

    public static function getDatabase(): \MongoDB\Database
    {
        return self::getConnection()->selectDatabase('vite_et_gourmand_stats');
    }
}