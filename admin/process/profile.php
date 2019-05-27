<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'profile.php';

require CLASS_PATH.'session.php';

$profile = new Profile();

$session = new Session();

if (isset($_POST) && !empty($_POST)) {
	
	$data = array();

	$data['title'] = escapeString($_POST['title']);
	
	$data['summary'] = escapeString($_POST['summary']);

	$data['story'] = $_POST['story'];

	$data['status'] = escapeString($_POST['status']);

	$data['added_by'] = (int)($_POST['added_by']);

	$data['added_date'] = escapeString($_POST['added_date']);

	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

		$image = uploadSingleFile($_FILES['image'], 'profile');
	
		if ($image) {
	
			$data['image'] = $image; 
	
			$filename = basename($_POST['del_image']);
	
			if (isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'profile/'.$filename)) {
	
				unlink(UPLOAD_DIR.'profile/'.$filename);
	
			}
	
		}

	} 
	
	$profile_id = (isset($_POST['profile_id']) && !empty($_POST['profile_id'])) ? (int)$_POST['profile_id'] : null;

		if ($profile_id) {

			$act = "अद्यावधिक";

			$profile_id = $profile->updateProfile($data, $profile_id);

			if ($profile_id) {
				 
				$filename = basename($_POST['del_image']);
	
				if (isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'profile/'.$filename)) {
		
					unlink(UPLOAD_DIR.'profile/'.$filename);
		
				}

			}
			
		} else {

			$act = "थप";

			$profile_id = $profile->addProfile($data);

		}
		
	if ($profile_id) {

			redirect('../profile', 'success', 'प्रोफाइल सफलतापूर्वक '.$act.' भयो।');

	} else {

		redirect('../profile', 'error', 'माफ गर्नुहोस्! प्रोफाइल '.$act.' गर्दा समस्या भयो।');

	}

} elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {

	$id  = (int)$_GET['id'];
	
	$act = escapeString($_GET['act']);
	
	if ($act == substr(md5("delete_profile-".$id.$session->getSessionByKey('session_token')), 3, 15)) {
		
		$profile_info = $profile->getProfileById($id);
		
		if ($profile_info) {

			$image = basename($profile_info[0]->image);
			
			$delete  = $profile->deleteProfile($id);
			
			if ($delete) {
				if (isset($profile_info[0]->image) && !empty($profile_info[0]->image) && file_exists(UPLOAD_DIR.'profile/'.$image)) {

					unlink(UPLOAD_DIR.'profile/'.$image);
				}

				redirect('../profile', 'success', 'प्रोफाइल सफलतापूर्वक हटाइयो।');
			
			} else {
				
				redirect('../profile', 'error', 'माफ गर्नुहोस्! प्रोफाइल मेट्दा समस्या भयो।');
			
			}
		
		} else {

			redirect('../profile', 'error', 'तपाईंले खोज्नु भएको प्रोफाइल पाइएन।');
		
		}
	
	} else {

		redirect('../profile', 'error', 'टोकन बेमेल।');
	
	
	}

} else {

	redirect('../', 'error', 'अनधिकृत पहुँच।');

}