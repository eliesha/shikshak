<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'comments.php';

$user = new User();

$comments = new Comments();

header('Content-Type: application/json; charset=utf-8');
    
if(isset($_POST['user_id']) && ($_POST['post_id']) && !empty($_POST['user_id']) && !empty($_POST['post_id'])) {

    $data['user_id'] = $_POST['user_id'];
    
    $data['post_id'] = $_POST['post_id'];
    
    $data['comment'] = htmlentities($_POST['comment']);
    
    $insertComments = $comments->insertCommentsDetails($data);
    
    if($insertComments){
        
        $result['success'] = '1';
        
        $result['message'] = "प्रतिक्रियाका लागि धन्यवाद । तपाईंको प्रतिक्रिया समीक्षा पश्चात् प्रकाशित गरिनेछ ।";
        
        echo json_encode($result);
        
    } else {
        
        $result['success'] = '0';
        
        $result['message'] = "तपाईको प्रतिक्रिया थपगर्दा समस्या भयो, केहि समयपछि पूर्ण प्रयास गर्नुहोस्। ";
        
        echo json_encode($result);
        
    }

}

