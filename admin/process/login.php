<?php 
require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
require CLASS_PATH.'user.php';
require CLASS_PATH.'session.php';

$user = new User();
$session = new Session();

if (isset($_POST) && !empty($_POST)) {

	$username = $_POST['username'];

	$password = sha1($username.$_POST['password']);

	$user_info = $user->getUserByUsername($username);
	
	if ($user_info) {

		if ($user_info[0]->password == $password) {

			if ($user_info[0]->roles != 'Reader') {

				if ($user_info[0]->status == 'Active') {
					
				$session->setKeyValue('user_id', $user_info[0]->id);
				
				$session->setKeyValue('full_name', $user_info[0]->first_name. ' '. $user_info[0]->last_name);
				
				$session->setKeyValue('username', $user_info[0]->username);
				
				$session->setKeyValue('email', $user_info[0]->email);
				
				$session->setKeyValue('image', $user_info[0]->image);
				
				$session->setKeyValue('roles', $user_info[0]->roles);
				
				$session->setKeyValue('status', $user_info[0]->status);

				$session->setKeyValue('password', $user_info[0]->password);
				
				$session->setKeyValue('added_by', $user_info[0]->first_name. ' '. $user_info[0]->last_name);
				
				$token = generateRandomString();
				
				$session->setKeyValue('session_token', $token);
				
				$data = array('api_token' => $token, 'last_login' => date('Y-m-d H:i:s'));
				
				$user->updateUser($data, $user_info[0]->id);
					redirect('../dashboard', 'success', 'You are logged in as '.$user_info[0]->first_name.' '.' '. $user_info[0]->last_name.'. Welcome to the admin panel!');

				} else {
					redirect('../', 'error', 'तपाईलाई यो खाता प्रयोग गर्न निलम्बित गरिएको छ, कृपया जानकारीका लागि शिखर प्रकाशनलाई सम्पर्क गर्नुहोस्');
				}

			} else {

				redirect('../', 'error', 'तपाईंलाई व्यवस्थापक प्यानल पहुँच गर्न अनुमति छैन।');
			
			}
		
		} else {
		
			redirect('../', 'error', 'पासवर्ड मिलेन');
		
		}	
	
	} else {
	
		redirect('../', 'error', 'प्रयोगकर्ता भेटिएन।');
	
	}
} else {

	redirect('../', 'error', 'अनधिकृत पहुँच।');

}


