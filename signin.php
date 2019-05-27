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
        <title>Sign In Page</title>
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
                    <div class="col-md-6 mt-4">
                        <div class="signinheader">
                            <p class="h1 mb-4 px-4 text-md-left"><strong>साइन इन</strong></p>
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
                        </div>
                        <form class="px-4 text-center container" method="post" action="process/login.php">
                            <!-- Username-->
                            <p class="text-left mb-0"><strong>प्रयोगकर्ता नाम</strong></p>
                            <input type="text" id="defaultRegisterFormUsername" name="username" class="form-control mb-4">
                            <!-- Password -->
                            <p class="text-left mb-0"><strong>पासवर्ड</strong></p>
                            <input type="password" id="defaultRegisterFormPassword" class="form-control mb-2"
                                aria-describedby="defaultRegisterFormPasswordHelpBlock" name="password">
                            <div class="forgotpassword text-left">
                                <p style="padding-right: 10px"><a href="reset-password.php"><strong><span style="color: #1E695E;"> पासवर्ड बिर्सनुभयो ?</span></strong></a>
                                <p>
                                    </a>
                            </div>
                            <div class="signupbutton text-left">
                                <a href="#"><button class="btn-lg btncustom btn mb-2 " type="submit" value="submit">साइन
                                इन</button></a>
                            </div>
                            <div class="newcustomer text-left">
                                <p style="padding-right: 10px"><strong>तपाईंको खाता छैन ?&nbsp;<a href="signup.php"><span style="color: #1E695E;">  साइन अप गर्नुहोस्।<span></a></strong>
                                <p>
                                    </a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 px-4">
                        <div class="imagebody">
                            <img src="<?php echo FRONT_IMAGES_URL ?>/image1.png" alt="cover" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'inc/footer.php';?>