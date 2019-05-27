<?php 
    require 'inc/header.php';
    
    require CLASS_PATH.'article.php';
    
    require CLASS_PATH.'/ads.php';
    
    require CLASS_PATH.'/janamat.php';
    
    require CLASS_PATH.'/quiz.php';
    
    $article = new Article;
    
    $ads = new Ads;
    
    $janamat = new Janamat;
    
    $quiz = new Quiz;
    
    require CLASS_PATH.'quizOptions.php';
    
    require CLASS_PATH.'quizans.php';
    
    $quizAns = new QuizansUsers;
    
    $quizoptions = new QuizOptions;
    
    $date = date('Y-m-01');
    
    $deleteData = $quizAns->deleteDataLastMonth($date);
    
    ?>
<div class="main">
<div class="container">
<!-- End of top adspace -->
<section id="main-content2">
    <div class="container">
        <div class="newscontainer-withsidebar">
            <div class="row headlines-and-sidebar">
                <!-- Main- Headlines -->
                <div class="col-lg-9 col-md-12">
                    <div class="main-headlines">
                        <?php 
                            
                            $getNews = $news->getMainNews();
                            
                            if ($getNews) {
                                $i = 0;
                                foreach ($getNews as $mainNews) {
                                   
                                    $act = explode(' ', html_entity_decode($mainNews->title));
                                    $act = implode('-', $act);
                            
                                    ?>
                        <!-- image with headline-->
                        <a href="/<?php echo $mainNews->id;?>/<?php echo $act ?>">
                            <div class="row imagewithheadline hover-effect">
                                <h4 class="header2">
                                    <?php echo $mainNews->title ?>
                                </h4>
                                <div class="header2-image">
                                    <?php 
                                        $baseimage = basename($mainNews->image);
                                        
                                        if (isset($mainNews->image) && !empty($mainNews->image) && file_exists(UPLOAD_DIR.'news/'.$baseimage)) {
                                            
                                            $feature = UPLOAD_URL.'news/'.$baseimage;
                                        
                                        } else {
                                        
                                            $feature = FRONT_IMAGES_URL.'shikshak.jpg';
                                        }
                                        
                                         ?>
                                    <img src="<?php echo $feature ?>" alt="pic" class="img-fluid">
                                </div>
                                <?php 
                                    if($i == 0){
                                        $class = "synopsis p-4";
                                    } else {
                                        $class = "";
                                    }
                                    ?>
                                <div class="<?php echo $class; ?>">
                                    <?php 
                                        if($i == 0){
                                            ?>
                                    <p style="text-align:center">
                        <a href="/<?php echo $mainNews->id;?>/<?php echo $act ?>">
                        <?php 
                            $summary = strip_tags($mainNews->summary);
                            
                            echo html_entity_decode($summary) ?></a>
                        </p>
                        <?php
                            } else {
                                echo '';
                            }
                            
                            ?>
                        </div>
                        </div></a>
                        <!-- image with headline-->
                        <?php
                            $i++;
                            }
                            }
                            ?>   
                    </div>
                </div>
                <!--Sidebar-->
                <!-- Trending Tab -->
                <div class="col-lg-3 col-md-12">
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
                    <div class="row sidebar-class">
                        <div class="col-lg-12 col-md-12">
                            <?php 
                                $frontBanner = $ads->getFrontAds(1);
                                
                                if($frontBanner){
                                    
                                    foreach($frontBanner as $addBanner){
                                        
                                        $base = basename($addBanner->image);
                                
                                        if(isset($addBanner->image) && !empty($addBanner->image) && file_exists(UPLOAD_DIR.'ads/'.$base)){
                                            
                                            $thumbnail = UPLOAD_URL.'ads/'.$base;
                                            
                                        } else {
                                            
                                            $thumbnail = FRONT_IMAGES_URL.'template2.gif';
                                            
                                        }
                                    }
                                    ?>
                            <a href="<?php echo $addBanner->url ?>" class="apple2" target="_blank"><img src="<?php echo $thumbnail ?>"
                                alt="commercial" class="img-fluid pt-4 apple"></a>
                            <?php
                                }
                                
                                ?>
                        </div>
                    </div>
                    <div class="row sidebar-class">
                        <div class="card hover-effect my-4">
                            <div class="category-name">
                                <a href="#" style="text-align:center"> मनका कुरा</a>
                            </div>
                            <div class="sidebar-manko">
                                <?php 
                                    $getMannKaaKura = $news->getNewsByCatId(14, 8);
                                    
                                    if($getMannKaaKura){
                                        
                                        foreach($getMannKaaKura as $kura){
                                            $writer = $postAuthor->getAuthorById($kura->id);
                                            $act = explode(' ', html_entity_decode($kura->title));
                                            $act = implode('-', $act);
                                            ?>
                                <div class="section-manko">
                                    <h2><a href="/<?php echo $kura->id;?>/<?php echo $act ?>"><?php echo $kura->title ?></a></h2>
                                    <div class="sidebar-image">
                                        <div class="row">
                                            <?php 
                                                $image = basename($writer[0]->profile_picture);
                                                
                                                if(isset($writer[0]->profile_picture) && file_exists(UPLOAD_DIR.'users/'.$image)){
                                                    
                                                $user_image = UPLOAD_URL.'users/'.$image;
                                                    
                                                } else {
                                                    
                                                $user_image = FRONT_IMAGES_URL.'/defaultUser.png';
                                                    
                                                }
                                                
                                                ?>
                                            <div class="col-3 manko-kura-sidebar">
                                                <img src="<?php echo $user_image ?>">
                                            </div>
                                            <div class="col-9 px-0 padding-class">
                                                <p class="sidebar-manko-para"><?php echo $writer[0]->author ?></p>
                                                <p class="date-manko"><?php echo $kura->added_date ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-manko-text">
                                        <p><?php echo $kura->summary ?></p>
                                    </div>
                                </div>
                                <?php
                                    }
                                    }
                                    
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-lg-4">
                <div class="adspace-after-headline padding-for-top">
                    <?php 
                        $bannerFirst = $ads->getLongAdsFirst(1);
                        
                        if($bannerFirst){
                            
                            foreach($bannerFirst as $firstBanner){
                                
                                $base = basename($firstBanner->image);
                            
                                if(isset($firstBanner->image) && !empty($firstBanner->image) && file_exists(UPLOAD_DIR.'ads/'.$base)){
                                    
                                    $thumbnail = UPLOAD_URL.'ads/'.$base;
                                    
                                } else {
                                    
                                    $thumbnail = FRONT_IMAGES_URL.'template2.gif';
                                    
                                }
                                ?>
                    <a href="<?php echo $firstBanner->url ?>" class="apple2" target="_blank"><img src="<?php echo $thumbnail ?>" alt="commercial" class="img-fluid"></a>
                    <?php
                        }
                        
                        }
                        
                        ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
<!--  First section -->
<section id="second-section">
    <div class="container">
        <div class="second-section-headlines">
            <div class="row">
                <!-- top international -->
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <!--international headline big -->
                        <div class="col-lg-6 col-md-6 padding-type">
                            <h5 class="section-headers">
                                शैक्षिक व्यक्तित्व
                            </h5>
                            <div class="smaller-headings1 marginforheader hover-effect">
                                <div id="carouselExampleControls-two" class="carousel slide" data-interval="false">
                                    <div class="carousel-inner">
                                        <?php 
                                            $shaishikProfile = $profile->getAllProfile();
                                               
                                            if($shaishikProfile) {
                                                $i = 0;
                                                foreach ($shaishikProfile as $shaishik){
                                                    if($i == 0){
                                                        $class = 'active';
                                                    } else {
                                                        $class = '';
                                                    }
                                                    $i++;
                                                    ?>
                                        <div class="carousel-item <?php echo $class; ?>">
                                            <div class="top-with-controls">
                                            </div>
                                            <?php 
                                                $image = basename($shaishik->image);
                                                    if(isset($shaishik->image) && !empty($shaishik->image) && file_exists(UPLOAD_DIR.'profile/'.$image)){
                                                $thumbnail = UPLOAD_URL.'profile/'.$image;        
                                                    } else {
                                                        $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                                                    }
                                                ?>
                                            <img class="carousel-image-type1 img-fluid" src="<?php echo $thumbnail ?>"
                                                alt="First slide">
                                            <?php 
                                                $act = explode(' ', html_entity_decode($shaishik->title));
                                                $act = implode('-', $act);
                                                ?>
                                            <a href="/profile/<?php echo $shaishik->id;?>/<?php echo $act ?>">
                                                <h3><?php echo $shaishik->title ?></h3>
                                            </a>
                                            <p><?php 
                                                $summary = $shaishik->summary;
                                                
                                                $summary = strip_tags($summary);
                                                
                                                echo html_entity_decode($summary)  ?></p>
                                        </div>
                                        <?php
                                            }
                                            }
                                                ?>
                                    </div>
                                    <a href="#carouselExampleControls-two" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                    <a href="#carouselExampleControls-two" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- smaller international headings-->
                        <div class="col-lg-6 col-md-6 anotherpadding">
                            <h5 class="section-headers">
                                शैक्षिक डाटा
                            </h5>
                            <div class="smaller-headings1 marginforheader hover-effect">
                                <div id="carouselExampleControls" class="carousel slide" data-interval="false">
                                    <div class="carousel-inner">
                                        <?php 
                                            $shaishikData = $news->getNewsByCatId(29, 7);
                                            
                                            if($shaishikData){
                                                $i = 0;
                                                foreach($shaishikData as $data){
                                                   if($i == 0){
                                                       $class = 'active';
                                                   } else {
                                                       $class= '';
                                                   }
                                                   $i++;
                                                   ?>
                                        <div class="carousel-item <?php echo $class ?>">
                                            <div class="top-with-controls">
                                            </div>
                                            <img class="carousel-image-type1" src="<?php 
                                                $image = basename($data->image);
                                                if(isset($data->image) && !empty($data->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
                                                    $thumbnail = UPLOAD_URL.'news/'.$image;
                                                } else {
                                                    $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                                                }
                                                
                                                
                                                echo $thumbnail ?>" alt="First slide">
                                            <?php 
                                                $act = explode(' ', html_entity_decode($data->title));
                                                $act = implode('-', $act);
                                                ?>
                                            <h3>
                                                <a href="/<?php echo $data->id;?>/<?php echo $act ?>"><?php echo $data->title ?></a>
                                            </h3>
                                            <p><?php 
                                                $summary = $data->summary;
                                                
                                                $summary = strip_tags($summary);
                                                
                                                echo html_entity_decode($summary)  ?></p>
                                        </div>
                                        <?php 
                                            }
                                            }
                                            ?>
                                    </div>
                                    <a href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                    <a href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 anotherpadding">
                    <div class="row">
                        <div class="col-lg-12 col-md-8 pt-md-4 pt-lg-0">
                            <h5 class="section-headers">
                                फुर्सद
                            </h5>
                            <div class="smaller-headings1 marginforheader hover-effect">
                                <div id="carouselExampleControls-three" class="carousel slide"
                                    data-interval="false">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="top-with-controls">
                                                <a href="#">
                                                    <h4>सामान्य ज्ञान</h4>
                                                </a>
                                            </div>
                                            <p>
                                            <p>
                                            <form>
                                                <ul style="list-style:none;padding-left:5px;">
                                                    <?php 
                                                        $date = date('Y-m-01');
                                                        
                                                        $quizQuestion = $quiz->getQuizThisMonth($date, 4);
                                                        
                                                        if($quizQuestion){
                                                        
                                                        foreach($quizQuestion as $questions){
                                                        ?>
                                                    <li>
                                                        <p style="font-weight: 600"><?php echo $questions->title ?></p>
                                                    </li>
                                                    <?php
                                                        }
                                                        
                                                        }
                                                        
                                                        ?>
                                                    <li>
                                                        <div class="quiz">
                                                            <a href="quiz.php" class="btn btncustom btn-block"                          style="cursor: pointer">हाम्रो प्रश्नोत्तरी खेल्नुहोस्।</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <?php 
                                                    if(@$_SESSION['error'] && !empty(@$_SESSION['error'])){
                                                        ?>
                                                <p class="front-error"><?php echo $_SESSION['error'] ?></p>
                                                <?php
                                                    unset($_SESSION['error']);
                                                    } else if(@$_SESSION['success'] && !empty(@$_SESSION['success'])){
                                                    ?>
                                                <p class="front-error"><?php echo $_SESSION['success'] ?></p>
                                                <?php
                                                    unset($_SESSION['success']);
                                                    }
                                                    
                                                    ?>
                                            </form>
                                        </div>
                                    </div>
                                    <a href="#carouselExampleControls-three" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                    <a href="#carouselExampleControls-three" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="ad-after-section1 py-md-2">
    <div class="image">
        <?php 
            $bannerSecond = $ads->getLongAdsSecond(1);
            
            if($bannerSecond){
                
                foreach($bannerSecond as $secondBanner){
                    
                    $base = basename($secondBanner->image);
                
                    if(isset($secondBanner->image) && !empty($secondBanner->image) && file_exists(UPLOAD_DIR.'ads/'.$base)){
                        
                        $thumbnail = UPLOAD_URL.'ads/'.$base;
                        
                    } else {
                        
                        $thumbnail = FRONT_IMAGES_URL.'template2.gif';
                        
                    }
                    ?>
        <a href="<?php echo $secondBanner->url ?>" class="apple2" target="_blank"><img src="<?php echo $thumbnail ?>" alt="commercial" class="img-fluid"></a>
        <?php
            }
            
            }
            
            ?>
    </div>
</div>
<!--  End of section  -->
<section id="topic2">
    <h4 class="section-headers">
        <a href="#">
        रिपोर्ट
        </a>
    </h4>
    <div id="myCarousel-two" class="carousel slide marginforheader" data-interval="false">
        <?php
            $test = $news->getNewsByCatId(13, 7);
            
            ?>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php 
                if($test){
                    $i = 0;
                    foreach($test as $list){
                        $act = explode(' ', html_entity_decode($list->title));
                        $act = implode('-', $act);
                        
                        if ($i == 0) {
                            $class = "active";
                        } else {
                            $class = "";
                        }
                        $i++;
                        ?>
            <div class="carousel-item <?php echo $class ?>">
                <?php 
                    $image = basename($list->image);
                        if(isset($list->image) && !empty($list->image) && file_exists(UPLOAD_DIR.'news/'.$image)) {
                           $thumbnail = UPLOAD_URL.'news/'.$image; 
                        } else {
                            $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                        }
                    ?>
                <img src="<?php echo $thumbnail ?>" alt="image">
                <div class="carousel-caption">
                    <h5 class="h5type-report">
                    <a href="/<?php echo $list->id;?>/<?php echo $act ?>"><?php echo $list->title ?></a></h4>
                    <a href="/<?php echo $list->id;?>/<?php echo $act ?>">
                        <p>
                            <?php 
                                $summary = $list->summary;
                                
                                $summary = strip_tags($summary);
                                
                                echo html_entity_decode($summary) ?>
                        </p>
                    </a>
                </div>
            </div>
            <!-- End Item -->
            <?php
                }
                }
                ?>
        </div>
        <!-- End Carousel Inner -->
        <ul class="list-group col-sm-4">
            <?php 
                if($test){
                    $i = 0;
                    foreach($test as $value){
                        $act = explode(' ', html_entity_decode($value->title));
                        $act = implode('-', $act);
                        ?>
            <li data-target="#myCarousel-two" data-slide-to="<?php echo $i ?>" class="list-group-item spacings">
                <h5 class="h5type-report"><a href="/<?php echo $value->id;?>/<?php echo $act ?>"><?php echo html_entity_decode($value->title) ?></a></h5>
            </li>
            <?php
                $i++;
                }
                }
                ?>
        </ul>
        <!-- Controls -->
        <div class="controls-report">
            <a class="carousel-control-prev" href="#myCarousel-two" data-slide="prev">
            <span class="carousel-control-left"><i class="fas fa-arrow-alt-circle-left" style="color:#1E695E"></i></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel-two" data-slide="next">
            <span class="carousel-control-right"><i class="fas fa-arrow-alt-circle-right" style="color: #1E695E"></i></span>
            </a>
        </div>
    </div>
    <!-- End Carousel -->
</section>
<div class="ad2 padding-for-top">
    <?php 
        $bannerThird = $ads->getLongAdsThird(1);
        
        if($bannerThird){
            
            foreach($bannerThird as $thirdBanner){
                
                $base = basename($thirdBanner->image);
            
                if(isset($thirdBanner->image) && !empty($thirdBanner->image) && file_exists(UPLOAD_DIR.'ads/'.$base)){
                    
                    $thumbnail = UPLOAD_URL.'ads/'.$base;
                    
                } else {
                    
                    $thumbnail = FRONT_IMAGES_URL.'template2.gif';
                    
                }
                ?>
    <a href="<?php echo $thirdBanner->url ?>" class="apple2" target="_blank"><img src="<?php echo $thumbnail ?>" alt="commercial" class="img-fluid" style="width:100%"></a>
    <?php
        }
        
        }
        
        ?>
</div>
<!--   End of section  -->
<section id="topic3">
    <div class="row pt-3">
        <div class=" col-md-12">
            <div class="your-class">
                <?php 
                    $manKaaKura = $news->getNewsByCatId(8, 3);
                    ?>
                <div class="card hover-effect" style="width:100%;">
                        <h5 class="section-headers">विविध</h5>
                    <div class="card-body">
                        <?php 
                            if($manKaaKura){
                                $i = 0;
                                foreach($manKaaKura as $kura){
                                    if($i == 0){
                                        
                                        $act = explode(' ', html_entity_decode($kura->title));
                                    
                                        $act = implode('-', $act);
                                        
                                        $categoryAct = explode(' ', html_entity_decode($kura->news_category));
                                        
                                        $categoryAct = implode('-', $categoryAct);
                                    
                                        $image = basename($kura->image);
                                    
                                        if(!empty($kura->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
                            
                                            $thumbnail = UPLOAD_URL.'news/'.$image;
                            
                                        } else {
                                            $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                                        }
                                        ?>
                        <img class="card-img-top img-fluid" src="<?php echo $thumbnail ?>" alt="Card image cap">
                        <div class="text-card">
                            <a href="/<?php echo $kura->id ?>/<?php echo $act ?>">
                                <p class="card-text titletype2"><?php echo $kura->title ?></p>
                            </a>
                            <p><?php echo html_entity_decode($kura->summary) ?></p>
                            <?php
                                }
                                
                                if($i !== 0){
                                    $act = explode(' ', html_entity_decode($kura->title));
                                
                                    $act = implode('-', $act);
                                    ?>
                            <hr class="hrstyle1">
                            <a href="/<?php echo $kura->id ?>/<?php echo $act ?>">
                                <p class="card-text titletype2"><?php echo $kura->title ?></p>
                            </a>
                            <?php
                                }
                                ?>
                            <?php
                                $i++;
                                }
                                }
                                
                                ?>
                            <a href="/category/<?php echo $kura->category_id ?>/<?php echo $categoryAct ?>">
                                <p class="list-group-item  more titletype2">
                                    अन्य विषय
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <?php 
                    $kakshya = $news->getNewsByCatId(5, 3);
                    ?>
                <div class="card hover-effect" style="width:100%;">
                        <h5 class="section-headers">कक्षाकोठा</h5>
                    <div class="card-body">
                        <?php 
                            if($kakshya){
                                $i = 0;
                                foreach($kakshya as $kotha){
                                    if($i == 0){
                                        
                                        $act = explode(' ', html_entity_decode($kotha->title));
                                    
                                        $act = implode('-', $act);
                                        
                                        $categoryAct = explode(' ', html_entity_decode($kotha->news_category));
                                        
                                        $categoryAct = implode('-', $categoryAct);
                                    
                                        $image = basename($kotha->image);
                                    
                                        if(!empty($kotha->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
                            
                                            $thumbnail = UPLOAD_URL.'news/'.$image;
                            
                                        } else {
                                            $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                                        }
                                        ?>
                        <img class="card-img-top img-fluid" src="<?php echo $thumbnail ?>" alt="Card image cap">
                        <div class="text-card">
                            <a href="/<?php echo $kotha->id ?>/<?php echo $act ?>">
                                <p class="card-text titletype2"><?php echo $kotha->title ?></p>
                            </a>
                            <p><?php echo html_entity_decode($kotha->summary) ?></p>
                            <?php
                                }
                                
                                if($i !== 0){
                                    $act = explode(' ', html_entity_decode($kotha->title));
                                
                                    $act = implode('-', $act);
                                    ?>
                            <hr class="hrstyle1">
                            <a href="/<?php echo $kotha->id ?>/<?php echo $act ?>">
                                <p class="card-text titletype2"><?php echo $kotha->title ?></p>
                            </a>
                            <?php
                                }
                                ?>
                            <?php
                                $i++;
                                }
                                }
                                
                                ?>
                            <a href="/category/<?php echo $kotha->category_id ?>/<?php echo $categoryAct ?>">
                                <p class="list-group-item  more titletype2">
                                    अन्य विषय
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <?php 
                    $herai = $news->getNewsByCatId(12, 3);
                    ?>
                <div class="card hover-effect" style="width:100%;">
                    <a href="#">
                        <h5 class="section-headers">हेराइ र बुझाइ</h5>
                    </a>
                    <div class="card-body">
                        <?php 
                            if($herai){
                                $i = 0;
                                foreach($herai as $bujhai){
                                    if($i == 0){
                                        
                                        $act = explode(' ', html_entity_decode($bujhai->title));
                                    
                                        $act = implode('-', $act);
                                        
                                        $categoryAct = explode(' ', html_entity_decode($bujhai->news_category));
                                        
                                        $categoryAct = implode('-', $categoryAct);
                                    
                                        $image = basename($bujhai->image);
                                    
                                        if(!empty($bujhai->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
                            
                                            $thumbnail = UPLOAD_URL.'news/'.$image;
                            
                                        } else {
                                            $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                                        }
                                        ?>
                        <img class="card-img-top img-fluid" src="<?php echo $thumbnail ?>" alt="Card image cap">
                        <div class="text-card">
                            <a href="/<?php echo $bujhai->id ?>/<?php echo $act ?>">
                                <p class="card-text titletype2"><?php echo $bujhai->title ?></p>
                            </a>
                            <p><?php echo html_entity_decode($bujhai->summary) ;?></p>
                            <?php
                                }
                                
                                if($i !== 0){
                                    $act = explode(' ', html_entity_decode($bujhai->title));
                                
                                    $act = implode('-', $act);
                                    ?>
                            <hr class="hrstyle1">
                            <a href="/<?php echo $bujhai->id ?>/<?php echo $act ?>">
                                <p class="card-text titletype2"><?php echo $bujhai->title ?></p>
                            </a>
                            <?php
                                }
                                ?>
                            <?php
                                $i++;
                                }
                                }
                                
                                ?>
                            <a href="/category/<?php echo $bujhai->category_id ?>/<?php echo $categoryAct ?>">
                                <p class="list-group-item  more titletype2">
                                    अन्य विषय
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <?php 
                    $bahas = $news->getNewsByCatId(28, 3);
                    ?>
                <div class="card hover-effect" style="width:100%;">
                        <h5 class="section-headers">बहस/अन्तरक्रिया</h5>
                    <div class="card-body">
                        <?php 
                            if($bahas){
                                $i = 0;
                                foreach($bahas as $antarkiya){
                                    if($i == 0){
                                        
                                        $act = explode(' ', html_entity_decode($antarkiya->title));
                                    
                                        $act = implode('-', $act);
                                        
                                        $categoryAct = explode(' ', html_entity_decode($antarkiya->news_category));
                                        
                                        $categoryAct = implode('-', $categoryAct);
                                    
                                        $image = basename($antarkiya->image);
                                    
                                        if(!empty($antarkiya->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
                            
                                            $thumbnail = UPLOAD_URL.'news/'.$image;
                            
                                        } else {
                                            $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                                        }
                                        ?>
                        <img class="card-img-top img-fluid" src="<?php echo $thumbnail ?>" alt="Card image cap">
                        <div class="text-card">
                            <a href="/<?php echo $antarkiya->id ?>/<?php echo $act ?>">
                                <p class="card-text titletype2"><?php echo $antarkiya->title ?></p>
                            </a>
                            <p><?php echo html_entity_decode($antarkiya->summary) ?></p>
                            <?php
                                }
                                
                                if($i !== 0){
                                    $act = explode(' ', html_entity_decode($antarkiya->title));
                                
                                    $act = implode('-', $act);
                                    ?>
                            <hr class="hrstyle1">
                            <a href="/<?php echo $antarkiya->id ?>/<?php echo $act ?>">
                                <p class="card-text titletype2"><?php echo $antarkiya->title ?></p>
                            </a>
                            <?php
                                }
                                ?>
                            <?php
                                $i++;
                                }
                                }
                                
                                ?>
                            <a href="/category/<?php echo $antarkiya->category_id ?>/<?php echo $categoryAct ?>">
                                <p class="list-group-item  more titletype2">
                                    अन्य विषय
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <?php 
                    $bahas = $news->getNewsByCatId(10, 3);
                    ?>
                <div class="card hover-effect" style="width:100%;">
                        <h5 class="section-headers">स्थलगत</h5>
                    <div class="card-body">
                        <?php 
                            if($bahas){
                                $i = 0;
                                foreach($bahas as $antarkiya){
                                    if($i == 0){
                                        
                                        $act = explode(' ', html_entity_decode($antarkiya->title));
                                    
                                        $act = implode('-', $act);
                                        
                                        $categoryAct = explode(' ', html_entity_decode($antarkiya->news_category));
                                        
                                        $categoryAct = implode('-', $categoryAct);
                                    
                                        $image = basename($antarkiya->image);
                                    
                                        if(!empty($antarkiya->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
                            
                                            $thumbnail = UPLOAD_URL.'news/'.$image;
                            
                                        } else {
                                            $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                                        }
                                        ?>
                        <img class="card-img-top img-fluid" src="<?php echo $thumbnail ?>" alt="Card image cap">
                        <div class="text-card">
                            <a href="/<?php echo $antarkiya->id ?>/<?php echo $act ?>">
                                <p class="card-text titletype2"><?php echo $antarkiya->title ?></p>
                            </a>
                            <p><?php echo html_entity_decode($antarkiya->summary) ?></p>
                            <?php
                                }
                                
                                if($i !== 0){
                                    $act = explode(' ', html_entity_decode($antarkiya->title));
                                
                                    $act = implode('-', $act);
                                    ?>
                            <hr class="hrstyle1">
                            <a href="/<?php echo $antarkiya->id ?>/<?php echo $act ?>">
                                <p class="card-text titletype2"><?php echo $antarkiya->title ?></p>
                            </a>
                            <?php
                                }
                                ?>
                            <?php
                                $i++;
                                }
                                }
                                
                                ?>
                            <a href="/category/<?php echo $antarkiya->category_id ?>/<?php echo $categoryAct ?> ">
                                <p class="list-group-item  more titletype2">
                                    अन्य विषय
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <?php 
                    $bahas = $news->getNewsByCatId(7, 3);
                    
                    ?>
                <div class="card hover-effect" style="width:100%;">
                        <h5 class="section-headers">नेपाल अध्ययन</h5>
                    <div class="card-body">
                        <?php 
                            if($bahas){
                                $i = 0;
                                foreach($bahas as $antarkiya){
                                    if($i == 0){
                                        
                                        $act = explode(' ', html_entity_decode($antarkiya->title));
                                    
                                        $act = implode('-', $act);
                                        
                                        $categoryAct = explode(' ', html_entity_decode($antarkiya->news_category));
                                        
                                        $categoryAct = implode('-', $categoryAct);
                                    
                                        $image = basename($antarkiya->image);
                                    
                                        if(!empty($antarkiya->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
                            
                                            $thumbnail = UPLOAD_URL.'news/'.$image;
                            
                                        } else {
                                            $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                                        }
                                        ?>
                        <img class="card-img-top img-fluid" src="<?php echo $thumbnail ?>" alt="Card image cap">
                        <div class="text-card">
                            <a href="/<?php echo $antarkiya->id ?>/<?php echo $act ?>">
                                <p class="card-text titletype2"><?php echo $antarkiya->title ?></p>
                            </a>
                            <p><?php echo html_entity_decode($antarkiya->summary) ?></p>
                            <?php
                                }
                                
                                if($i !== 0){
                                    $act = explode(' ', html_entity_decode($antarkiya->title));
                                
                                    $act = implode('-', $act);
                                    ?>
                            <hr class="hrstyle1">
                            <a href="/<?php echo $antarkiya->id ?>/<?php echo $act ?>">
                                <p class="card-text titletype2"><?php echo $antarkiya->title ?></p>
                            </a>
                            <?php
                                }
                                ?>
                            <?php
                                $i++;
                                }
                                }
                                
                                ?>
                            <a href="/category/<?php echo $antarkiya->category_id ?>/<?php echo $categoryAct ?>">
                                <p class="list-group-item  more titletype2">
                                    अन्य विषय
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<div class="ad3 py-md-2">
<?php 
    $bannerFourth = $ads->getLongAdsFourth(1);
    
    if($bannerFourth){
        
        foreach($bannerFourth as $fourthBanner){
            
            $base = basename($fourthBanner->image);
        
            if(!empty($fourthBanner->image) && !empty($fourthBanner->image) && file_exists(UPLOAD_DIR.'ads/'.$base)){
                
                $thumbnail = UPLOAD_URL.'ads/'.$base;
                
            } else {
                
                $thumbnail = FRONT_IMAGES_URL.'template2.gif';
                
            }
            ?>
<a href="<?php echo $fourthBanner->url ?>" class="apple2" target="_blank"><img src="<?php echo $thumbnail ?>" alt="commercial" class="img-fluid"></a>
<?php
    }
    
    }
    
    ?>
</div>
<section id="topic7">
<div class="row pt-3">
<div class=" col-md-12">
<div class="your-class">
<?php 
    $data = $news->getNewsByCatId(26, 3);
    ?>
<div class="card hover-effect" style="width:100%;">
<h5 class="section-headers">आलोपालो</h5>
<div class="card-body">
<?php 
    if($data){
        $i = 0;
        foreach($data as $datas){
            if($i == 0){
                
                $act = explode(' ', html_entity_decode($datas->title));
            
                $act = implode('-', $act);
                
                $categoryAct = explode(' ', html_entity_decode($datas->news_category));
                
                $categoryAct = implode('-', $categoryAct);
            
                $image = basename($datas->image);
            
                if(!empty($datas->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
    
                    $thumbnail = UPLOAD_URL.'news/'.$image;
    
                } else {
                    $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                }
                ?>
<img class="card-img-top img-fluid" src="<?php echo $thumbnail ?>" alt="Card image cap">
<div class="text-card">
<a href="/<?php echo $datas->id ?>/<?php echo $act ?>">
<p class="card-text titletype2"><?php echo $datas->title ?></p>
</a>
<p><?php echo html_entity_decode($datas->summary) ?></p>
<?php
    }
    
    if($i !== 0){
        $act = explode(' ', html_entity_decode($datas->title));
    
        $act = implode('-', $act);
        ?>
<hr class="hrstyle1">
<a href="/<?php echo $datas->id ?>/<?php echo $act ?>">
<p class="card-text titletype2"><?php echo $datas->title ?></p>
</a>
<?php
    }
    ?>
<?php
    $i++;
    }
    }
    
    ?>
<a href="/category/<?php echo $datas->category_id ?>/<?php echo $categoryAct ?>">
<p class="list-group-item  more titletype2">
अन्य विषय</p>
</a>
</div>
</div>
</div>
<?php 
    $data = $news->getNewsByCatId(9, 3);
    ?>
<div class="card hover-effect" style="width:100%;">
<h5 class="section-headers">रेडियो</h5>
<div class="card-body">
<?php 
    if($data){
        $i = 0;
        foreach($data as $datas){
            if($i == 0){
                
                $act = explode(' ', html_entity_decode($datas->title));
            
                $act = implode('-', $act);
                
                $categoryAct = explode(' ', html_entity_decode($datas->news_category));
                
                $categoryAct = implode('-', $categoryAct);
            
                $image = basename($datas->image);
            
                if(!empty($datas->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
    
                    $thumbnail = UPLOAD_URL.'news/'.$image;
    
                } else {
                    $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                }
                ?>
<img class="card-img-top img-fluid" src="<?php echo $thumbnail ?>" alt="Card image cap">
<div class="text-card">
<a href="podcast/<?php echo $datas->id ?>/<?php echo $act ?>">
<p class="card-text titletype2"><?php echo $datas->title ?></p>
</a>
<p><?php echo html_entity_decode($datas->summary) ?></p>
<?php
    }
    
    if($i !== 0){
        $act = explode(' ', html_entity_decode($datas->title));
    
        $act = implode('-', $act);
        ?>
<hr class="hrstyle1">
<a href="podcast/<?php echo $datas->id ?>/<?php echo $act ?>">
<p class="card-text titletype2"><?php echo $datas->title ?></p>
</a>
<?php
    }
    ?>
<?php
    $i++;
    }
    }
    
    ?>
<a href="/category/<?php echo $datas->category_id ?>/<?php echo $categoryAct ?>">
<p class="list-group-item  more titletype2">
अन्य विषय</p>
</a>
</div>
</div>
</div>
<?php 
    $data = $news->getNewsByCatId(11, 3);
    ?>
<div class="card hover-effect" style="width:100%;">
<h5 class="section-headers">विश्लेषण</h5>
<div class="card-body">
<?php 
    if($data){
        $i = 0;
        foreach($data as $datas){
            if($i == 0){
                
                $act = explode(' ', html_entity_decode($datas->title));
            
                $act = implode('-', $act);
                
                $categoryAct = explode(' ', html_entity_decode($datas->news_category));
                
                $categoryAct = implode('-', $categoryAct);
            
                $image = basename($datas->image);
            
                if(!empty($datas->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
    
                    $thumbnail = UPLOAD_URL.'news/'.$image;
    
                } else {
                    $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                }
                ?>
<img class="card-img-top img-fluid" src="<?php echo $thumbnail ?>" alt="Card image cap">
<div class="text-card">
<a href="/<?php echo $datas->id ?>/<?php echo $act ?>">
<p class="card-text titletype2"><?php echo $datas->title ?></p>
</a>
<p><?php echo html_entity_decode($datas->summary) ?></p>
<?php
    }
    
    if($i !== 0){
        $act = explode(' ', html_entity_decode($datas->title));
    
        $act = implode('-', $act);
        ?>
<hr class="hrstyle1">
<a href="/<?php echo $datas->id ?>/<?php echo $act ?>">
<p class="card-text titletype2"><?php echo $datas->title ?></p>
</a>
<?php
    }
    ?>
<?php
    $i++;
    }
    }
    
    ?>
<a href="/category/<?php echo $datas->category_id ?>/<?php echo $categoryAct ?>">
<p class="list-group-item  more titletype2">
अन्य विषय</p>
</a>
</div>
</div>
</div>
<?php 
    $data = $podcast->getPodcastByCategoryId(15, 3);
    
    ?>
<div class="card hover-effect" style="width:100%;">
<h5 class="section-headers">शिक्षक संवाद</h5>
<div class="card-body">
<?php 
    if($data){
        $i = 0;
        foreach($data as $datas){
            if($i == 0){
                
                $act = explode(' ', html_entity_decode($datas->title));
            
                $act = implode('-', $act);
                
                $categoryAct = explode(' ', html_entity_decode($datas->category_title));
                
                $categoryAct = implode('-', $categoryAct);
            
                $image = basename($datas->image);
            
                if(!empty($datas->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
    
                    $thumbnail = UPLOAD_URL.'news/'.$image;
    
                } else {
                    $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                }
                ?>
<img class="card-img-top img-fluid" src="<?php echo $thumbnail ?>" alt="Card image cap">
<div class="text-card">
<a href="podcast/<?php echo $datas->id ?>/<?php echo $act ?>">
<p class="card-text titletype2"><?php echo $datas->title ?></p>
</a>
<p><?php echo html_entity_decode($datas->summary) ;?></p>
<?php
    }
    
    if($i !== 0){
        $act = explode(' ', html_entity_decode($datas->title));
    
        $act = implode('-', $act);
        ?>
<hr class="hrstyle1">
<a href="podcast/<?php echo $datas->id ?>/<?php echo $act ?>">
<p class="card-text titletype2"><?php echo $datas->title ?></p>
</a>
<?php
    }
    ?>
<?php
    $i++;
    }
    }
    
    ?>
<a href="/category/<?php echo $datas->category ?>/<?php echo $categoryAct ?>">
<p class="list-group-item  more titletype2">
अन्य विषय</p>
</a>
</div>
</div>
</div>
<?php 
    $data = $news->getNewsByCatId(6, 3);
    ?>
<div class="card hover-effect" style="width:100%;">
<h5 class="section-headers">जिज्ञासा जवाफ</h5>
<div class="card-body">
<?php 
    if($data){
        $i = 0;
        foreach($data as $datas){
            if($i == 0){
                
                $act = explode(' ', html_entity_decode($datas->title));
            
                $act = implode('-', $act);
                
                $categoryAct = explode(' ', html_entity_decode($datas->news_category));
                
                $categoryAct = implode('-', $categoryAct);
            
                $image = basename($datas->image);
            
                if(!empty($datas->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
    
                    $thumbnail = UPLOAD_URL.'news/'.$image;
    
                } else {
                    $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                }
                ?>
<img class="card-img-top img-fluid" src="<?php echo $thumbnail ?>" alt="Card image cap">
<div class="text-card">
<a href="/<?php echo $datas->id ?>/<?php echo $act ?>">
<p class="card-text titletype2"><?php echo $datas->title ?></p>
</a>
<p><?php echo html_entity_decode($datas->summary) ;?></p>
<?php
    }
    
    if($i !== 0){
        $act = explode(' ', html_entity_decode($datas->title));
    
        $act = implode('-', $act);
        ?>
<hr class="hrstyle1">
<a href="/<?php echo $datas->id ?>/<?php echo $act ?>">
<p class="card-text titletype2"><?php echo $datas->title ?></p>
</a>
<?php
    }
    ?>
<?php
    $i++;
    }
    }
    
    ?>
<a href="/category/<?php echo $datas->category_id ?>/<?php echo $categoryAct ?>">
<p class="list-group-item  more titletype2">
अन्य विषय</p>
</a>
</div>
</div>
</div>
<?php 
    $data = $news->getNewsByCatId(13, 3);
    ?>
<div class="card hover-effect" style="width:100%;">
<h5 class="section-headers">रिपोर्ट</h5>
<div class="card-body">
<?php 
    if($data){
        $i = 0;
        foreach($data as $datas){
            if($i == 0){
                
                $act = explode(' ', html_entity_decode($datas->title));
            
                $act = implode('-', $act);
                
                $categoryAct = explode(' ', html_entity_decode($datas->news_category));
                
                $categoryAct = implode('-', $categoryAct);
            
                $image = basename($datas->image);
            
                if(!empty($datas->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
    
                    $thumbnail = UPLOAD_URL.'news/'.$image;
    
                } else {
                    $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                }
                ?>
<img class="card-img-top img-fluid" src="<?php echo $thumbnail ?>" alt="Card image cap">
<div class="text-card">
<a href="/<?php echo $datas->id ?>/<?php echo $act ?>">
<p class="card-text titletype2"><?php echo $datas->title ?></p>
</a>
<p><?php echo html_entity_decode($datas->summary) ;?></p>
<?php
    }
    
    if($i !== 0){
        $act = explode(' ', html_entity_decode($datas->title));
    
        $act = implode('-', $act);
        ?>
<hr class="hrstyle1">
<a href="/<?php echo $datas->id ?>/<?php echo $act ?>">
<p class="card-text titletype2"><?php echo $datas->title ?></p>
</a>
<?php
    }
    ?>
<?php
    $i++;
    }
    }
    
    ?>
<a href="/category/<?php echo $datas->category_id ?>/<?php echo $categoryAct ?>">
<p class="list-group-item  more titletype2">
अन्य विषय</p>
</a>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
<!-- End of section  -->
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>