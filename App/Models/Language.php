<?php

namespace App\Models;
use PDO;
use PDOException;
use Core\Model;
use Core\FakeDB;


class Language extends Model
{
    public static function getLanguages()
    {
        try {
            $results = FakeDB::query();
            return $results['Languages'];
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

}