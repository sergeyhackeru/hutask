<?php

namespace Core;
use PDO;
use PDOException;
use App\Config;

Class FakeDB
{
    public static function query(){
        $json = file_get_contents(__DIR__ . '/fakedb.json', true);
        return json_decode($json,true);
    }
}