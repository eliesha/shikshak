<?php 

require CLASS_PATH.'session.php';
require CLASS_PATH.'user.php';
$session = new Session();
$user = new User();

if (isset($_SESSION['session_token']) && !empty($_SESSION['session_token'])) {

	if($_SESSION['roles'] !== 'Reader'){
		$user_info = $user->getUserByToken($session->getSessionByKey('session_token'));
		if (!$user_info) {
			redirect('logout');
		} else {
			if ($session->getSessionByKey('user_id') != $user_info[0]->id) {
				redirect('logout');
			}
		}
	} else {
		redirect('./', 'warning', 'तपाईंलाई व्यवस्थापक प्यानल पहुँच गर्न अनुमति छैन।');
	}
} else {
	redirect('./', 'warning', 'कृपया पहिले लग इन गर्नुहोस्।');
}


