<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'resetPassword.php';

require CLASS_PATH.'user.php';

$reset = new Reset();

$user = new User();

header('Content-Type: application/json; charset=utf-8');

if(isset($_POST['email'])){
    
    $userExists = $user->getUserByEmail($_POST['email']);
    
    if($userExists) {
        
        $userEmail = $userExists[0]->email;
        
        
        $name = $userExists[0]->first_name." ".$userExists[0]->last_name;
        
        $selector = bin2hex(random_bytes(8));

        $token = random_bytes(32);
    
        $url = "oxygenaltitude.com/create-new-password.php?selector=" .$selector. "&token=" .bin2hex($token);
    
        $expires = date('U') + 1800;
    
        $email = $_POST['email'];
        
        $data = array(
            
            'email' => $email,
            
            'token' => $token,
            
            'selector' => $selector,
            
            'expires' => $expires
            
            );
    
        $delete = $reset->deleteEmail($email);
    
        $insert = $reset->insertData($data);
    
        $to = $email;
    
        $subject = "Reset your password for Shikshak Monthly website.";
    
        $message = "\r\nहामीले पासवर्ड रिसेट अनुरोध प्राप्त गर्यौँ। तपाइँको पासवर्ड रिसेट गर्न लिङ्क तल छ। यदि तपाईंले यो अनुरोध गर्नु भएको हैन भने, तपाई यो इ-मेललाई बेवास्ता गर्न सक्नुहुनेछ।";
    
        $message .= "तल तपाईको पासवर्ड रिसेट लिङ्क छ :\r\n";
        
        $message .= "\r\n";
        
        $message .= $url;
    
        $header = "From: Shikshak Magazine <info@bsaitechnosales.com>\r\n";
    
        $header .= header('Content-type: text/html; charset=utf-8');
    
        mail($to, $subject, $message, $header);
        
        $result['success'] = 1;
        
        $result['message'] = "आफ्नो इमेल जाँच गर्नुहोस्।";
        
        echo json_encode($result);
        
    } else {
        
        $result['success'] = 1;
        
        $result['message'] = "माफ गर्नुहोस्, हामीले तपाईंको ईमेल फेला पार्न सकेनौं!";
        
        echo json_encode($result);
        
    }

} else {
   
    @header('/index.php');
   
    exit;
}