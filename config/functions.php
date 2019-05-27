<?php 

function debugger($data, $is_die = false){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	if ($is_die) {
		exit;
	}
}

function api_response($data = array(), $status = true, $response_code = 200, $message = null){
	$api_model = new stdClass();
	$api_model->body = $data;
	$api_model->status = array();
	$api_model->status['status'] = $status;	
	$api_model->status['response_code'] = $response_code;	
	$api_model->status['message'] = $message;	

	return json_encode($api_model, JSON_HEX_APOS);
}

function getCurrentPage(){
	$current_page = $_SERVER['PHP_SELF'];
	return pathinfo($current_page, PATHINFO_FILENAME);
}

function redirect($path, $key = null, $message = null){
	if (isset($_SESSION) && $key != null) {
		$_SESSION[$key] = $message;
	}
	@header('location: '.$path);
	exit;
}

function generateRandomString($length = 100){
	$chars = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$len = strlen($chars);
	$rand = "";
	for ($i=0; $i < $length ; $i++) { 
		$rand .= $chars[rand(0, $len)-1];
	}
	return $rand;
}

function generateRandomOrder($length = 15){
	$chars = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$len = strlen($chars);
	$rand = "";
	for ($i=0; $i < $length ; $i++) { 
		$rand .= $chars[rand(0, $len)-1];
	}
	return $rand;
}

function escapeString($str){
	$str = strip_tags($str);
	/*$str = stripslashes($str);
	$str = addslashes($str);
*/	$str = htmlentities($str);
	$str = trim($str);
	return $str;
}

function flash(){
	if (isset($_SESSION['error']) || isset($_SESSION['success']) || isset($_SESSION['info']) || isset($_SESSION['warning'])) {
	?>
		<div class="modal" tabindex="-1" role="dialog" id="pop_up">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content" >
		        <?php 
					if (isset($_SESSION, $_SESSION['success']) && !empty($_SESSION['success'])) {
						echo "<p class='alert alert-success' style='margin-bottom: 0px;'>".$_SESSION['success']."</p>";
						unset($_SESSION['success']);
					}
					if (isset($_SESSION, $_SESSION['error']) && !empty($_SESSION['error'])) {
						echo "<p class='alert alert-danger' style='margin-bottom: 0px;'>".$_SESSION['error']."</p>";
						unset($_SESSION['error']);
					}
					if (isset($_SESSION, $_SESSION['warning']) && !empty($_SESSION['warning'])) {
						echo "<p class='alert alert-warning' style='margin-bottom: 0px;'>".$_SESSION['warning']."</p>";
						unset($_SESSION['warning']);
					}
					if (isset($_SESSION, $_SESSION['info']) && !empty($_SESSION['info'])) {
						echo "<p class='alert alert-info' style='margin-bottom: 0px;'>".$_SESSION['info']."</p>";
						unset($_SESSION['info']);
					}
		        ?>
		      
		    </div>
		  </div>
		</div>
	<?php

		}
	}

function uploadSingleFile($filename, $folder, $type = "image"){
	
	if (isset($filename) && !empty($filename)) {
		$ext = pathinfo($filename['name'], PATHINFO_EXTENSION);
		if (in_array(strtolower($ext), (($type == "image") ? ALLOWED_IMAGE : ALLOWED_FILE))) {
			if ($filename['size'] <= 20000000000) {
				$path = UPLOAD_DIR.$folder;
				if (!is_dir($path)) {

		/*providing full permission to the folder to be created dynamically*/
					$permit = 0755;
					mkdir($path);
					chmod($path, $permit);
		/*providing full permission to the folder to be created dynamically*/

				}
				$file_parts = explode('/', $folder);
				$file_name_start = $file_parts[count($file_parts)-1];
				$file_name = ucfirst($file_name_start)."-".date('Ymdhis').rand(0, 999).".".$ext;
				$success = move_uploaded_file($filename['tmp_name'], $path.'/'.$file_name);
				if ($success) {
					return UPLOAD_URL.$folder.'/'.$file_name;
				} else {
					return null;
				}
			} else {
				return null;
			}
		} else {
			return null;
		}
	} else {
		return null;
	}
}

function getAlphaNumericValue($str){
	/*Replace non digit and non alpha value from string.*/
	$str = preg_replace('~[^\pL\d]+~u', '_', $str);
	/*Transliterate phonetic symbols*/
	$str = iconv('utf-8','us-ascii//TRANSLIT',$str);
	/*Remove _ from starting and ending of the string*/
	$str = trim($str,'_');
	/*Remove double _ from the string*/
	$str = preg_replace('~_+~', '_', $str);
	$str = strtolower($str);
	if (empty($str)) {
		return false;
	}
	return $str;
}

function deleteDir($path){
	$file_info = glob($path.'/*');
	foreach ($file_info as $file) {
		if (is_file($file)) {
			unlink($file);
		}
	}
	rmdir($path);
}

function json_validator($data=NULL) {
  if (!empty($data)) {
                @json_decode($data);
                return (json_last_error() === JSON_ERROR_NONE);
        }
        return false;
}


function getVideoIdFromUrl($url){
	if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
		$id = $match[1];
		return $id; 
	} else {
		return false;
	}
}

function send_notification($data, $token)
    { 
        define( 'API_ACCESS_KEY', 'AAAALg4qKJs:APA91bGD3OB05I_Y1pbN2tql7UENY_P2jnI3dgxvY6rJzA3ubg79jWRzqCfpcoNSj0jW8p08RnhVMH2JZnpCG7whotO1ZYZmTs9hzeP_DJbG2iQsf_1jl8Y6dzsMcdsOfaRKhEIF2_du');
 //   $registrationIds = ;

        $title = $_POST['title'];
        $message = htmlentities($_POST['story']);
        $added_date = $data['added_date'];
        $imagefinal = $data['image'];
        $userDetail = $data['userDetail'];
        $catTitle = $data['catTitle'];
        $id = $data['id'];
        $token = $token;
        $countDetail = count($data['userDetail']);
        if($countDetail = 2){
           $authorName1 = $userDetail[0]->author; 
           $authorUserInfo1 = $userDetail[0]->user_info; 
           $authorUserId1 = $userDetail[0]->user_id; 
           $authorProfilePicture1 = $userDetail[0]->profile_picture;
           $authorName2 = $userDetail[1]->author; 
           $authorUserInfo2 = $userDetail[1]->user_info; 
           $authorUserId2 = $userDetail[1]->user_id; 
           $authorProfilePicture2 = $userDetail[1]->profile_picture;
        } else {
           $authorName1 = $userDetail[0]->author; 
           $authorUserInfo1 = $userDetail[0]->user_info; 
           $authorUserId1 = $userDetail[0]->user_id; 
           $authorProfilePicture1 = $userDetail[0]->profile_picture; 
        }
    
    if($countDetail = 2){
        $array = array(
        
        'id' => $id,
        'story'  => $message,    
        'title' => $title,
        'image_url' => $imagefinal,
        'added_date' => $added_date,
        'authorName1' => $authorName1,
        'authorInfo1' => $authorUserInfo1,
        'authorId1' => $authorUserId1,
        'profilePicture1' => $authorProfilePicture1,
        'authorName2' => $authorName2,
        'authorInfo2' => $authorUserInfo2,
        'authorId2' => $authorUserId2,
        'profilePicture2' => $authorProfilePicture2,
        'category' => $catTitle
        );
    } else {
        $array = array(
        'id' => $id,
        'story'  => $message,    
        'title' => $title,
        'image_url' => $imagefinal,
        'added_date' => $added_date,
        'authorName1' => $authorName1,
        'authorInfo1' => $authorUserInfo1,
        'authorId1' => $authorUserId1,
        'profilePicture1' => $authorProfilePicture1,
        );
    }
    
    
        
        $fields = array
        (
                'to'        => $token,
                'data' => $array
            );


        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

#Send Reponse To FireBase Server    
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        echo $result;
        curl_close( $ch );
    }
