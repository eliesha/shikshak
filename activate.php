<?php require 'config/init.php';  
   require 'inc/checklogin.php';
   
   if(isset($_GET['token']) && !empty($_GET['token'])) {
       $token = $_GET['token'];
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
      <title>खाता सक्रिय गर्नुहोस्</title>
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
                           <h1>खाता सक्रिय गर्नुहोस्</h1>
                           <p>शिक्षक वेबसाइटमा आफ्नो खाता सक्रिय गर्न तलको बटनमा क्लिक गर्नुहोस्।</p>
                           <form class="px-4 text-center container" method="post" action="process/activate.php">
                              <input type="hidden" value="<?php echo $token ?>" name="token">
                              <div class="signupbutton">
                                 <a href="#"><button class="btn-lg btncustom btn mb-2 " type="submit" value="submit">पुष्टि गर्नुहोस्</button></a>
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
      <?php
         } else {
             
             redirect('/../');
             
         }
         
         
         ?>