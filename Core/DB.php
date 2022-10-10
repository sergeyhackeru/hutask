<?php

namespace Core;
use PDO;
use PDOException;
use App\Config;

Class DB
{
    private static $_instance;
    private $_pdo;
    private $_error = false;
    private $_query;
    private $_results;
    private $_count = 0;

    private function __construct(){
        try{
            $this->_pdo = new PDO('mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME, Config::DB_USER, Config::DB_PASSWORD );
            echo 'Connected';
            echo '<br/>';
        }catch(PDOexception $e){
            "Date base connection error " . $e->getMessage();
        }
    }

    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array()){
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $pos=1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($pos, $param);
                    $pos++;
                }
            }
            if($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }

        return $this;
    }

    private function action($action, $table, $where = array()){

        if(!count($where)){
            echo $table;
            echo $action;
            $sql = "{$action} FROM {$table }";
            if($this->query($sql)){
                return $this;
            }
        }

       if(count($where)=== 3) {

           $operators   = array('=', '>', '<', '>=', '<=',);
           $field       = $where[0];
           $operator    = $where[1];
           $value       = $where[2];

           if(in_array( $operator, $operators )){
                $sql = "{$action} FROM {$table } WHERE {$field} {$operator} ?";
                if(!$this->query($sql, array($value))->error()){
                    return $this;
                }
           }
       } 

       return false;
    }

    public function get($table, $where = []){
        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where){
        return $this->action('DELETE *', $table, $where);
    }

    public function results(){
        return $this->_results;
    }

    public function count(){
        return $this->_count;
    }
    
    public function error(){
        return $this->_error;
    }





}