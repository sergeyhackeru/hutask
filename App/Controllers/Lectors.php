<?php 

namespace App\Controllers;
use Core\Controller;
use Core\View;
use App\Models\Lector;
use App\Models\Language;
use Core\RequestFactory;
use Core\Response;
use PDOException;
use Exception;
use Core\ErrorHandler;


Class Lectors extends Controller {

    protected function before(){}
    protected function after(){}
    
    public function indexAction()//get all data
    {
        try {
            $lectors = Lector::getDbData();
            Response::apiResponse($lectors);
        }catch(PDOException $e){
                echo $e->getMessage(); 
                return false;
        }     
    }

    public function getlanglectorsAction()
    {
        try {
            $lectors = Lector::getDbData(); 
            $updated_lector = array();
            $updated_lectors = array();
    
            foreach($lectors['Lecturers'] as $lector){
                $updated_lector = Lector::setLectorsLanguages($lector);      
                array_push($updated_lectors,$updated_lector);     
            }
            Response::apiResponse($updated_lectors);

        }catch(PDOException $e){
            echo $e->getMessage(); 
            return false;
        }    
    }




   
    
}
