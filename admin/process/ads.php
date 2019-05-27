<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'ads.php';

require CLASS_PATH.'session.php';

$ads = new Ads();

$session = new Session();

if (isset($_POST) && !empty($_POST)) {

	$data = array();
    
    $data['title'] = escapeString($_POST['title']);
    
    $data['url'] = escapeString($_POST['url']);
    
    $data['status'] = escapeString($_POST['status']);

	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    
        $image = uploadSingleFile($_FILES['image'], 'ads');
    
        if ($image) {

            $base = basename($_POST['del_image']);
    
            if (isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'ads/'.$base)) {
                
                unlink(UPLOAD_DIR.'ads/'.$base);
    
            }
    
            $data['image'] = $image;
    
        } 
    
    } 
	
	$ad_id = (isset($_POST['ad_id']) && !empty($_POST['ad_id'])) ? (int)$_POST['ad_id'] : null;

		if ($ad_id) {
    
            $act = "edit";
    
            $ad_id = $ads->updateAds($data, $ad_id);
			
		} else {
    
            $act = "add";
    
            $ad_id = $ads->addAds($data);
		}
		
	if ($ad_id) {

			redirect('../ads', 'success', 'Ad '.$act.'ed successfully.');

	} else {

		redirect('../ads', 'error', 'Sorry! There was problem while '.$act.'ing ad.');

	}

} elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {

	$id  = (int)$_GET['id'];
	
	$act = escapeString($_GET['act']);
	
	if ($act == substr(md5("delete_ad-".$id.$session->getSessionByKey('session_token')), 3, 15)) {
		
		$ad_info = $ads->getAdById($id);
		
		if ($ad_info) {

			$image = basename($ad_info[0]->image);
			
			$delete  = $ads->deleteAd($id);
			
			if ($delete) {
				if (isset($ad_info[0]->image) && !empty($ad_info[0]->image) && file_exists(UPLOAD_DIR.'ads/'.$image)) {

					unlink(UPLOAD_DIR.'ads/'.$image);
				}

				redirect('../ads', 'success', 'विज्ञापन सफलतापूर्वक हटाइयो।');
			
			} else {
				
				redirect('../ads', 'error', 'माफ गर्नुहोस्! विज्ञापन मेट्दा समस्या भयो।');
			
			}
		
		} else {

			redirect('../ads', 'error', 'तपाईंले खोज्नु भएको विज्ञापन पाइएन।');
		
		}
	
	} else {

		redirect('../ads', 'error', 'टोकन बेमेल।');
	
	
	}

} else {

    redirect('../', 'error', 'अनधिकृत पहुँच।');

}
