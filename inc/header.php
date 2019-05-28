<?php require 'config/init.php'; 

    require CLASS_PATH.'user.php';
    
    require CLASS_PATH.'news.php';
    
    $news = new News();
    
    $user = new User();
    
    require CLASS_PATH.'profile.php';
    
    $profile = new Profile();
    
    $postAuthor = new postAuthor();
    
    $page = getCurrentPage(); 
    
    ?>
<!doctype html>
<html class="no-js" lang="ne">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>शिक्षक मासिक</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--Code for dynamic meta Properties-->   
        <?php 
            if(isset($_GET['act']) && !empty($_GET['act'])){
                
                $title = $_GET['act'];
                
               $title = explode("-", $title);
               
               $title = implode(" ", $title);
                
            } else {
                $title = "शिक्षक मासक";
            }
            
            if(isset($_GET['id']) && !empty($_GET['id'])){
                
                $id = $_GET['id'];
                
                if($id){
                    
                    $getNews = $news->getNewsById($id);
                    
                    $getProfile = $profile->getProfileById($id);
                    
                    $image = basename($getNews[0]->image);
                    
                    //$proImage = basename($getProfile[0]->image);
                    
                    if(isset($getNews[0]->image) && file_exists(UPLOAD_DIR.'news/'.$image)){
                        
                        $ogImage = UPLOAD_URL.'news/'.$image;
                        
                    } elseif(isset($getProfile[0]->image) && file_exists(UPLOAD_DIR.'profile/'.$image)){
                        
                        $ogImage = UPLOAD_URL.'profile/'.$proImage;
                        
                    } else {
                        
                        $ogImage = FRONT_IMAGES_URL.'shikshak.jpg';
                        
                    }
                    
                    if(isset($getNews[0]->title) && !empty($getNews[0]->title)){
                        
                        $title = $getNews[0]->title;
                
                        $title = explode("-", $title);
                       
                        $title = implode(" ", $title);
                        
                    } elseif(isset($getProfile[0]->title) && !empty($getProfile[0]->title)){
                        
                        $title = $getProfile[0]->title;
                
                        $title = explode("-", $title);
                       
                        $title = implode(" ", $title);
                        
                    } 
                    
                    else {
                        
                        $title = "शिक्षक मासक";
                        
                    }
                    
                    if(isset($getNews[0]->summary) && !empty($getNews[0]->summary)){
                        
                        $summary = $getNews[0]->summary;
                
                        $summary = explode("-", $summary);
                       
                        $summary = implode(" ", $summary);
                        
                    } elseif(isset($getProfile[0]->summary) && !empty($getProfile[0]->summary)){
                        
                        $summary = $getProfile[0]->summary;
                
                        $summary = explode("-", $summary);
                       
                        $summary = implode(" ", $summary);
                        
                    }
                    
                    else {
                        
                        $summary = "शिक्षक मासक";
                        
                    }
                    
                }
                
                
            }
            
            ?>
        <!--End of code for dynamic meta Properties-->
        <meta name="og:title" content="<?php echo $title ?>" />
        <meta name="og:type" content="" />
        <meta name="og:url" content="" />
        <meta name="og:image" content="<?php echo $ogImage ?>" />
        <meta name="og:description" content="<?php echo $summary ?>" />
        <link rel="manifest" href="site.webmanifest">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_URL ?>normalize.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_URL ?>bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
            crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Mukta:400,500" rel="stylesheet">
        <link rel="shortcut icon" href="<?php echo FRONT_IMAGES_URL ?>favicon.ico">
        <!-- Important Owl stylesheet -->
        <script src="<?php echo FRONT_ASSETS_URL ?>editorfront/ckeditor.js"></script>
        <script src="<?php echo FRONT_ASSETS_URL ?>editorfront/config.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Mukta" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_URL ?>slick-theme.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo FRONT_CSS_URL ?>slick.css" />
        <link rel="stylesheet" href="<?php echo FRONT_CSS_URL ?>version3.css">
    </head>
    <style>
        .decorate{
        background: #1e695e;
        line-height: 16px;
        height: 14px;
        }
        .edit-list{
        display:none;
        }
        #proceed{
        display:none;
        }
    </style>
    <body>
        <?php 
            if (($page == 'index') && (!isset($_SESSION['front_token']))) {
                ?>
        <div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <a href="archive.html"><img src="<?php echo FRONT_IMAGES_URL ?>shikshak_add.png" class="img-fluid" alt="picture"></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            } 
            
             ?>
        <!-- modal -->
        <section id="header">
            <div class="header-content">
                <!-- TOPBAR -->
                <div class="topbar ">
                    <div class="container">
                        <!-- Image and text -->
                        <nav class="navbar1 navbar-custom1">
                            <div class="row">
                                <div class="col-lg-9 col-md-6">
                                    <a class="navbar1-brand" href="/./">
                                    <img src="<?php echo FRONT_IMAGES_URL ?>logo.png" width="200" height="50" class="d-inline-block align-top img-fluid"
                                        alt="logo">
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 topbar-second">
                                    <?php 
                                        if(isset($_SESSION['front_token']) && $_SESSION['froles'] == "Reader"){
                                            
                                            if(isset($_SESSION['fuser_id']) && !empty($_SESSION['fuser_id'])){
                                                
                                                $id = $_SESSION['fuser_id'];
                                                
                                            }
                                        
                                            $userInfo = $user->getUserById($id);
                                            
                                            $image = basename($userInfo[0]->image);
                                            
                                            if(isset($userInfo[0]->image)&& !empty($userInfo[0]->image) && file_exists(UPLOAD_DIR.'users/'.$image)){
                                                
                                                $profileImage = UPLOAD_URL.'users/'.$image;
                                                
                                            } else {
                                            
                                                $profileImage = FRONT_IMAGES_URL.'defaultUser.png';
                                            
                                            }
                                            ?>
                                    <div class="dropdown-profile">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img class="img-circle img-fluid" src="<?php echo $profileImage ?>" style="width:30px; height:30px;">
                                            <h6 class="profile-name"><?php echo $_SESSION['ffirst_name']." ".$_SESSION['flast_name'] ?></h6>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="custom">
                                            <a class="dropdown-item" href="/edit-profile.php"><i class="fas fa-user-edit"></i> प्रोफाइल</a>
                                            <a class="dropdown-item" href="/./logout"><i class="fas fa-sign-out-alt"></i>लग आउट</a>
                                        </div>
                                    </div>
                                    <?php
                                        } else {
                                            ?>
                                    <div class="buttons-for">
                                        <a href ="/signin.php" class="btn btn-secondary">साइन इन</a>
                                        <a href ="/signup.php" class="btn btn-secondary">साइन अप</a>
                                    </div>
                                    <?php
                                        }
                                        
                                        ?><div>मिति: <span id="uniquedate"></span></div>
                                        
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <?php flash(); ?>
        <?php require 'inc/menu.php'; ?>