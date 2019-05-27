<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

$user = new User;

header('Content-Type: application/json; charset=utf-8');

if (isset($_POST) && !empty($_POST)) {

	$data = array(
		
		'first_name' 	=> escapeString($_POST['first_name']),
		
		'last_name' 	=> escapeString($_POST['last_name']),
		
		'full_name' 	=> escapeString($_POST['first_name'].' '.$_POST['last_name']),
		
		'email'			=> $_POST['email'],
		
		'username' 		=> escapeString($_POST['username']),
		
		'roles'			=> (isset($_POST['roles']) && !empty($_POST['roles'])) ? escapeString($_POST['roles']) : 'Reader',
		
		'phone_number'	=> $_POST['phone_number'],
		
		'country'		=> escapeString($_POST['country']),
		
		'status'		=> 'Inactive',
	);

	if ($_SESSION['roles'] != 'Admin') {
		
		$data['userInfo'] = (isset($_POST['userInfo']) && !empty($_POST['userInfo'])) ? escapeString($_POST['userInfo']) : $_SESSION['userInfo'];

	}

	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
		
		$file = uploadSingleFile($_FILES['image'], 'users');
		
		if ($file) {
		
			if (isset($_POST['delete_old_image']) && !empty($_POST['delete_old_image']) && file_exists(UPLOAD_DIR.'users/'.$_POST['delete_old_image'])) {
						
						unlink(UPLOAD_DIR.'users/'.$_POST['delete_old_image']);
						
				}
			
			$data['image'] = $file;
		
		}
	
	}

    $data['password'] = (isset($_POST['password']) && !empty($_POST['password'])) ? sha1($_POST['username'].$_POST['password']) : "";
    
    $username = $user->existingUsername($_POST['username']);
    
    if($username){
        
        $result["success"] = "userexists";
        
        $result["message"] = "Username already exists!";
        
        echo json_encode($result);
        
        die;
        
    }
    
    $email = $user->existingEmail($_POST['email']);
    
    if($email){
        
        $result["success"] = "emailexits";
        
        $result["message"] = "Email already exists!";
        
        echo json_encode($result);
        
        die;
        
    }
    
    $token = generateRandomString();
		
	$data['token'] = $token;
    
	$user_info = $user->addUser($data);
	
		if ($user_info) {
		    
		    $url = 'oxygenaltitude.com/activate.php?token='.$token;
    		
    		$to = $_POST['email'];
    		
    		$subject = "Shikshak Monthly Account Verification";
        
            $message = "\r\nशिक्षक वेबसाइटमा आफ्नो खाता सक्रिय गर्न तल लिंकमा क्लिक गर्नुहोस्। ";
        
            $message .= "\r\n";
            
            $message .= "\r\n";
            
            $message .= $url;
        
            $header = "From: Shikshak Magazine <info@bsaitechnosales.com>\r\n";
        
            $header .= header('Content-type: text/html; charset=utf-8');
        
            $results = mail($to, $subject, $message, $header);
            
            if($results){
                
            $result = array();
                
            $result["success"] = "1";
            
            $result["message"] = "Check your email.";
            
            echo json_encode($result);
            
            die;  
                
            }

		} else {

				$result["success"] = "0";
				
                $result["message"] = "error";
                
                echo json_encode($result);
                
                die;
		
		}

 

}