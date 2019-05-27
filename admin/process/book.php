<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'book.php';

require CLASS_PATH.'session.php';

$book = new book();

$session = new Session();

if (isset($_POST) && !empty($_POST)) {
	
	$data = array();
	
	$data['title'] = escapeString($_POST['title']);
	
	$data['story'] = htmlentities($_POST['story']);
	
	$data['writer'] = escapeString($_POST['writer']);
	
	$data['publication'] = escapeString($_POST['publication']);
	
	$data['price'] = ($_POST['price']);
	
	$data['link'] = ($_POST['link']);
	
	$data['status'] = escapeString($_POST['status']);
	
	$data['added_by'] = (int)($_POST['added_by']);

	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
	
		$image = uploadSingleFile($_FILES['image'], 'book');
	
		if ($image) {
	
			$data['image'] = $image; 
	
			$filename = basename($_POST['del_image']);
	
			if (isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'book/'.$filename)) {
	
				unlink(UPLOAD_DIR.'book/'.$filename);
	
			}
	
		} 
	
	} 
	
	$book_id = (isset($_POST['book_id']) && !empty($_POST['book_id'])) ? (int)$_POST['book_id'] : null;

		if ($book_id) {
	
			$act = "अद्यावधिक";
	
			$book_id = $book->updateBook($data, $book_id);

				if ($book_id) {
					
					$filename = basename($_POST['del_image']);
		
				if (isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'book/'.$filename)) {
		
					unlink(UPLOAD_DIR.'book/'.$filename);
		
				}
			}
			
		} else {
	
			$act = "थप";
	
			$book_id = $book->addBook($data);
	
		}
		
	if ($book_id) {

			redirect('../book', 'success', 'समाचार सफलतापूर्वक '.$act.' भयो।');

	} else {

		redirect('../book', 'error', 'माफ गर्नुहोस्! समाचार '.$act.' गर्दा समस्या भयो।');

	}

} elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {

	$id  = (int)$_GET['id'];
	
	$act = escapeString($_GET['act']);
	
	if ($act == substr(md5("delete_book-".$id.$session->getSessionByKey('session_token')), 3, 15)) {
		
		$book_info = $book->getBookById($id);
		
		if ($book_info) {

			$image = basename($book_info[0]->image);
			
			$delete  = $book->deleteBook($id);
			
			if ($delete) {

				if (isset($book_info[0]->image) && !empty($book_info[0]->image) && file_exists(UPLOAD_DIR.'book/'.$image)) {

					unlink(UPLOAD_DIR.'book/'.$image);
				}

				redirect('../book', 'success', 'समाचार सफलतापूर्वक हटाइयो।');
			
			} else {
				
				redirect('../book', 'error', 'माफ गर्नुहोस्! समाचार मेट्दा समस्या भयो।');
			
			}
		
		} else {

			redirect('../book', 'error', 'तपाईंले खोज्नु भएको समाचार पाइएन।');
		
		}
	
	} else {

		redirect('../book', 'error', 'टोकन बेमेल।');
	
	}

} else {

	redirect('../', 'error', 'अनधिकृत पहुँच।');

}