<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'comments.php';

$user = new User();

$comments = new Comments();

if(isset($_SESSION['fuser_id'])){
    
    if(isset($_POST['user_id']) && ($_POST['post_id']) && !empty($_POST['user_id']) && !empty($_POST['post_id'])) {
    
        $data['user_id'] = $_POST['user_id'];
        
        $data['post_id'] = $_POST['post_id'];
        
        $data['comment'] = htmlentities($_POST['comment']);
        
        $insertComments = $comments->insertCommentsDetails($data);
        
        if($insertComments){
            
            echo "प्रतिक्रियाका लागि धन्यवाद । तपाईंको प्रतिक्रिया समीक्षा पश्चात् प्रकाशित गरिनेछ ।";
            
        } else {
            
            echo "तपाईको प्रतिक्रिया थपगर्दा समस्या भयो, केहि समयपछि पूर्ण प्रयास गर्नुहोस्।";
            
        }
    
    } 
    
} else {
    
    echo 'प्रतिक्रिया गर्नकालागी साइन इन गर्नुहोस्।';
    
}

