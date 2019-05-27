<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

$user = new User();

if(isset($_POST['token']) && !empty($_POST['token'])) {
    
    $token = $_POST['token'];
  
    $userToken = $user->getUserByActToken($token);
    
    if($userToken[0]->token == $token) {
        
        $status = 'Active';
        
         $data = " status = '".$status."'";
        
        $id = $userToken[0]->id;
        
        $updateStatus = $user->updateStatus($data, $id);
        
        if($updateStatus) {
            
            $token1 = $_POST['token'];
            
            $token = '';
            
            $data = " token = '".NULL."'";
            
            $delete = $user->updateToken($data, $token1);
            
            redirect('/signin.php', 'success', 'खाता सफलतापूर्वक सिर्जना गरियो! तपाईको प्रयोगकर्ता नाम र पासवर्डको साथ लगइन गर्नुहोस्।');
            
        } else {
            
            redirect('../activate.php?token='.$token, 'error', 'Error.');
            
        }
        
    } else {
        
        redirect('../activate.php?token='.$token, 'error', 'Token mismatch.');
        
    }
     
}