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
        <title>पासवर्ड बनाउनुहोस्</title>
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
                    <?php 
                        $selector = $_GET['selector'];
                        
                        $validator = $_GET['token'];
                        
                        if(!empty($selector) || !empty($validator)){
                        
                            if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                                ?>
                    <div class="col-md-6 mt-4">
                        <div class="signinheader">
                            <p class="h1 mb-4 px-4 text-md-left"><strong>पासवर्ड रिसेट</strong></p>
                        </div>
                        <?php 
                            if(@$_SESSION['error'] && !empty(@$_SESSION['error'])){
                                ?>
                        <p class="front-error"><?php echo $_SESSION['error'] ?></p>
                        <?php
                            unset($_SESSION['error']);
                            } 
                            ?>
                        <form class="px-4 text-center container" method="post" action="process/passwordRequest.php">
                            <input type="hidden" name="selector" value="<?php echo $selector ?>">
                            <input type="hidden" name="validator" value="<?php echo $validator ?>">
                            <!-- Username-->
                            <p class="text-left mb-0"><strong>नयाँ पासवर्ड प्रविष्ट गर्नुहोस्</strong></p>
                            <input type="password" name="new-password" class="form-control mb-4">
                            <!-- Password -->
                            <p class="text-left mb-0"><strong>नयाँ पासवर्ड पुष्टि गर्नुहोस्</strong></p>
                            <input type="password" class="form-control mb-2"
                                aria-describedby="defaultRegisterFormPasswordHelpBlock" name="confirm-password">
                            <br><br>
                            <div class="signupbutton text-left">
                                <a href="#"><button class="btn-lg btncustom btn mb-2 " type="submit" value="submit">पासवर्ड सुनिश्चित गर्नुहोस                            इन</button></a>
                            </div>
                        </form>
                    </div>
                    <?php
                        }
                        
                        } else {
                        
                        redirect('./');
                        
                        }
                        
                        ?>
                    <div class="col-md-6 px-4">
                        <div class="imagebody">
                            <img src="<?php echo FRONT_IMAGES_URL ?>/image1.png" alt="cover" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'inc/footer.php';?>