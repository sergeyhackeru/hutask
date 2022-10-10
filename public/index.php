<?php

use Core\Router;
use Core\Config;
use Core\DB;
use App\Models\User;
use App\Models\Post;

chdir(dirname(__DIR__));
require_once  'vendor/autoload.php';

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new Router();
$router->add('', ['controller'=>'Lectors', 'action'=>'index']);//get all unmodified data
$router->add('lectors', ['controller'=>'Lectors', 'action'=>'getlanglectors']);//get lectors with modified languages
$router->add('lectors/{id:\d+}', ['controller'=>'Lectors', 'action'=>'lectorbyid']);//get lector by args/params

$router->add('languages', ['controller'=>'Languages', 'action'=>'index']);//get Languages 


//Patterns in case of CRUD development
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');


$url = $_SERVER['QUERY_STRING'];

$router->dispatch($url);






