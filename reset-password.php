<?php require 'config/init.php';  
    require 'inc/checklogin.php';
    
    ?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
            crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_URL ?>normalize.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_URL ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_URL ?>version3.css">
        <link rel="shortcut icon" href="<?php echo FRONT_IMAGES_URL ?>favicon.ico">
        <title>पासवर्ड रिसेट</title>
    </head>
    <body>
        <!-- NAVBAR -->
        <nav class="navbar" id="bg1">
            <a class="navbar-brand img-fluid" href="./">
            <img src="<?php echo FRONT_IMAGES_URL ?>/logo.jpg" alt="logo" class="m-3" alt="">
            </a>
        </nav>
        <div class="main">
            <div class="container">
                <!-- Sign Up Portion-->
                <div class="row signin py-4">
                    <div class="col-md-12 mt-4 text-center">
                        <div class="signinheader">
                        </div>
                        <div class="container text-center" id="c404">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 offset-md-3 c404">
                                    <h1>पासवर्ड रिसेट</h1>
                                    <p>तपाईको पासवर्ड कसरी रिसेट गर्नका लागि निर्देशनहरूको साथ एक इमेल पठाइनेछ।</p>
                                    <form class="px-4 text-center container" method="post" action="process/reset-password.php">
                                        <!-- Username-->
                                        <p class="text-left mb-0"><strong>इमेल</strong></p>
                                        <input type="text" name="email" class="form-control mb-4" placeholder="तपाईंको इमेल प्रविष्ट गर्नुहोस्।">
                                        <div class="signupbutton">
                                            <a href="#"><button class="btn-lg btncustom btn mb-2 " type="submit" value="submit">ईमेल द्वारा नयाँ पासवर्ड रिसेट गर्नुहोस्</button></a>
                                        </div>
                                        <?php 
                                            if(@$_SESSION['success'] && !empty(@$_SESSION['success'])){
                                                ?>
                                        <p class="front-error"><?php echo $_SESSION['success'] ?></p>
                                        <?php
                                            unset($_SESSION['success']);
                                            }
                                            
                                            ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'inc/footer.php';?>