<?php 

$link= mysqli_connect('localhost','oxygenal_admin','$*Sl*@ZWUSf-','oxygenal_shikshak');

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

header('Content-Type: application/json; charset=utf-8');

    $update = $_REQUEST['update'];

    if($update == "password"){

        $id = $_POST['id'];

        $query= "SELECT * FROM users WHERE id = '$id' ";
		
		$run=mysqli_query($link,$query);
		
		$get = mysqli_fetch_assoc($run);

        $newPassword = sha1($get['username'].$_POST['newpassword']); 
        
         $oldPassword = $get['password'];

        if($oldPassword == sha1($get['username'].$_POST['oldpassword'])){
            
            $qryUpdate = "UPDATE users SET password = '$newPassword' WHERE id = '$id' ";

			$qryUpdate= mysqli_query($link,$qryUpdate);

            if($qryUpdate)
            {
                $result["success"] = "1";
                
                $result["message"] = "success";
                
                echo json_encode($result);
                
            }else{

                $result["success"] = "0";
                
                $result["message"] = "error";
                
                echo json_encode($result);
                
            }
        } else{

            $result['success'] = $oldPassword;
            
            $result['message'] = "error";
            
            echo json_encode($result);

        }
        
    }else{

            $id = $_POST['id'];
            
            $first_name = $_POST['first_name'];
            
            $last_name = $_POST['last_name'];
            
            $full_name = $_POST['first_name']." ". $_POST['last_name'];
            
            $username = $_POST['username'];
        
            $phone = $_POST['phone_number'];
            
            $image = $_POST['image'];
            
            $image = str_replace('data:image/png;base64,', '', $image);
            
            $image = str_replace(' ', '+', $image);
            
            $data = base64_decode($image);
            
            $imageFile = $_POST['image_name'];
            
            $path = UPLOAD_DIR.'users/';
            
            file_put_contents($path.$imageFile, $data);
            
            $finalImage = 'http://oxygenaltitude.com/uploads/users/'.$imageFile;
       
            $country = $_POST['country'];
           
    		if ($file) {
    		
    			if (isset($_POST['delete_old_image']) && !empty($_POST['delete_old_image']) && file_exists(UPLOAD_DIR.'users/'.$_POST['delete_old_image'])) {
    						
    						unlink(UPLOAD_DIR.'users/'.$_POST['delete_old_image']);
    						
    				}
    			
    			$data = $file;
    		
    		}
    

            $qryUpdate = "UPDATE users SET first_name = '$first_name', last_name ='$last_name', full_name = '$full_name', username = '$username', phone_number = '$phone', image = '$finalImage', country = '$country' WHERE id = '$id' ";

            $resUpdate= mysqli_query($link,$qryUpdate);
            

            if($resUpdate)
            {
                
                $result["success"] = "1";
                
                $result["message"] = "success";
                
                $result['image'] = $image;
                
                echo json_encode($result);
                
                
            }else{

                $result["success"] = "0";
                
                $result["message"] = "error";
                
                $result['image'] = $image;
                
                echo json_encode($result);
                
            }

    }


?>