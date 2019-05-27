<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'comments.php';

$comments = new Comments();

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

if(isset($_POST['id'])){
    
    $id = $_POST['id'];
    
    $limit = $_POST['limit'];
    
}

$relatedComments = $comments->getCommentPostById($id, $limit);

$count = count($relatedComments);

if($count > 0){
    
    foreach($relatedComments as $comment){
        
        $act = explode(' ', html_entity_decode($comment->title));
                        $act = implode('-', $act);
        
        $thumbnail = basename($comment->profile);
        
        if(isset($comment->profile) && file_exists(UPLOAD_DIR.'users/'.$thumbnail)){
            
            $thumbnail = UPLOAD_URL.'users/'.$thumbnail;
            
        } else {
            
            $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
            
        }
        
        echo '<div class="row comment-back">
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <img src="'.$thumbnail.'" alt="" style="width:40px;"> <br>
                                <span>'.$comment->commentator.'</span>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <label>'.$comment->comment.'</label>
                            </div>
                        </div> <hr>';
        
    }
    
} 



?>