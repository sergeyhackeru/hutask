<?php

namespace Core;
use App\Config;
use Core\ErrorHandler;

use Exception;

Class Router {

    protected $routes =[];
    protected $matched_params = [];
    
    public function add($route, $params=[]){
        $route =  preg_replace('/\//', '\\/', $route);
        $route =  preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route =  preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;
    }
    
    public function getRoutes(){
        return $this->routes;
    }
    
    public function match($url) {
        foreach($this->routes as $route => $params) {
            if(preg_match($route, $url, $matches)){
                foreach($matches as $key =>$value) {
                    if(is_string($key)){
                        $params[$key] = $value;
                    }
                }
                $this->matched_params = $params;
                return true;
            }
        }
        return false;
    }

    public function dispatch($url){

        $url = $this->removeQueryStringVariables($url);

        if(!$this->match($url)){
            ErrorHandler::throwAndLogErr('No route mached','Not Found',404);
        }

        $controller = $this->matched_params['controller'];
        $controller = $this->convertToStudlyCaps($controller);
        $controller = $this->getNamespace() . $controller;

        if(!class_exists($controller)){
            ErrorHandler::throwAndLogErr("Controller class  $controller  not found", 'Bad Gettaway',505);
        }
        $controller_object = new $controller($this->matched_params);
        $action = $this->matched_params['action'];
        $action = $this->convertToCamelCase($action);

        if(!is_callable([$controller_object, $action])){
            ErrorHandler::throwAndLogErr("Method $action (in controller $controller ) not found", 'Bad Gettawayx',505);
        }
        $controller_object->$action();
    }

    public function getMatchedParams(){
        return $this->matched_params;
    }

    public function convertToStudlyCaps($string){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    public function convertToCamelCase($string){
        return lcfirst($this->convertToStudlyCaps($string));
    }

    protected function removeQueryStringVariables($url)
    {
        if($url != '') {
            $parts = explode('&', $url, 2);
            if(strpos($parts[0],  '=') === false ) {
                $url = $parts[0];
            }else {
                $url ='';
            }
        }
        return $url;
    }


    protected function getNamespace()
    {
        $namespace = 'App\controllers\\';
        if(array_key_exists('namespace', $this->matched_params)){
            $namespace .= $this->matched_params['namespace'] . '\\';
        }
        return $namespace;
    }




}