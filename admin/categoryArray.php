<?php 


require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'category.php';

require CLASS_PATH.'news.php';

header('Content-Type: application/json; charset=utf-8');

$category = new Category();

$news = new News();

$writer = new postAuthor();

$id = $_REQUEST['category'];

$page = $_REQUEST['page'];

    if ($id == 'alldata') {
        
        $query = $news->getAllNews(); 
        
        if(is_array($query) || is_object($query)){
            
            $result = array();
            
                foreach ($query as $newsList) {
                $authorDetail = $writer->getAuthorById($newsList->id);
                $newsList->authorDetail = $authorDetail;
                $json[] = $newsList;
            } 
        }
        
        echo json_encode($json);


    } elseif ($id == 3) {
        
        $query = $category->getChildByParent($id);

        echo json_encode($query);

    
    } elseif($id == 'griha'){
        
        if($page == 1 || 0){
            
           $offset = 0;
           
        } else {
            
           $offset = $page*10-10;
           
           if($offset == -10){
               $offset = 0;
           }
           
        }
        
        $query = $news->getNewsGrihaLimit($offset, 10);
        
        if(is_array($query) || is_object($query)){
            
            foreach($query as $key => $question){
                $authorDetail = $writer->getAuthorById($question->id);
                $question->authorDetail = $authorDetail;
                $json[] = $question;
            }
            echo json_encode($json);
        }


    }elseif ($id == 0) {
        
        $query = $category->getNewsCategoryWithoutStambha();

        echo json_encode($query);

    }
    else{
        
        if($page == 1 || 0){
            
           $offset = 0;
           
        } else {
            
           $offset = $page*10-10;
           
           if($offset == -10){
               $offset = 0;
           }
           
        }
        
        $query = $news->getNewsByCatIdLimit($id, $offset, 10);
        
        if(is_array($query) || is_object($query)){
            
            $result = array();
            
                foreach ($query as $newsList) {
                $authorDetail = $writer->getAuthorById($newsList->id);
                $newsList->authorDetail = $authorDetail;
                $json[] = $newsList;
            } 
        }

        echo json_encode($json);        
    }

        
?>