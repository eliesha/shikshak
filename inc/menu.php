<?php
    require CLASS_PATH.'book.php';
    
    require CLASS_PATH.'series.php';
    
    require CLASS_PATH.'podcast.php';
    
    $book = new Book();
    
    $series = new Series();
    
    $podcast = new Podcast;
    
    ?> 
<!-- Mega-Menu -->
<nav class="navbar navbar-expand-lg navbar-dark  bg-primary sticky-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!-- Griha Pristha -->
            <li class="nav-item">
                <a class="nav-link" href="/">गृह पृष्ठ</a>
            </li>
            <!--Hamro Bare-->
            <li class="nav-item">
                <a class="nav-link" href="/about">हाम्रा बारे</a>
            </li>
            <!-- Anya-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown8" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                स्तम्भ
                </a>
                <div class="dropdown-menu" aria-label="navbarDropdown8">
                    <div class="container megastyle4">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="boldtitle" href="/category/26/आलोपालो">
                                            <h4 style="text-decoration: underline" class="h4type-report boldtitle pstyle3">आलोपालो</h4>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <?php 
                                                    $data = $news->getNavInfo(26,1);
                                                    $basename = basename($data[0]->cat_image);
                                                    if(!empty($data[0]->cat_image) && file_exists(UPLOAD_DIR.'category/'.$basename)){
                                                     $image = UPLOAD_URL.'category/'.$basename;   
                                                    }
                                                $act = explode(' ', html_entity_decode($data[0]->title));
                                $act = implode('-', $act);
                                                    ?>
                                                        <img src="<?php echo $image ?>" class="image-fluid" alt="thumbnail-image">
                                                    </div>
                                                    <div class="col-7">
                                                        <a href="/<?php echo $data[0]->id ?>/<?php echo $act ?>"><p class="pstyle2 "><?php echo $data[0]->title ?></p></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="boldtitle" href="category/1/विषय-सन्दर्भ">
                                            <h4 style="text-decoration: underline" class="h4type-report boldtitle pstyle3">छलफल</h4>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <?php 
                                                    $data = $news->getNavInfo(36,1);
                                                    $basename = $data[0]->image;
                                                    if(!empty($data[0]->image) && file_exists(UPLOAD_DIR.'category'.$basename)){
                                                     $image = UPLOAD_URL.'category/'.$basename;   
                                                    }
                                                $act = explode(' ', html_entity_decode($data[0]->title));
                                $act = implode('-', $act);
                                                    ?>
                                                        <img src="<?php echo $image ?>" class="image-fluid" alt="thumbnail-image">
                                                    </div>
                                                    <div class="col-7">
                                                        <a href="/<?php echo $data[0]->id ?>/<?php echo $act ?>"><p class="pstyle2 "><?php echo $data[0]->title ?></p></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" boldtitle" href="/category/14/मनका-कुरा">
                                            <h4 style="text-decoration: underline" class="h4type-report boldtitle pstyle3">मनका कुरा</h4>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <?php 
                                            $data = $news->getNavInfo(14,1);
                                            $basename = $data[0]->image;
                                                    if(!empty($data[0]->image) && file_exists(UPLOAD_DIR.'category'.$basename)){
                                                     $image = UPLOAD_URL.'category/'.$basename;   
                                                    }
                                                $act = explode(' ', html_entity_decode($data[0]->title));
                                $act = implode('-', $act);
                                                    ?>
                                                        <img src="<?php echo $image ?>" class="image-fluid" alt="thumbnail-image">
                                                    </div>
                                                    <div class="col-7">
                                                        <a href="/<?php echo $data[0]->id ?>/<?php echo $act ?>"><p class="pstyle2 ">
                                                        <?php echo $data[0]->title ?></p></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="row">
                                    <ul class="nav flex-column spacing-menu">
                                        <li class="nav-item">
                                            <a class=" boldtitle" href="/category/5/कक्षाकोठा">
                                                <h4 style="text-decoration: underline" class="h4type-report boldtitle pstyle3">कक्षाकोठा</h4>
                                            </a>
                                        </li>
                                            <?php 
                                            $data = $news->getNavInfo(5,2);
                                            if($data){
                                                foreach($data as $list){
                                                   $act = explode(' ', html_entity_decode($list->title));
                                $act = implode('-', $act); 
                                ?>
                                <li class="nav-item">
                                            <p class="pstyle2"><a class=" active" href="/<?php echo $list->id?>/<?php echo $act ?>"><?php echo $list->title ?></a></p>
                                        </li>
                                <?php
                                                }
                                            }
                                            
                                                    ?>
                                        
                                    </ul>
                                </div>
                                <div class="row">
                                    <ul class="nav flex-column spacing-menu">
                                        <li class="nav-item">
                                            <a class=" boldtitle" href="/category/6/जिज्ञासा-जवाफ">
                                                <h4 style="text-decoration: underline" class="h4type-report boldtitle pstyle3">जिज्ञासा
                                                    जवाफ
                                                </h4>
                                            </a>
                                        </li>
                                        <?php 
                                            $data = $news->getNavInfo(6,2);
                                            if($data){
                                                foreach($data as $list){
                                                   $act = explode(' ', html_entity_decode($list->title));
                                $act = implode('-', $act); 
                                ?>
                                <li class="nav-item">
                                            <p class="pstyle2"><a class=" active" href="/<?php echo $list->id?>/<?php echo $act ?>"><?php echo $list->title ?></a></p>
                                        </li>
                                <?php
                                                }
                                            }
                                            
                                                    ?>
                                    </ul>
                                </div>
                                <div class="row">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class=" boldtitle" href="/category/7/नेपाल-अध्ययन">
                                                <h4 style="text-decoration: underline" class="h4type-report boldtitle pstyle3">नेपाल–अध्ययन</h4>
                                            </a>
                                        </li>
                                        <?php 
                                            $data = $news->getNavInfo(7,4);
                                            if($data){
                                                foreach($data as $list){
                                                   $act = explode(' ', html_entity_decode($list->title));
                                $act = implode('-', $act); 
                                ?>
                                <li class="nav-item">
                                            <p class="pstyle2"><a class=" active" href="/<?php echo $list->id?>/<?php echo $act ?>"><?php echo $list->title ?></a></p>
                                        </li>
                                <?php
                                                }
                                            }
                                            
                                                    ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class=" boldtitle" href="/category/11/विश्लेषण">
                                            <h4 style="text-decoration: underline" class="h4type-report boldtitle pstyle3">विश्लेषण</h4>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <?php 
                                                    $data = $news->getNavInfo(11,1);
                                                    $basename = $data[0]->image;
                                                    if(!empty($data[0]->image) && file_exists(UPLOAD_DIR.'category'.$basename)){
                                                     $image = UPLOAD_URL.'category/'.$basename;   
                                                    }
                                                $act = explode(' ', html_entity_decode($data[0]->title));
                                $act = implode('-', $act);
                                                    ?>
                                                        <img src="<?php echo $image ?>" class="image-fluid" alt="thumbnail-image">
                                                    </div>
                                                    <div class="col-7">
                                                        <a href="/<?php echo $data[0]->id ?>/<?php echo $act ?>"><p class="pstyle2 "><?php echo $data[0]->title ?></p></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" boldtitle" href="/category/12/हेराइ-र-बुझाइ">
                                            <h4 style="text-decoration: underline" class="h4type-report boldtitle pstyle3">हेराइ र बुझाइ</h4>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <?php 
                                                    $data = $news->getNavInfo(12,1);
                                                    $basename = $data[0]->image;
                                                    if(!empty($data[0]->image) && file_exists(UPLOAD_DIR.'category'.$basename)){
                                                     $image = UPLOAD_URL.'category/'.$basename;   
                                                    }
                                                $act = explode(' ', html_entity_decode($data[0]->title));
                                $act = implode('-', $act);
                                                    ?>
                                                        <img src="<?php echo $image ?>" class="image-fluid" alt="thumbnail-image">
                                                    </div>
                                                    <div class="col-7">
                                                        <a href="/<?php echo $data[0]->id ?>/<?php echo $act ?>"><p class="pstyle2 "><?php echo $data[0]->title ?></p></a>
                                                </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class=" boldtitle" href="/category/9/रेडियो">
                                            <h4 style="text-decoration: underline" class="h4type-report boldtitle pstyle3">रेडियो</h4>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            <?php 
                                            $data = $podcast->getPodcastForNav(3);
                                            if($data){
                                                foreach($data as $list){
                                                   $act = explode(' ', html_entity_decode($list->title));
                                $act = implode('-', $act); 
                                ?>
                                <li class="nav-item">
                                            <p class="pstyle2"><a class=" active" href="/podcast/<?php echo $list->id?>/<?php echo $act ?>"><?php echo $list->title ?></a></p>
                                        </li>
                                <?php
                                                }
                                            }
                                            
                                                    ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class=" boldtitle" href="/category/13/रिपोर्ट">
                                            <h4 style="text-decoration: underline" class="h4type-report boldtitle pstyle3">रिपोर्ट</h4>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <?php 
                                                    $data = $news->getNavInfo(13,1);
                                                    $basename = $data[0]->image;
                                                    if(!empty($data[0]->image) && file_exists(UPLOAD_DIR.'category'.$basename)){
                                                     $image = UPLOAD_URL.'category/'.$basename;   
                                                    }
                                                $act = explode(' ', html_entity_decode($data[0]->title));
                                $act = implode('-', $act);
                                                    ?>
                                                        <img src="<?php echo $image ?>" class="image-fluid" alt="thumbnail-image">
                                                    </div>
                                                    <div class="col-7">
                                                        <a href="/<?php echo $data[0]->id ?>/<?php echo $act ?>"><p class="pstyle2 "><?php echo $data[0]->title ?></p></a>
                                                </div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="boldtitle" href="/category/10/स्थलगत">
                                                    <h4 style="text-decoration: underline" class="h4type-report boldtitle pstyle3">स्थलगत</h4>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <?php 
                                                    $data = $news->getNavInfo(10,1);
                                                $basename = $data[0]->image;
                                                    if(!empty($data[0]->image) && file_exists(UPLOAD_DIR.'category'.$basename)){
                                                     $image = UPLOAD_URL.'category/'.$basename;   
                                                    }  
                                                $act = explode(' ', html_entity_decode($data[0]->title));
                                $act = implode('-', $act);
                                                    ?>
                                                                <img src="<?php echo $image ?>" class="image-fluid"
                                                                    alt="thumbnail-image">
                                                            </div>
                                                    <div class="col-7">
                                                        <a href="/<?php echo $data[0]->id ?>/<?php echo $act ?>"><p class="pstyle2 "><?php echo $data[0]->title ?></p></a>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class=" boldtitle" href="http://oxygenaltitude.com/category/35/समाचार">
                                                            <h4 style="text-decoration: underline" class="h4type-report boldtitle pstyle3">समाचार</h4>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <?php 
                                                    $data = $news->getNavInfo(35,3);
                                                    $basename = $data[0]->image;
                                                    if(!empty($data[0]->image) && file_exists(UPLOAD_DIR.'category'.$basename)){
                                                     $image = UPLOAD_URL.'category/'.$basename;   
                                                    } 
                                                $act = explode(' ', html_entity_decode($data[0]->title));
                                $act = implode('-', $act);
                                                    ?>
                                                                <img src="<?php echo $image ?>" class="image-fluid"
                                                                    alt="thumbnail-image">
                                                            </div>
                                                    <div class="col-7">
                                                        <a href="/<?php echo $data[0]->id ?>/<?php echo $act ?>"><p class="pstyle2 "><?php echo $data[0]->title ?></p></a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <!-- Archive-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown11" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                शिक्षकका पुराना अंक
                </a>
                <div class="dropdown-menu" aria-label="navbarDropdown5">
                    <div class="container megastyle3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 style="margin-bottom: 0px;" class="h5type-report boldtitle"><span id="currentYear"></span> सालका अंकहरु <i class="fas fa-arrow-down"></i></h4>
                            </div>
                            <div class="col-md-6 text-md-right more5">
                                <a class="boldtitle" href="/archive.php">
                                    <h4 style="text-decoration: underline;margin-bottom: 0px;" class="h5type-report boldtitle">अझ पुराना अंक <i class="fas fa-arrow-right"></i>
                                    </h4>
                                </a>
                            </div>
                        </div>
                        <div class="row pl-4 pt-1">
                            <?php
                                $seriesList = $series->getSeriesForNav(12);
                                
                                if($seriesList){
                                    foreach($seriesList as $list){
                                        
                                        $act = explode(' ', html_entity_decode($list->month));
                                        
                                        $act = implode('-', $act);
                                       
                                       $act = explode('|', html_entity_decode($act));
                                       $act = implode('शिक्षक', $act);
                                       
                                        $added_date = strtotime($list->added_date);
                                        
                                        $added_date = date('Y-m-01', $added_date);
                                        
                                        $image = basename($list->image);
                                        
                                        if(isset($list->image) && file_exists(UPLOAD_DIR.'series/'.$image)){
                                            
                                            $thumbnail = UPLOAD_URL.'series/'.$image;
                                            
                                        } else {
                                            
                                            $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                                            
                                        }
                                        
                                        ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <a href="/sangraha/<?php echo $added_date ?>/<?php echo $act ?>"><img src="<?php echo $thumbnail ?>" class="img-fluid paddingmenu" alt="picture"></a>
                                </div>
                            </div>
                            <?php
                                }
                                }
                                ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6 more6">
                                <a class="boldtitle" href="/archive.php">
                                    <h4 style="text-decoration: underline;margin-bottom: 0px;">अझ पुराना अंक</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <!--Kitab-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown17" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                शिक्षक-किताब
                </a>
                <div class="dropdown-menu" aria-label="navbarDropdown">
                    <div class="container megastyle5">
                        <div class="row pt-4">
                            <?php 
                                $bookList = $book->getBookForNav(4);
                                
                                if(is_array($bookList) || is_object($bookList)){
                                    
                                    foreach($bookList as $list){
                                        
                                        $act = explode(' ', html_entity_decode($list->title));
                                        $act = implode('-', $act);
                                        
                                        $image = basename($list->image);
                                        
                                        if(isset($list->image) && file_exists(UPLOAD_DIR.'book/'.$image)){
                                            
                                            $thumbnail = UPLOAD_URL.'book/'.$image;
                                            
                                        } else {
                                            
                                            $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                                            
                                        }
                                        
                                        ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="row">
                                    <a href="/publication/<?php echo $list->id ?>/<?php echo $act ?>"><img src="<?php echo $thumbnail ?>" alt="pic" class="img-fluid"></a>
                                </div>
                                <div class="row">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <h5 class="h5type-report boldtitle"> <a class=" boldtitle" href="#"><?php echo $list->title ?></a></h5>
                                            <h5 class="h5type-report boldtitle"><a class=" boldtitle" href="#"><?php echo $list->writer ?></a></h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                                }
                                
                                }
                                
                                ?>
                        </div>
                    </div>
                </div>
            </li>
            <!--Resources-->
            <!--<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown18" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                स्रोत-सामग्री
                </a>
                <div class="dropdown-menu" aria-label="navbarDropdown">
                    <div class="container megastyle6">
                        <div class="row pt-4">
                            <div class="col-md-4 megastyle7">
                                <div class="row">
                                    <img src="img/123.jpg" alt="pic" class="img-fluid">
                                </div>
                                <div class="row">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <h5 class="h5type-report boldtitle"><a class=" boldtitle " href="#">स्रोत 1</a></h5>
                                        </li>
                                        <li class="nav-item">
                                            <h5 class="h5type-report boldtitle"><a class="boldtitle " href="#">स्रोत 2</a></h5>
                                        </li>
                                        <li class="nav-item">
                                            <h5 class="h5type-report boldtitle"> <a class="boldtitle " href="#">स्रोत 3</a></h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 megastyle7">
                                <div class="row">
                                    <img src="img/shikshak.jpg" alt="pic" class="img-fluid">
                                </div>
                                <div class="row">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <h5 class="h5type-report boldtitle"><a class=" boldtitle" href="#">Resources</a></h5>
                                        </li>
                                        <li class="nav-item">
                                            <h5 class="h5type-report boldtitle"><a class="boldtitle" href="#">Resources</a></h5>
                                        </li>
                                        <li class="nav-item">
                                            <h5 class="h5type-report boldtitle"><a class=" boldtitle" href="#">Resources</a></h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>-->
            <!--Useful Links-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown19" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                उपयोगी लिङ्क
                </a>
                <div class="dropdown-menu" aria-label="navbarDropdown">
                    <div class="container megastyle2">
                        <div class="row pt-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <h5 class="h5type-report"><a class="boldtitle " href="#">Useful Links</a></h5>
                                        </li>
                                        <li class="nav-item">
                                            <h5 class="h5type-report"><a class=" boldtitle " href="#">Useful Links</a></h5>
                                        </li>
                                        <li class="nav-item">
                                            <h5 class="h5type-report"><a class="boldtitle " href="#">Useful Links</a></h5>
                                        </li>
                                        <li class="nav-item">
                                            <h5 class="h5type-report"><a class=" boldtitle " href="#">Useful Links</a></h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <!--Contact-->
            <li class="nav-item">
                <a class="nav-link" href="/subscription">सदस्यता</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown9" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                सम्पर्क
                </a>
                <div class="dropdown-menu" aria-label="navbarDropdown9">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 mt-3 mb-3">
                                <h4 class="h5type-report boldtitle ">सम्पर्क</h4>
                                <form action="/action_page.php" method="POST" role="form">
                                    <div class="form-group">
                                        <input type="text" class="form-control font-14" id="name1" placeholder="नाम">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control font-14" id="email1" placeholder="इमेल">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control font-14" id="subjec1" placeholder="विषय">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message1" id="text1" cols="30" rows="4" placeholder="सन्देश"
                                            class="form-control font-14"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button>
                                </form>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 mt-3 mb-3 font-14">
                                <h4 class="h5type-report boldtitle">हाम्रो कार्यालय</h4>
                                <h6 class="h5type-report ">ठेगाना</h6>
                                <p class="pstyle5">
                                    पूर्णचण्डी मार्ग,
                                    जावालाखेल,
                                    ललितपूर
                                <div>
                                    <p class="pstyle5">फोन नं/सम्पादकिय</p>
                                    : ०१ ५५४३२५२
                                </div>
                                <div>
                                    <p class="pstyle5">व्यापार/विज्ञापन</p>
                                    : ०१ ५५४८१४२
                                </div>
                                <div>
                                    <p class="pstyle5">इमेल:</p>
                                    mail@teacher.org.np
                                </div>
                                <ul class="list-unstyled social-wrapper ">
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <div class="col-lg-5 col-md-4 mt-3 mb-3 contact3">
                                <h4 class="h5type-report boldtitle">ठेगाना</h4>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d16807.96443290016!2d85.31398465374404!3d27.67281549208659!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x92f3e42d1ddc2ce4!2sShikshak+(Teacher)+Monthly+Magazine!5e0!3m2!1sen!2snp!4v1545715912294"                                       height="300" style="border:0" allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
            <!--search-->
            <div class="container h-100">
              <div class="d-flex justify-content-center h-100">
                <form action="/khoj" method="get"  style="background:transparent">
                <div class="searchbar">
                  <input class="search_input" type="text" name="keyword" value="<?php echo @$_GET['keyword'] ?>" placeholder="खोजी गर्नुहोस् ...">
                  <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                </div></form>
              </div>
            </div> 
            <!--search-->
            </li>
        </ul>
    </div>
</nav>
