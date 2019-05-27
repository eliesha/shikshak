<?php 
require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'session.php';

$user = new User();

$session = new Session();

if (isset($_POST) && !empty($_POST)) {

    $subs = $_POST['subs'];
    
    $book = $_POST['book'];

	$username = $_POST['username'];

	$password = sha1($username.$_POST['password']);

	$user_info = $user->getUserByUsername($username);

	if ($user_info) {

		if ($user_info[0]->password == $password) {

			if ($user_info[0]->roles == 'Reader') {

				if($user_info[0]->status == 'Active'){
				    
				    $session->setKeyValue('fuser_id', $user_info[0]->id);
				
    				$session->setKeyValue('ffirst_name', $user_info[0]->first_name);
    				
    				$session->setKeyValue('flast_name', $user_info[0]->last_name);
    				
    				$session->setKeyValue('fusername', $user_info[0]->username);
    				
    				$session->setKeyValue('femail', $user_info[0]->email);
    				
    				$session->setKeyValue('fimage', $user_info[0]->image);
    
    				$session->setKeyValue('froles', $user_info[0]->roles);
    
    				$session->setKeyValue('fstatus', $user_info[0]->status);
    				
    				$session->setKeyValue('fpassword', $user_info[0]->password);
    
    				$session->setKeyValue('fphonenumber', $user_info[0]->phone_number);
    				
    				$token = generateRandomString();
    				
    				$session->setKeyValue('front_token', $token);
    				
    				$data = array('api_token' => $token, 'last_login' => date('Y-m-d H:i:s'));
    				
    				$user->updateUser($data, $user_info[0]->id);
    				
    				if($subs == 1){
    				    
    				    redirect('/subscribe');
    				    
    				} elseif(!empty($book)){
    				    
    				    redirect('/'.$book);
    				    
    				} else {
    					
    					redirect('/../');
    				    
    				}
    				    
    				} else {
        				redirect('../signin.php', 'error', 'तपाइँलाई फ्रन्टइन्ड पहुँच गर्न अनुमति छैन।');
        			}
				
			} else {
				redirect('../signin.php', 'error', 'तपाइँलाई फ्रन्टइन्ड पहुँच गर्न अनुमति छैन।');
			}
		} else {
			redirect('../signin.php', 'error', 'पासवर्ड मिलेन।');
		}	
	} else {
		redirect('../signin.php', 'error', 'प्रयोगकर्ताको नाम मिलेन।');
	}
} else if (!isset($_POST) && empty($_POST)) {
    
	redirect('../signin.php', 'error', 'अनधिकृत पहुँच।');

}


