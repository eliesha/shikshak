<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'session.php';

require CLASS_PATH.'bookmark.php';

require CLASS_PATH.'news.php';

$user = new User();

$session = new Session();

$news = new News();

$bookmark = new Bookmark();

$writer = new postAuthor();

header('Content-Type: application/json; charset=utf-8');

$id = $_REQUEST['id'];

if(isset($id)){
    
    $userBookmark = $bookmark->getBookmarkByUserId($id);
    
    if(is_array($userBookmark) || is_object($userBookmark)){
            
            $result = array();
            
                foreach ($userBookmark as $newsList) {
                $authorDetail = $writer->getAuthorById($newsList->id);
                $newsList->authorDetail = $authorDetail;
                $json[] = $newsList;
            } 
        }
    
    echo json_encode($json);
    
    die;
    
}