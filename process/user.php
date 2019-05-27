<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

$user = new User;

if (isset($_POST) && !empty($_POST)) {

	$data = array(
		
		'first_name' 	=> escapeString($_POST['first_name']),
		
		'last_name' 	=> escapeString($_POST['last_name']),
		
		'full_name' 	=> escapeString($_POST['first_name'].' '.$_POST['last_name']),
		
		'email'			=> (isset($_POST['email']) && !empty($_POST['email'])) ? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : $_SESSION['email'],
		
		'username' 		=> escapeString($_POST['username']),
		
		'roles'			=> (isset($_POST['roles']) && !empty($_POST['roles'])) ? escapeString($_POST['roles']) : 'Reader',
		
		'country'		=> escapeString($_POST['country']),
		
		'status'		=> 'Inactive'
	);

	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
		
		$file = uploadSingleFile($_FILES['image'], 'users');
		
		if ($file) {
		
			if (isset($_POST['delete_old_image']) && !empty($_POST['delete_old_image']) && file_exists(UPLOAD_DIR.'product/'.$_POST['delete_old_image'])) {
						
						unlink(UPLOAD_DIR.'users/'.$_POST['delete_old_image']);
						
				}
			
			$data['image'] = $file;
		
		}
	
	}

	$user_info = (isset($_POST['user_id']) && !empty($_POST['user_id'])) ? (int)$_POST['user_id'] : null;
	
	if ($user_info) {

		$id = (int)$_POST['user_id'];

		$userPass = $user->getUserById($id);

		$password = $userPass[0]->password;

		if ($_SESSION['roles'] != 'Admin') {
		
			$data['userInfo'] = (isset($_POST['userInfo']) && !empty($_POST['userInfo'])) ? escapeString($_POST['userInfo']) : $_SESSION['userInfo'];
	
		} 
		
		$act = 'अद्यावधिक';

		if (isset($_POST) && empty($_POST['password'])) {
			
				$data['password']	= $_SESSION['password'];

		} else {

			$data['password']	= sha1($_POST['username'].$_POST['password']);

		}

		$data['phone_number'] = (isset($_POST['phonenumber']) && !empty($_POST['phonenumber'])) ? $_POST['phonenumber'] : $_SESSION['phonenumber'];
		
		$user_info = $user->updateUser($data, $id);

	} else {
		
		$data['phone_number'] = $_POST['phonenumber'];

		$data['userInfo'] = "";

		$data['password'] = (isset($_POST['password']) && !empty($_POST['password'])) ? sha1($_POST['username'].$_POST['password']) : "";
		
		

		$act = 'थप';
		
		$token = generateRandomString();
		
		$data['token'] = $token;
		
		$email = $user->existingEmail($_POST['email']);
		
		if($email){
		    
		    redirect('../signup.php', 'error', 'यो इमेल पहिल्यै दर्ता गरिएको छ।');

		}
        
		    
	    $username = $user->existingUsername($_POST['username']);
	    
	    if($username){
	        
	         redirect('../signup.php', 'error', 'यो प्रयोगकर्तानाम पहिले नै लिइएको छ।');
	        
	    }
		    

		$user_info = $user->addUser($data);

	}

	if($user_info){

		if ($act != 'थप') {

			if ($user_info) {
         			
				redirect('../edit-profile.php', 'success', 'प्रयोगकर्ता सफलतापूर्वक '.$act.' गरियो।');
			
			} else {                
			
				redirect('../edit-profile.php', 'error', 'माफ गर्नुहोस्! त्यहाँ प्रयोगकर्ता '.$act.' गर्दा समस्या भयो।');
			
			}

		} else {
		
    		$url = 'oxygenaltitude.com/activate.php?token='.$token;
    		
    		$to = $_POST['email'];
    		
    		$subject = "Shikshak Monthly Account Verification";
        
            $message = "\r\nशिक्षक वेबसाइटमा आफ्नो खाता सक्रिय गर्न तल लिंकमा क्लिक गर्नुहोस्। ";
        
            $message .= "\r\n";
            
            $message .= "\r\n";
            
            $message .= $url;
        
            $header = "From: Shikshak Magazine <info@bsaitechnosales.com>\r\n";
        
            $header .= header('Content-type: text/html; charset=utf-8');
        
            $result = mail($to, $subject, $message, $header);
		    

			redirect('../signup.php', 'success', 'आफ्नो इमेल खोल्नुहोस् र दीक्षित लिंक क्लिक गर्नुहोस्।');

		}

	} else {

		redirect('../signup.php', 'error', 'माफ गर्नुहोस्! त्यहाँ प्रयोगकर्ता '.$act.' गर्दा समस्या भयो।');

	}

} elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {

	$id = (int)$_GET['id'];
	
	$action = escapeString($_GET['act']);
	
	$user_data = $user->getUserById($id);
	
	$image = basename($user_data[0]->image);
	
	if ($user_data) {
			$delete = $user->deleteUserById($id);
			if ($delete) {
					if ($user_data[0]->image != NULL && file_exists(UPLOAD_DIR.'users/'.$image)) {
					
						unlink(UPLOAD_DIR.'users/'.$image);
					}
					redirect('../users', 'success', 'प्रयोगकर्ता सफलतापूर्वक हटाइयो।');
			} else{
				redirect('../users', 'error', 'माफ गर्नुहोस्! त्यहाँ प्रयोगकर्ता मेट्दा एक समस्या भयो।');
			}
	} else {
		redirect('../users', 'error', 'प्रयोगकर्ता भेटिएन।');
	}
} else {
	redirect('../admin/users', 'error', 'कृपया पहिले विवरणहरू भर्नुहोस्।');
}




