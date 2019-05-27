<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'news.php';

require CLASS_PATH.'series.php';

$news = new News();

$series = new Series();

$writer = new postAuthor();

header('Content-Type: application/json; charset=utf-8');

$date = $_REQUEST['date'];

$image = $_REQUEST['month'];

$page = $_REQUEST['page'];

$date = strtotime($date);

$startingDate = date('Y-m-01', $date);
    
$lastdate = date('Y-m-31', $date);

if($page == 1 || 0){
    
   $offset = 0;
   
} else {
    
   $offset = $page*10-10;
   
   if($offset == -10){
       $offset = 0;
   }
   
}

$getArchive = $news->getNewsByDate($startingDate, $lastdate, $offset, 10);

$photo = $series->getSeriesForNav(12);

if(!empty($getArchive)){
    
    if(is_array($getArchive) || is_object($getArchive)){
            
            $result = array();
            
                foreach ($getArchive as $newsList) {
                $authorDetail = $writer->getAuthorById($newsList->id);
                $newsList->authorDetail = $authorDetail;
                $json[] = $newsList;
            } 
        }
        
    echo json_encode($json);
    
    
    
} elseif($image == 'all'){
    
    echo json_encode($photo);
    
}

