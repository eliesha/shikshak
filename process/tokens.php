<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'token.php';

$token = new Token();

if(isset($_POST['token']) && !empty($_POST['token'])){
    
    $data['token'] = $_POST['token'];
    
    $checkToken = $token->existingToken($_POST['token']);
    
    if(!$checkToken){
        
        $insertTokenDetails = $token->insertToken($data);
        
        if($insertTokenDetails){
        
            $result['success'] = "1";
            
            $result['message'] = "App installed successfully.";
            
            echo json_encode($result);
        
        }
        
    }
    
}