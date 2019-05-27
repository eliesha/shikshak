<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>व्यवस्थापक प्यानल</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/nepali-date-picker@2.0.0/dist/nepaliDatePicker.min.css" integrity="sha384-Fligaq3qH5qXDi+gnnhQctSqfMKJvH4U8DTA+XGemB/vv9AUHCwmlVR/B3Z4nE+q" crossorigin="anonymous">
    <script src="<?php echo FRONT_ASSETS_URL ?>editor/ckeditor.js"></script>
    <script src="<?php echo FRONT_ASSETS_URL ?>editor/config.js"></script>
    <!--Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <!--Select2 -->
    <link href="<?php echo ADMIN_ASSETS_URL ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    
    <!-- NProgress -->
    <link href="<?php echo ADMIN_ASSETS_URL ?>nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo ADMIN_ASSETS_URL ?>bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo ADMIN_ASSETS_URL ?>css/custom.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo FRONT_IMAGES_URL ?>favicon.ico">
    <style type="text/css">
        .dot:before{
         content:' ';
         position: absolute;
         width:10px;
         height:10px;
         border-radius: 50%;
        }

        .dot:after {
         content:' ';
         position: absolute;
         width:10px;
         height:10px;
         background-color: red;
         border-radius: 50%;
         box-shadow: 0 0 10px rgba(0,0,0,.3) inset;
         -webkit-animation-name:'ripple';/*动画属性名，也就是我们前面keyframes定义的动画名*/
         -webkit-animation-duration: 1s;/*动画持续时间*/
         -webkit-animation-timing-function: ease; /*动画频率，和transition-timing-function是一样的*/
         -webkit-animation-delay: 0s;/*动画延迟时间*/
         -webkit-animation-iteration-count: infinite;/*定义循环资料，infinite为无限次*/
         -webkit-animation-direction: normal;/*定义动画方式*/
        }

        @keyframes ripple {
          0% {
           left:10px;
           top:10px;
           opacity:0.8;jqu
           width:0;
           height:0;
         }
         100% {
           left:-20px;
           top:-20px;
           opacity: 0;
           width:50px;
           height:50px;
         }
        }
    </style>
  </head>
  <body class="<?php echo (getCurrentPage() == 'index') ? 'login' : 'nav-md' ?>">