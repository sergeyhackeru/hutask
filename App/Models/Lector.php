<?php

namespace App\Models;
use PDO;
use PDOException;
use Core\Model;
use Core\FakeDB;


class Lector extends Model
{
    public static function getDbData()
    {
        try {
            $results = FakeDB::query();
            return $results;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function setLectorsLanguages($lector)
    {

        $mod_lector =$lector;
        $languages = FakeDB::query(); 
        foreach($mod_lector['languages'] as $lector_lang_id){          
            foreach ($languages['Languages'] as $lang){                             
                if ($lector_lang_id == $lang['id']) {
                    $mod_lector['languages'][$lang['id']] = $lang['name'];            
                }
            }
            
        }
       
        $mod_lector['languages'] = array_filter( $mod_lector['languages'], fn($arrayEntry) => !is_numeric($arrayEntry));
        $mod_lector['languages'] = array_values($mod_lector['languages']);

        return $mod_lector;
        
    }

}