<?php
    require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
    
    require CLASS_PATH.'news.php';
    
    $news = new News();
    
    if(isset($_POST['limit'])){
        
        $limit = $_POST['limit'];
        
        $id = $_POST['id'];
        
    }
    
    $getCatnews = $news->getNewsByUserId($id, $limit);
    
    if($getCatnews){
        
        foreach($getCatnews as $newsList){
            
            $act = explode(' ', html_entity_decode($newsList->title));
                            $act = implode('-', $act);
            
            $thumbnail = basename($newsList->image);
            
            if(!empty($newsList->image) && file_exists(UPLOAD_DIR.'news/'.$thumbnail)){
                
                $thumbnail = UPLOAD_URL.'news/'.$thumbnail;
                
            } else {
                
                $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                
            }
            
            echo '<div class="row  rowmain">
    
                        <div class="col-md-7 topics-sec-item-cont">
    
                            <p class="topics-sec-item-label">
    
                                <time id="PubTime">'.$newsList->added_date.'</time></p>
                            <a href="/'.$newsList->id.'/'.$act.'"><h2 class="topics-sec-item-head">'.$newsList->title.'</h2>
    
                            </a>
    
                            <p class="topics-sec-item-p">'.$newsList->summary.'</p>
    
                        </div>
    
                        <div class="col-md-5 topics-sec-item-img">
    
                            <img src="'.$thumbnail.'" class="img-fluid">
    
                        </div>
    
                    </div>';
            
        }
        
    } else {
        
        echo "<h1>No more News</h1>";
        
    }
    
    ?>