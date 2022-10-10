<?php 

namespace App\Controllers;
use Core\Controller;
use Core\View;
use App\Models\Language;
use Core\RequestFactory;
use Core\Response;
use PDOException;
use Exception;
use Core\ErrorHandler;


Class Languages extends Controller {

    protected function before(){}
    protected function after(){}
    
    public function indexAction()//get all posts
    {
        try {
            $languages = Language::getLanguages();
            Response::apiResponse($languages);
        }catch(PDOException $e){
                echo $e->getMessage(); 
                return false;
        }     
    }


   
    
}
