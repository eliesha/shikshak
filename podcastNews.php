<?php require 'inc/header.php';
    
    require CLASS_PATH.'ads.php';
    
    require CLASS_PATH.'comments.php';
    
    $ads = new Ads;
    
    $postAuthor = new postAuthor();
    
    if (isset($_GET['pod_id']) && !empty($_GET['pod_id'])) {
        
        $id = $_GET['pod_id'];
        
        if ($id) {
            
            $getNews = $podcast->getPodcastById($id);
            //debugger($getNews, true);
        }
        
    }
    
     ?>
<div class="main">
<div class="container">
    <!-- End of top adspace -->
    <div class="row py-2 px-2">
        <!--  Main Content Column-->
        <div class="col-md-9" style="text-align: justify">
            <h1 class="py-3" style="margin: auto;"><?php echo $getNews[0]->title ?>
            </h1>
            <p class="ptype777 editor">
                <?php echo html_entity_decode($getNews[0]->description) ?>
            </p>
            <?php 
            $baseaudio = basename($getNews[0]->audio);
            if(!empty($getNews[0]->audio) && file_exists(UPLOAD_DIR.'podAudio/'.$baseaudio)){
                $audioPodcast = UPLOAD_URL.'podAudio/'.$baseaudio;
                ?>
                <audio controls>
                  <source src="<?php echo $audioPodcast ?>">
                Your browser does not support the audio element.
                </audio>
                <?php
            } elseif(!empty($getNews[0]->url)){
                ?>
                <iframe width="100%" height="350"
                src="https://www.youtube.com/embed/<?php echo $getNews[0]->url ?>">
                </iframe>
                <?php
            }
            ?>
        </div>
        <!-- Sidebar -->
        <div class="col-lg-3 col-xs-12 col-md-3 ">
            <div class="row">
                <?php
                    $innerAds = $ads->getInnerAds(4);
                    
                    if($innerAds){
                        
                        foreach($innerAds as $inner){
                            
                            $base = basename($inner->image);
                            
                            if(isset($inner->image) && !empty($inner->image) && file_exists(UPLOAD_DIR.'ads/'.$base)){
                                
                                $thumbnail = UPLOAD_URL.'ads/'.$base;
                                
                            } else {
                                
                                $thumbnail = FRONT_IMAGES_URL.'template2.gif';
                                
                            }
                            
                            ?>
                <a href="<?php echo $inner->url ?>" class="apple2" target="_blank"><img src="<?php echo $thumbnail ?>" alt="commercial" class="img-fluid pt-4 apple"></a>
                <?php
                    }
                    
                    }
                    
                    ?>
            </div>
        </div>
    </div>
</div>
<!-- End of section  -->
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>