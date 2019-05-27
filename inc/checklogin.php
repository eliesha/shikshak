<?php 

require CLASS_PATH.'session.php';

$session = new Session();


if (isset($_SESSION['front_token']) && !empty($_SESSION['front_token'])) {

	if($_SESSION['froles'] == 'Reader'){

		redirect('./');

	} else {
		redirect('./', 'error', 'तपाइँलाई अगाडि-अन्त पहुँच गर्न अनुमति छैन।');
	}

} 
