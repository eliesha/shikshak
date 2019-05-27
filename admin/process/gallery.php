<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'gallery.php';

require CLASS_PATH.'session.php';

require CLASS_PATH.'galleryImages.php';

$gallery = new Gallery;

$session = new Session;

$galleries = new GalleryImages;

$act = "थप";

if (isset($_POST) && !empty($_POST)) {

	$data = array();

	$data['title'] = escapeString($_POST['title']);

	$data['description'] = escapeString($_POST['description']);

	$data['status'] = (int)($_POST['status']);

	$data['added_by'] = $_SESSION['user_id'];

	if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
		
		$path = getAlphaNumericValue($_POST['title']);
		
		$thumbnail = uploadSingleFile($_FILES['thumbnail'], 'gallery/'.$path);
		
		if ($thumbnail) {
		
			$data['thumbnail'] = $thumbnail;
		
		}
	
	}
	
	$id = $gallery->addGallery($data);

	if($id){

		$count = count($_FILES['images']['name']);

		if($count > 0){
			
			for($i=0; $i<$count; $i++){

				$temp =array(
				
					'name' => $_FILES['images']['name'][$i],
				
					'type'	=> $_FILES['images']['type'][$i],
				
					'tmp_name'	=> $_FILES['images']['tmp_name'][$i],
				
					'size'	=> $_FILES['images']['size'][$i],
				
					'error'	=> $_FILES['images']['error'][$i]
				
				);
				
				$image_uploaded = uploadSingleFile($temp, 'gallery/'.$path);
				
				if($image_uploaded){
					
					$array = array(
					
							'gallery_id' => $id,
					
							'image_name' => $image_uploaded 
					
					);
					
					$galleries->addGalleryImages($array, 'gallery_images');
				
				}
			
			}
		
		}
		
		redirect('../listGallery', 'success', 'गैलरी सफलतापूर्वक '.$act.' भयो।');
	
	} else {
	
		redirect('../listGallery', 'error', 'माफ गर्नुहोस्! गैलरी '.$act.' गर्दा समस्या भयो।');
	
	}

} elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {

	$id = (int)$_GET['id'];

	$act = escapeString($_GET['act']);

	if ($act == substr(md5("delete_imageFolder-".$id.$session->getSessionByKey('session_token')), 3, 15)) {
		
		$info = $gallery->getSingleGalleryById($id);
		
		$info_title = explode(' ', strtolower($info[0]->title));
		
		$info_title = implode('_', $info_title);

		if (!$info) {
			
			redirect('../listGallery', 'error', 'तपाईंले खोज्नु भएको ग्यालरी भेटिएन।');
	
		}
		
		$path = UPLOAD_DIR.'/gallery/'.$info_title;
		
		$del = $gallery->deleteImageFolder($id);
		
		if ($del) {
			
			deleteDir($path);
			
			redirect('../listGallery', 'success', 'ग्यालरी सफलतापूर्वक हटाइयो।');
			
		} else {
			
			redirect('../listGallery', 'error', 'माफ गर्नुहोस्! त्यहाँ ग्यालरी हटाउन समस्या भयो।');
	
		}
	
	} else {
		
		redirect('../listGallery', 'error', 'टोकन बेमेल।');
		
	}

} elseif (isset($_GET, $_GET['img_id'], $_GET['action']) && !empty($_GET['img_id']) && !empty($_GET['action'])) {
	
	$id = (int)$_GET['img_id'];
	
	$action = escapeString($_GET['action']);

	if ($action == substr(md5("delete_image-".$id.$session->getSessionByKey('session_token')), 3, 15)) {
	
		$file = $galleries->getGalleryById($id);

		if (!$file) {
		
		redirect('../listGallery', 'error', 'तस्बिर फेला परेन।');
		
		} 
		
		$image = basename($file[0]->image_name);

		$delete = $galleries->deleteData($id);
		
		if ($delete) {

		if (isset($file[0]->image_name) && !empty($file[0]->image_name) && file_exists(UPLOAD_DIR.'galleries/'.$image)) {

					unlink(UPLOAD_DIR.'galleries/'.$image);
				}

				redirect('../listGallery', 'success', 'तस्बिर सफलतापूर्वक मेटाईयो।');	

		} else {
			
			redirect('../listGallery', 'error', 'माफ गर्नुहोस्! तस्बिर मेट्दा समस्या थियो।');
		
		}
	
	} else {
	
		redirect('../listGallery', 'error', 'टोकन बेमेल।');
	
	}


} else {

	redirect('../listGallery', 'error', 'अनधिकृत पहुँच।');	

}

?>