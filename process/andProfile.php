<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'session.php';

require CLASS_PATH.'news.php';

require CLASS_PATH.'comments.php';

require CLASS_PATH.'bookmark.php';

$user = new User();

$session = new Session();

$comments = new Comments();

$bookmark = new Bookmark();

$news = new News();

header('Content-Type: application/json; charset=utf-8');

$id = $_REQUEST['id'];

if(isset($id)){
    
    $userInfo = $user->getUserById($id);
    
    $getBookmark = $bookmark->getBookmarkByUserId($id);
    
    $countBookmark = count($getBookmark);
    
    $getArticle = $news->getNewsMannkaaKuraOfUser($id);
    
    $commentCount = $comments->getCommentsByUserId($id);
    
    $commentCount = count($commentCount);
    
    $countArticle = count($getArticle);
    
    if ($userInfo) {
	            
	            $result = array();  
	            
	            $index = array();
			    
			    $index['first_name'] = $userInfo[0]->first_name;
			    
			    $index['last_name'] = $userInfo[0]->last_name;
                
                $index['username'] = $userInfo[0]->username;
                
                $index['email'] = $userInfo[0]->email;
                
                $index['phone_number'] = $userInfo[0]->phone_number;
                
                $index['country'] = $userInfo[0]->country;
                
                $index['image'] = $userInfo[0]->image;
                
                $index['bookmarkNumber'] = $countBookmark;
                
                $index['articleNumber'] = $countArticle;
                
                $index['commentNumber'] = $commentCount;
            
                $result['login'] = array();
    
                array_push($result['login'], $index);
				
				$data = array('api_token' => $token, 'last_login' => date('Y-m-d H:i:s'));
			   
				$result['success'] = "1";
    		    
    		    $result['message'] = "Successfully logged in.";
    		    
    		    echo json_encode($result);
    		    
    		    echo json_encode($index);
    		    
    		    die;	
	
	} else {
	
	        $result['success'] = "0";
		    $result['message'] = "User not found.";
		    echo json_encode($result);
		    die;
		
	}
    
    
} else {
    
    $result['success'] = "0";
    
    $result['message'] = "Unauthorized access.";
    
    echo json_encode($result);
    
    die;
    
}

?>
