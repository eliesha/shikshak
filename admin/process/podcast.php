<?php 


require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'podcast.php';

require CLASS_PATH.'session.php';

$podcast = new Podcast();

$session = new Session();

if (isset($_POST) && !empty($_POST)) {

	$data = array();
	
	$data['title'] 			= escapeString($_POST['title']);
	
	$data['description'] 	= escapeString($_POST['description']);
	
	$data['category']	    = escapeString($_POST['category']);
	
	$data['added_by'] 		= (int)($_POST['added_by']);
	
	$data['duration']		= $_POST['duration'];
	
	$data['added_date']		= escapeString($_POST['added_date']);
	
	$data['url']			= isset($_POST['link']) && !empty($_POST['link']) ? getVideoIdFromUrl($_POST['link']) : null;

	if (isset($_FILES['audio']) && $_FILES['audio']['error'] == 0) {

		$audio = uploadSingleFile($_FILES['audio'], 'podAudio', 'file');

		if ($audio) {
		
			$data['audio'] = $audio; 
			
			$baseAudio = basename($_POST['del_audio']);
			
			if (isset($_POST['del_audio']) && !empty($_POST['del_audio']) && file_exists(UPLOAD_DIR.'podAudio/'.$baseAudio)) {
				unlink(UPLOAD_DIR.'podAudio/'.$baseAudio);
			}
		} else {
		    
		    redirect('../podcast', 'error', 'file could not be uploaded!');
		    
		}
	}

	$podcast_id = (isset($_POST['pod_id']) && !empty($_POST['pod_id'])) ? (int)$_POST['pod_id'] : null;
			
			if ($podcast_id) {
			
				$act = "अद्यावधिक";
			
				$podcast_id = $podcast->updatePodcast($data, $podcast_id);
			
			} else {
			
				$act = "थप";
			
				$podcast_id = $podcast->addPodcast($data);
			
			}

	if ($podcast_id) {
	
		redirect('../podcast', 'success', 'पोडकास्ट सफलतापूर्वक '.$act.' भयो।');
	
	} else {
	
		redirect('../podcast', 'error', 'माफ गर्नुहोस्! पोडकास्ट '.$act.' गर्दा समस्या भयो।');
	
	}

} elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {
	
	$id  = (int)$_GET['id'];
	
	$act = escapeString($_GET['act']);
	
	if ($act == substr(md5("delete_podcast-".$id.$session->getSessionByKey('session_token')), 3, 15)) {
	
		$podcast_info = $podcast->getPodcastById($id);
	
		$image = basename($podcast_info[0]->image);
	
		$audio = basename($podcast_info[0]->audio);
		
		if ($podcast_info) {
	
			$delete  = $podcast->deletePodcast($id);
	
			if ($delete) {
					if (!empty($podcast_info[0]->image) && file_exists(UPLOAD_DIR.'podImage/'.$image)) {
	
						unlink(UPLOAD_DIR.'podImage/'.$image);
	
					}
					if (!empty($podcast_info[0]->audio) && file_exists(UPLOAD_DIR.'podAudio/'.$audio)) {
	
						unlink(UPLOAD_DIR.'podAudio/'.$audio);
	
					}

				redirect('../podcast', 'success', 'पोडकास्ट सफलतापूर्वक हटाइयो।');
	
			} else {
	
				redirect('../podcast', 'error', 'माफ गर्नुहोस्! पोडकास्ट मेट्दा समस्या भयो।');
	
			}
	
		} else {
	
			redirect('../podcast', 'error', 'तपाईंले खोज्नु भएको पोडकास्ट पाइएन।');
		}
	
	} else {
	
		redirect('../podcast', 'error', 'टोकन बेमेल।');
	
	}

} else{

	redirect('../', 'error', 'अनधिकृत पहुँच।');

}