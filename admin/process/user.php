<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
require '../inc/checklogin.php';

require CLASS_PATH.'categoryAccess.php';

$category_permitted = new CategoryAccess;

if (isset($_POST) && !empty($_POST)) {

	$data = array(
		
		'first_name' 	=> escapeString($_POST['first_name']),
		
		'last_name' 	=> escapeString($_POST['last_name']),
		
		'full_name' 	=> escapeString($_POST['first_name'].' '.$_POST['last_name']),
		
		'email'			=> filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
		
		'username' 		=> escapeString($_POST['username']),
		
		'roles'			=> (isset($_POST['roles']) && !empty($_POST['roles'])) ? escapeString($_POST['roles']) : $_SESSION['roles'],
		
		'phone_number'	=> $_POST['phone_number'],
		
		'country'		=> escapeString($_POST['country']),
		
		'status'		=> (isset($_POST['status']) && !empty($_POST['status'])) ? escapeString($_POST['status']) : $_SESSION['status']
	);

	if ($_SESSION['roles'] != 'Admin') {
		
		$data['userInfo'] = (isset($_POST['userInfo']) && !empty($_POST['userInfo'])) ? escapeString($_POST['userInfo']) : $_SESSION['userInfo'];

	}

	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
		
		$file = uploadSingleFile($_FILES['image'], 'users');
		
		if ($file) {
		    
		    $base = basename($_POST['delete_old_image']);
		
			if (isset($_POST['delete_old_image']) && !empty($_POST['delete_old_image']) && file_exists(UPLOAD_DIR.'users/'.$base)) {
						
						unlink(UPLOAD_DIR.'users/'.$base);
						
				}
			
			$data['image'] = $file;
		
		}
	
	}

	$user_info = (isset($_POST['user_id']) && !empty($_POST['user_id'])) ? (int)$_POST['user_id'] : null;

	$id = (int)$_POST['user_id'];

	$userPass = $user->getUserById($id);

	$password = $userPass[0]->password;
	
	if ($user_info) {
		
		$act = 'अद्यावधिक';

		if (isset($_POST) && empty($_POST['password'])) {
			
			if ($_SESSION['roles'] == 'Admin') {
		
				$data['password']	= $password;

			} else {

				$data['password']	= $_SESSION['password'];

			}

		} else {

			$data['password']	= sha1($_POST['username'].$_POST['password']);

		}

		$user_info = $user->updateUser($data, $id);

	} else {

		$data['password'] = (isset($_POST['password']) && !empty($_POST['password'])) ? sha1($_POST['username'].$_POST['password']) : "";

		$act = 'थप';

		$user_info = $user->addUser($data);

	}
	
	if ($_SESSION['roles'] != 'Admin') {
		
		if ($user_info) {
			
			redirect('../myProfile', 'success', 'प्रयोगकर्ता सफलतापूर्वक '.$act.' गरियो।');
		
		} else {
		
			redirect('../myProfile', 'error', 'माफ गर्नुहोस्! त्यहाँ प्रयोगकर्ता '.$act.' गर्दा समस्या भयो।');
		
		}

	} else {
		
		if ($user_info) {

			$cat_access = (isset($_POST['cat_access']) && !empty($_POST['cat_access'])) ? ($_POST['cat_access']) : $_SESSION['cat_access'];

			$value = array();
			
				if (!empty( $cat_access ) && is_array( $cat_access ) ) {
				
				  foreach( $cat_access as $key => $item ) {
				
				    $value[] = filter_var( $item, FILTER_SANITIZE_NUMBER_INT );
				
				  }
				
				}

				$categoryData = $value;

				$temp = array();
				
					if ($categoryData) {

						$count = count($categoryData);

						if ($count > 0) {

							$deleteold = $category_permitted->deleteCategoryAccess($id);
							
							for($i=0; $i<$count; $i++){

							$temp =array(
								
								'cat_access' => $categoryData[$i]

							);
                            
							if ($act == "थप") {
								
								if ($user_info) {
									$array = array(
											'user_id' => $user_info,
											'category_id' => $temp['cat_access']
									);
									
								$category_permitted->addCategoryAccess($array);
								}

							} else {
								
								if ($user_info) {
									
									$array = array(
											'user_id' => $id,
											'category_id' => $temp['cat_access']
									);
									
								$category_permitted->addCategoryAccess($array);
								}
							}
							
						}

						}

				}

			redirect('../users', 'success', 'प्रयोगकर्ता सफलतापूर्वक '.$act.' गरियो।');
		
		} else {
		
			redirect('../users', 'error', 'माफ गर्नुहोस्! त्यहाँ प्रयोगकर्ता '.$act.' गर्दा समस्या भयो।');
		
		}
	
	}

} elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {

	$id = (int)$_GET['id'];
	
	$action = escapeString($_GET['act']);
	
	$user_data = $user->getUserById($id);
	
	$image = basename($user_data[0]->image);
	
	if ($user_data) {
			$delete = $user->deleteUserById($id);
			if ($delete) {
					if ($user_data[0]->image != NULL && file_exists(UPLOAD_DIR.'users/'.$image)) {
					
						unlink(UPLOAD_DIR.'users/'.$image);
					}
					redirect('../users', 'success', 'प्रयोगकर्ता सफलतापूर्वक हटाइयो।');
			} else{
				redirect('../users', 'error', 'माफ गर्नुहोस्! त्यहाँ प्रयोगकर्ता मेट्दा एक समस्या भयो।');
			}
	} else {
		redirect('../users', 'error', 'प्रयोगकर्ता भेटिएन।');
	}
} else {
	redirect('../admin/users', 'error', 'कृपया पहिले विवरणहरू भर्नुहोस्।');
}