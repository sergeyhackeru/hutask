<?php 

namespace Helpers;

Class Sanitize{

    public static function test(){
        echo 'Helpers class ok';
    }
    
    public function escape($string){
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }
}

