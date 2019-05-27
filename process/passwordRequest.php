<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'resetPassword.php';

require CLASS_PATH.'user.php';

$reset = new Reset;

$user = new User;

if(isset($_POST)){

    $selector = $_POST['selector'];

    $validator = $_POST['validator'];

    $newPassword = $_POST['new-password'];

    $confirmPass = $_POST['confirm-password'];

    if(!empty($newPassword) || !empty($confirmPass)){

        if($confirmPass !== $newPassword){

            redirect('../create-new-password.php?selector='.$selector.'&token='.$validator, 'error', 'दुवै क्षेत्रमा एउटै पासवर्ड हुनुपर्छ। दुबै क्षेत्रमा समान पासवर्ड प्रविष्ट गर्नुहोस्।');

        } else {

            $currentDate = date('U');

            $isValidate = $reset->isValidToken($selector, $currentDate);

            if($isValidate){

                $tokenBin = hex2bin($validator);
                
                $newToken = $isValidate[0]->token;
                
                $email = $isValidate[0]->email;
                
                $tokenCheck = $reset->checkToken($tokenBin);
                
                if($tokenCheck === true){

                    $checkUser = $user->getUserByEmail($email);

                    if($checkUser){

                        $passwordNew = sha1($checkUser[0]->username.$newPassword);
                       
                       $data = " password = '".$passwordNew."'";
                        
                        $passwordUpdate = $user->updatePassword($data, $checkUser[0]->id);
                        
                        if ($passwordUpdate){
                            
                            $deteleToken = $reset->deleteToken;
                            
                             redirect('../signin.php', 'success', 'तपाईंको नयाँ पासवर्डको साथ साइन इन गर्नुहोस्।');
                        } else {
                            
                            redirect('../signin.php', 'error', 'तपाइँको पासवर्ड रिसेट गर्न सकिएन।');
                            
                        }


                    }

                } else {

                    redirect('../', 'success', 'तपाईंले पुनः रिसेट अनुरोध पठाउन आवश्यक छ।');

                }

            } else {

                redirect('../', 'success', 'तपाईंले पुनः रिसेट अनुरोध पठाउन आवश्यक छ।');

            }

        }

    } else {

        redirect('./create-new-password', 'success', 'कृपया पासवर्ड प्रविष्ट गर्नुहोस्।');

    }

} else {

    @header('/index.php');
    
    exit;

}