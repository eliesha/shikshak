<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'comments.php';

$user = new User;

$comments = new Comments;

header('Content-Type: application/json; charset=utf-8');

$userList = $user->getAllUser();

$id = $_REQUEST['post_id'];

$user_id = $_REQUEST['user_id'];

if (!empty($id)) {
	
	$commentList = $comments->getCommentPostById($id);

	echo json_encode($commentList);

} elseif(!empty($user_id)){
    
    $userComment = $comments->getCommentsByUserId($user_id);
    
    echo json_encode($userComment);
    
}