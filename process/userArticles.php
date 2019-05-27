<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'news.php';

require CLASS_PATH.'user.php';

$news = new News();

$users = new User();

header('Content-Type: application/json; charset=utf-8');

$user_id = $_REQUEST['id'];

if(!empty($user_id)){
    
    $articleList = $news->getNewsMannkaaKuraOfUser($user_id);
    
    echo json_encode($articleList);
    
}