<?php

namespace Core;
use ErrorException;
use App\Config;

class Error
{
    public static function errorHandler($level, $message, $file, $line)
    {
        if(error_reporting() !== 0) {
            throw new ErrorException($message, 0, $level, $file, $line);
        }
    }


    public static function exceptionHandler($exception)
    {

        $code = $exception->getCode();
        if($code!=404){
            $code = 500;
        }

        http_response_code($code);

        if(Config::SHOW_ERRORS){
            echo "<h1>Fatal Error</h1>";
            echo "<p>Uncaught exception: '" . get_class($exception) . "' <p>";
            echo "<p>Message: '" . $exception->getMessage() . "' <p>";
            echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Thrown in :'" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        }else{

            $log = dirname(__DIR__) . '/logs/' . date('y-m-d') . '.txt';

            ini_set('error_log', $log);
            $message = "Uncaught exception: '" . get_class($exception) . "'";
            $message .= " with message: '" . $exception->getMessage() . "'";
            $message .= " \nStack trace: '" . $exception->getTraceAsString();
            $message .= " \nTrown in : '" . $exception->getFile() . "' on line " . $exception->getLine();

            error_log($message);

            if(Config::SHOW_ERRORS === true){
                
                if($code == 404){
                    echo "<h1>dev mode message : 404 NOT FOUND</h1>";
                }else{
                    echo "<h1>dev mode message Sorry Some Error ocurred</h1>";
                }
                
            }else {
                $response_data =  [
                    'message' => $exception->getMessage(),
                    'code' =>$exception->getCode()
                ];
                Response::phpHTMLResponse("$code.php", 'response_data', $response_data);
            }

            

            

          

        }
        
    }
}