<?php require 'inc/header.php';
    $id = $_GET['cat_id'];
    
    if(isset($_GET['cat_id']) && !empty($_GET['cat_id'])){
        
        $categoryNews = $news->getNewsByCatId($id);
        
        $categoryCount = count($categoryNews);
        
    }
    
    ?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1 class="profile-des-title" style="text-decoration: underline"><?php echo $categoryNews[0]->news_category ?></h1>
                <div class="wrap">
                    <?php 
                        if(!empty($categoryNews)){
                            
                            foreach($categoryNews as $newsList){
                                
                                $basename = basename($newsList->image);
                                
                                if(!empty($newsList->image) && file_exists(UPLOAD_DIR.'news/'.$basename)){
                                    
                                    $image = UPLOAD_URL.'news/'.$basename;
                                    
                                } else {
                                    
                                    $image = FRONT_IMAGES_URL.'shikshak.jpg';
                                    
                                }
                                
                                ?>
                    <div class="wrap" id="wrap"></div>
                    <?php
                        }
                        
                        }
                        
                        ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="hover-effect trending-headlines">
                        <ul class="tabheader" style="list-style: none;">
                            <li style="margin-bottom: 0px">शिक्षा
                                खबर
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <ul class="trending list-group">
                                <?php 
                                    $khabar = $news->getNewsByCatId(30 ,8);
                                    if($khabar){
                                        foreach($khabar as $khabarList){
                                            $act = explode(' ', html_entity_decode($khabarList->title));
                                            $act = implode('-', $act);
                                            $categoryAct = explode(' ', html_entity_decode($khabarList->news_category));
                                            $categoryAct = implode('-', $categoryAct);
                                            ?>
                                <li class="list-group-item">
                                    <a href="/<?php echo $khabarList->id;?>/<?php echo $act ?>"><?php echo $khabarList->title ?></a>
                                </li>
                                <?php
                                    }
                                    }
                                    ?>
                            </ul>
                            <ul class="more2 titletype2" style="list-style: none">
                                <a href="/category/<?php echo $khabarList->category_id ?>/<?php echo $categoryAct ?>">
                                    <li style="margin-bottom: 0px;height: 25px">
                                        अन्य विषय
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>
<script type="text/javascript">
    $( document ).ready(function() {
        var count = 5;
        var bookCount = <?php echo $categoryCount ?>;
        var category = <?php echo $_GET['cat_id'] ?>;
        count = count;
        $('#wrap').load('/categoryData.php', {
            limit: count,
            cat_id: category
        });
        var percent = 80;
        var window_scrolled;
        var scrollCount = 1;
        $(window).scroll(function() {
            window_scrolled = ($(document).height()/100)*80;
            if($(window).scrollTop() + $(window).height() >= window_scrolled) {
               count = count + 5;
                if(bookCount > scrollCount*5){
                    $('#wrap').load('/categoryData.php', {
                        limit: count,
                        cat_id: category
                    });
                } 
                scrollCount++;
           }
        });
    });
    
</script>