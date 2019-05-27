<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'session.php';

require CLASS_PATH.'comments.php';

$user = new User();

$comments = new Comments();

$session = new Session();

if(isset($_SESSION['user_id'])){
    
    if(isset($_POST['id']) && !empty($_POST['id'])) {
        
        $id = $_POST['id'];
        
        $data['comment'] = $_POST['comment'];
        
        $data['status'] = (isset($_POST['status']) && !empty($_POST['status']) ? $_POST['status']: 'Inactive');
        
        $updateComments = $comments->updateCommentsDetails($id, $data);
       
        if($updateComments){
            
            redirect('../comments.php', 'success', "प्रतिक्रियाका लागि धन्यवाद । तपाईंको प्रतिक्रिया समीक्षा पश्चात् प्रकाशित गरिनेछ ।");
            
        } else {
                
                redirect('../comments.php', 'error', "तपाईको प्रतिक्रिया थपगर्दा समस्या भयो, केहि समयपछि पूर्ण प्रयास गर्नुहोस्।");
            
            }
    
    }  elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {

	$id  = (int)$_GET['id'];
	
	$act = escapeString($_GET['act']);
	
	if ($act == substr(md5("delete_comment-".$id.$session->getSessionByKey('session_token')), 3, 15)) {
		
		$comment_info = $comments->getCommentById($id);
		
		if ($comment_info) {
			
			$delete  = $comments->deleteCommentsDetails($id);
			
			if ($delete) {

				redirect('../comments', 'success', 'प्रतिक्रिया सफलतापूर्वक हटाइयो।');
			
			} else {
				
				redirect('../comments', 'error', 'माफ गर्नुहोस्! प्रतिक्रिया मेट्दा समस्या भयो।');
			
			}
		
		} else {

			redirect('../comments', 'error', 'तपाईंले खोज्नु भएको प्रतिक्रिया पाइएन।');
		
		}
	
	} else {

		redirect('../comments', 'error', 'टोकन बेमेल।');
	
	}

}
    
} else {
    
    echo 'प्रतिक्रिया एडिट गर्नकालागी साइन इन गर्नुहोस्।';
    
}

