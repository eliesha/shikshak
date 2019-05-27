<?php
    require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
    
    require CLASS_PATH.'bookmark.php';
    
    $bookmark = new Bookmark;
    
    require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
    
    if(isset($_POST['limit'])){
        
        $limit = $_POST['limit'];
        
        $id = $_SESSION['fuser_id'];
        
    }
    
    $countMark = $bookmark->getBookmarkByUserId($id);
    
    $count = count($countMark);
    
    $getBookmark = $bookmark->getBookmarkByUserIdLimit($id, 0, $limit);
    
    if($getBookmark > 0){
        
        foreach($getBookmark as $book){
            
            $act = explode(' ', html_entity_decode($book->title));
                            $act = implode('-', $act);
            
            $thumbnail = basename($book->image);
            
            if(!empty($book->image) && file_exists(UPLOAD_DIR.'news/'.$thumbnail)){
                
                $thumbnail = UPLOAD_URL.'news/'.$thumbnail;
                
            } else {
                
                $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                
            }
            
            echo '<div class="row  rowmain" style="background: #eee">
                                    <div class="col-md-7 topics-sec-item-cont">
                                        <p class="topics-sec-item-label">
                
                                            <time id="PubTime">'.$book->added_date.'</time></p>
                                        <a href="/'.$book->id.'/'.$act.'"><h2 class="topics-sec-item-head">'.$book->title.'</h2>
                                        </a>
                                        <p class="topics-sec-item-p">'.$book->summary.'</p>
                                    </div>
                                    <div class="col-md-5 topics-sec-item-img">
                                        <img src="'.$thumbnail.'" class="img-fluid">
                                    </div>
                
                                </div>';
            
        }
        
    } else {
        
        echo "No more bookmarks";
        
    }
    
    
    
    ?>