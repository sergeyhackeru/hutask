<?php 

namespace Core;
use App\Config;
use Exception;

class ErrorHandler {

    public static function throwAndLogErr($devmode_msg, $user_friendly_msg, $code){
        if(Config::SHOW_ERRORS === true){
            throw new Exception($devmode_msg, $code);
        }else{
            throw new Exception($user_friendly_msg, $code);
        }  
    }
}

?>