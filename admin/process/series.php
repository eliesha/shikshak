<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'series.php';

require CLASS_PATH.'session.php';

$series = new Series();

$session = new Session();

if (isset($_POST) && !empty($_POST)) {

	$data = array();
    
    $data['month'] = escapeString($_POST['month']);

	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    
        $image = uploadSingleFile($_FILES['image'], 'series');
    
        if ($image) {

            $base = basename($_POST['del_image']);
    
            if (isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'series/'.$base)) {
                
                unlink(UPLOAD_DIR.'series/'.$base);
    
            }
    
            $data['image'] = $image;
    
        } 
    
    } 

	$series_id = (isset($_POST['series_id']) && !empty($_POST['series_id'])) ? (int)$_POST['series_id'] : null;

		if ($series_id) {
    
            $act = "edit";
    
            $series_id = $series->updateSeries($data, $series_id);
			
		} else {
    
            $act = "add";
    
            $series_id = $series->addSeries($data);
		}
		
	if ($series_id) {

			redirect('../bookSeries', 'success', 'अंक सफलतापूर्वक थपियो।');

	} else {

		redirect('../bookSeries', 'error', 'अंक थपगर्दा समस्या भयो। ');

	}

} elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {

	$id  = (int)$_GET['id'];
	
	$act = escapeString($_GET['act']);
	
	if ($act == substr(md5("delete_series-".$id.$session->getSessionByKey('session_token')), 3, 15)) {
		
		$series_info = $series->getSeriesById($id);
		
		if ($series_info) {

			$image = basename($series_info[0]->image);
			
			$delete  = $series->deleteSeries($id);
			
			if ($delete) {
				if (isset($series_info[0]->image) && !empty($series_info[0]->image) && file_exists(UPLOAD_DIR.'series/'.$image)) {

					unlink(UPLOAD_DIR.'series/'.$image);
				}

				redirect('../bookSeries', 'success', 'अंक सफलतापूर्वक हटाइयो।');
			
			} else {
				
				redirect('../bookSeries', 'error', 'माफ गर्नुहोस्! अंक मेट्दा समस्या भयो।');
			
			}
		
		} else {

			redirect('../bookSeries', 'error', 'तपाईंले खोज्नु भएको अंक पाइएन।');
		
		}
	
	} else {

		redirect('../bookSeries', 'error', 'टोकन बेमेल।');
	
	
	}

} else {

    redirect('../', 'error', 'अनधिकृत पहुँच।');

}
