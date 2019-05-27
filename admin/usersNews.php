<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'news.php';

$user = new User;

$news = new News;

$writer = new postAuthor();

header('Content-Type: application/json; charset=utf-8');

$userList = $user->getAllUser();

$id = $_REQUEST['user'];

$page = $_REQUEST['page'];

if ($id == 'alluser') {
	
	$userList = $user->getAllUserList();
	
	if(is_array($userList) || is_object($userList)){
            
            $result = array();
            
                foreach ($userList as $newsList) {
                $authorDetail = $writer->getAuthorById($newsList->id);
                $newsList->authorDetail = $authorDetail;
                $json[] = $newsList;
            } 
        }

	echo json_encode($json);

} else {
    
    if($page == 1 || 0){
    
       $offset = 0;
       
    } else {
        
       $offset = $page*10-10;
       
       if($offset == -10){
           $offset = 0;
       }
       
    }

	$userNews = $news->getNewsByUserIdOffset($id, $offset, 10);
	
	if(is_array($userNews) || is_object($userNews)){
            
            $result = array();
            
                foreach ($userNews as $newsList) {
                $authorDetail = $writer->getAuthorById($newsList->id);
                $newsList->authorDetail = $authorDetail;
                $json[] = $newsList;
            } 
        }

	echo json_encode($json);

}

