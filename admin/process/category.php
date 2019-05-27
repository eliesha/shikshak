<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'category.php';

require CLASS_PATH.'session.php';

$category = new Category();

$session = new Session();

if (isset($_POST) && !empty($_POST)) {

	$data = array();
	
	$data['title'] = escapeString($_POST['title']);
	
	$data['summary'] = (isset($_POST['summary']) && !empty($_POST['summary'])) ? escapeString($_POST['summary']) : null;
	
	$data['is_parent'] = (isset($_POST['is_parent']) && $_POST['is_parent'] == 1 ) ? 1 : 0;
	
	$data['parent_id'] = (isset($_POST['parent_id']) && !empty($_POST['parent_id'])) ? (int)$_POST['parent_id'] : 0;
	
	$data['show_in_menu'] = (int)$_POST['show_in_menu'];
	
	$data['status'] = escapeString($_POST['status']);
	
	$data['is_pod'] = (isset($_POST['is_pod']) && !empty($_POST['is_pod'])) ? (int)$_POST['is_pod'] : 0;

	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
		
		$image = uploadSingleFile($_FILES['image'], 'category');
	
	if ($image) {
	
		$data['image'] = $image; 
	
		$filename = basename($_POST['del_image']);

		if (isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'category/'.$filename)) {
	
				unlink(UPLOAD_DIR.'category/'.$filename);
	
			}
	
		} 
	
	} else {

			$data['image'] = null;

}

	$category_id = (isset($_POST['cat_id']) && !empty($_POST['cat_id'])) ? (int)$_POST['cat_id'] : null;

		if ($category_id) {

			$filename = basename($_POST['del_image']);

			if (isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'category/'.$filename)) {
	
				unlink(UPLOAD_DIR.'categaory/'.$filename);
	
			}

			$act = "अद्यावधिक";

			$category_id = $category->updateCategory($data, $category_id);

			if ($category_id) {
				
				$filename = basename($_POST['del_image']);

				if (isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'category/'.$filename)) {
		
					unlink(UPLOAD_DIR.'category/'.$filename);
		
				}
				
			}

			if ($category_id) {

			redirect('../category', 'success', 'कोटि सफलतापूर्वक '.$act.' भयो।');

	} else {

		redirect('../category', 'error', 'माफ गर्नुहोस्! कोटि '.$act.' गर्दा समस्या भयो।');

	}

		} else {

			$act = "थप";
			
			$matchedCategory = $category->checkExistingCategory($data['title']);
			
			if($matchedCategory){
			    
			    redirect('../category', 'error', 'कोटि पहिल्यै अवस्थित छ।');
			    
			}

			$category_id = $category->addCategory($data);

			if ($category_id) {

			redirect('../category', 'success', 'कोटि सफलतापूर्वक थपियो');

	} else {

		redirect('../category', 'error', 'माफ गर्नुहोस्! कोटि थप्दा समस्या भयो।');

	}

		}


} elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {

	$id  = (int)$_GET['id'];

	$act = escapeString($_GET['act']);

	if ($act == substr(md5("delete_category-".$id.$session->getSessionByKey('session_token')), 3, 15)) {

		$category_info = $category->getCategoryById($id);
		
		if ($category_info) {

			$image = basename($category_info[0]->image);

			$delete  = $category->deleteCategory($id);

			if ($delete) {
				
					if (!empty($category_info[0]->image) && file_exists(UPLOAD_DIR.'category/'.$image)) {
				
						unlink(UPLOAD_DIR.'category/'.$image);
				
					}
					
					$category->shiftChild($category_info[0]->id);

				redirect('../category', 'success', 'कोटि सफलतापूर्वक मेटाईयो।');
			
			} else {
			
				redirect('../category', 'error', 'माफ गर्नुहोस्! कोटि मेट्दा समस्या भयो।');
			
			}
	
		} else {
	
			redirect('../category', 'error', 'कोटि भेटिएन।');
	
		}
	
	} else {
	
		redirect('../category', 'error', 'टोकन बेमेल।');
	
	}

} else {

	redirect('../', 'error', 'अनधिकृत पहुँच।');

}