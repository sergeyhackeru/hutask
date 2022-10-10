<?php
public static function getLectorByLanguage($id)
{
    $matchingLector = array();
    $results = FakeDB::query();


    foreach($results as $key => $value) {
        if($key == "Lecturers"){
            foreach($value as $v){
                foreach($v['languages'] as $lang){
                    if($lang==$id){
                        array_push($matchingLector, $v); 
                    }
                }
            }
        }
    }
    return $matchingLector;
}













public static function getLectorByLanguage($id)
{
    $matchingLector = array();
    $results = FakeDB::query();


    foreach($results as $key => $value) {
        if($key == "Lecturers"){
            foreach($value as $v){
                foreach($v['languages'] as $lang){
                    if($lang==$id){

                        $v['languages'][$id] = 'language str';
                        array_push($matchingLector, $v); 
                    }
                }
            }
        }
    }
    return $matchingLector;
}





//awsome!!!!!!
public static function setLectorsLanguages($lector)
{
    $languages = FakeDB::query(); 
    foreach($lector['languages'] as $lector_lang_id){          
        foreach ($languages['Languages'] as $lang){                             
            if ($lector_lang_id == $lang['id']) {
                $lector['languages'][$lang['id']]= $lang['name'];            
            }
        }
        
    }
    $lector['languages'] = array_filter( $lector['languages'], fn($arrayEntry) => !is_numeric($arrayEntry));
    return $lector;   
}

?>