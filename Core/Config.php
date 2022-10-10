<?php

namespace Core;

class Config
{

    public static $ass = 'asdasd'; 

    private static $config = [
        
        'db' => array(
            'name'=>'simpl',
            'host'=>'127.0.0.1',
            'user'=>'root',
            'password' => '',
        ),

        'app' => array(
            'name' => 'Jarls Template',
            'version' => '0.0.1',
            'root_dir' => '/simpl',
            'base_url' => 'http://127.0.0.1/',
            'show_errors' => false,
        ),

        'remember' => array(
            'cookie_name' => 'hash',
            'cookie_expiry' => 60480
        ),
        
        'session' => array(
            'session_name' => 'user'
        )
    ];


    public static function get( $path = null ){
        if($path) {
            $config = self::$config;
            $path = explode('/' , $path);
            foreach ($path as $bit){
               if(isset($config[$bit])){
                    $config = $config[$bit];
               }
            }
            return $config;
        }
     }

    // public static function get_config($key){
    //     return array_key_exists($key, self::$config) ? self::$config[$key] : NULL;
    // }

}

?>