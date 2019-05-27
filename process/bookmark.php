<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'bookmark.php';

$user = new User();

$bookmark = new Bookmark();

if(isset($_POST['user_id']) && ($_POST['post_id']) && !empty($_POST['user_id']) && !empty($_POST['post_id'])) {
    
    $data['user_id'] = $_POST['user_id'];
    
    $data['post_id'] = $_POST['post_id'];
    
    $checkBookmark = $bookmark->checkBookmarkDetails($data['user_id'], $data['post_id']);
    
    $count = count($checkBookmark);
    
    if($count == 0){
        
        $insertBook = $bookmark->insertBookmarkDetails($data);
        
        if($insertBook){
            
            $result['success'] = 'added';
            
            $result['message'] = 'Bookmark added.';
            
            echo json_encode($result);
            
            die;
            
        }
        
    } else {
        
        $delete = $bookmark->deleteBookmarkDetails($data['user_id'], $data['post_id']);
        
        if($delete){
            
            $result['success'] = 'removed';
            
            $result['message'] = 'Bookmark removed.';
            
            echo json_encode($result);
            
            die;
        }
        
    }
    
}