<?php

namespace Core;
use PDO;
use PDOException;
use App\Config;

abstract class Model
{
    private static $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname='    . Config::DB_NAME . ';charset=utf8';
    private static $user = Config::DB_USER;
    private static $password = Config::DB_PASSWORD;
    private static $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    private static $PDO = null;

    public static function getDB()
    {
        if (is_null(self::$PDO)) {
            try {
                self::$PDO = new \PDO(self::$dsn, self::$user, self::$password, self::$options);
            } catch (\PDOexception $e) {
                "Date base connection error " . $e->getMessage();
            }
        }
        return self::$PDO;
    }

}