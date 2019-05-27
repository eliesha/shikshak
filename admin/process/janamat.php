<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'session.php';

require CLASS_PATH.'janamat.php';

$session = new Session;

$janamat = new Janamat;

if (isset($_POST) && !empty($_POST)) {

	$data = array(

		'added_date'	=> escapeString($_POST['date']),

		'title'	=> escapeString($_POST['title']),

		'status'	=> escapeString($_POST['status']),
	);

	$janamat_id = (isset($_POST['janamat_id']) && !empty($_POST['janamat_id'])) ? (int)$_POST['janamat_id'] : null;

	if ($janamat_id) {

			$act = "अद्यावधिक";
			
			$janamat_id = $janamat->updateJanamat($data, $janamat_id);
			
		} else {
		
			$act = "थप";
		
			$janamat_id = $janamat->addJanamat($data);
		
		}

	if ($janamat_id) {

			redirect('../janamat', 'success', 'प्रश्न सफलतापूर्वक '.$act.' भयो।');

		} else {

		redirect('../janamat', 'error', 'माफ गर्नुहोस्! प्रश्न '.$act.' गर्दा समस्या भयो।');

		}

} elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {

	$id  = (int)$_GET['id'];
	
	$act = escapeString($_GET['act']);
	
	if ($act == substr(md5("delete_janamat-".$id.$session->getSessionByKey('session_token')), 3, 15)) {
		
		$janamat_info = $janamat->getJanamatById($id);
		
		if ($janamat_info) {
			
			$delete  = $janamat->deleteJanamat($id);
			
			if ($delete) {

				redirect('../janamat', 'success', 'प्रश्न सफलतापूर्वक मेटाईयो।');
			
			} else {
				
				redirect('../janamat', 'error', 'माफ गर्नुहोस्! प्रश्न मेट्दा समस्या भयो।');
			
			}
		
		} else {

			redirect('../janamat', 'error', 'प्रश्न भेटिएन।');
		
		}
	
	} else {

		redirect('../janamat', 'error', 'टोकन बेमेल।');
	
	}

} else {
	
	redirect('../', 'error', 'अनधिकृत पहुँच।');

}