<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'news.php';

$news = new News();

if(isset($_GET['offset']) && isset($_GET['limit'])){
    debugger($_GET, true);
    $offset = $_GET['offset'];
    
    $limit = $_GET['limit'];
    
    $query = $news->getNewsByUserId($offset, $limit);
    
    echo "hello";
    
}


?>