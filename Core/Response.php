<?php 

namespace Core;
use Core\View;

    class Response{

        public function __construct(){

        }

        public static function apiResponse($data) {
            $response = $data;
            header('Content-Type: application/json; charset=utf-8');
            header("Access-Control-Allow-Origin: *");
            echo json_encode($response, JSON_PRETTY_PRINT);
        }

        public static function noContentResponse(){
           
        }

        public static function notFoundResponse(){
           
        }

        public static function methodNotAllowedResponse(){
            $response = [ 'error'=>[ 'msg' => '405 Method Not Allowed' ]];
            http_response_code(405);
        }




    }

?>