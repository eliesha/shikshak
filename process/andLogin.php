<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'session.php';

$user = new User();

$session = new Session();

header('Content-Type: application/json; charset=utf-8');

if (isset($_POST) && !empty($_POST)) {

	$username = $_POST['username'];

	$password = sha1($username.$_POST['password']);

	$user_info = $user->getUserByUsername($username);
	
	if ($user_info) {

		if ($user_info[0]->password == $password) {

			if ($user_info[0]->roles == 'Reader') {
	            
	            if($user_info[0]->status == 'Active'){
	                
	                $result = array();  
	            
    	            $index = array();
    			    
    			    $index['id'] = $user_info[0]->id;
    			    
    			    $index['first_name'] = $user_info[0]->first_name;
    			    
    			    $index['last_name'] = $user_info[0]->last_name;
                    
                    $index['full_name'] = $user_info[0]->full_name;
                    
                    $index['username'] = $user_info[0]->username;
                    
                    $index['email'] = $user_info[0]->email;
                    
                    $index['phone_number'] = $user_info[0]->phone_number;
                    
                    $index['country'] = $user_info[0]->country;
                
                $result['login'] = array();
    
                array_push($result['login'], $index);
    				
    				$data = array('api_token' => $token, 'last_login' => date('Y-m-d H:i:s'));
    			   
    				$result['success'] = "1";
        		    
        		    $result['message'] = "Successfully logged in.";
        		    
        		    echo json_encode($result);
        		    
        		    echo json_encode($index);
        		    
        		    die;	
					
	                
	            } else {
	                
	                $result['success'] = "activate";
    		    
        		    $result['message'] = "Please click on the activation link.";
        		    
        		    echo json_encode($result);
        		    
        		    die;
	                
	            }
					
			} else {
			    
			    $result['success'] = "access error";
    		    
    		    $result['message'] = "Login through admin panel.";
    		    
    		    echo json_encode($result);
    		    
    		    die;
			}
		} else {
		
		    $result['success'] = "0";
		  
		    $result['message'] = "Password does not match.";
		  
		    echo json_encode($result);
		  
		    die;
			
		}	
	} else {
	
	        $result['success'] = "0";
		    $result['message'] = "User not found.";
		    echo json_encode($result);
		    die;
		
	}
} else {

            $result['success'] = "0";
		    $result['message'] = "Unauthorized access.";
		    echo json_encode($result);
		    die;
}

?>
