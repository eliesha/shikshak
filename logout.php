<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

session_start();

unset($_SESSION['ffirst_name']);

unset($_SESSION['flast_name']);

unset($_SESSION['fusername']);

unset($_SESSION['femail']);

unset($_SESSION['fimage']);

unset($_SESSION['froles']);

unset($_SESSION['fstatus']);

unset($_SESSION['fphonenumber']);

unset($_SESSION['fpassword']);

unset($_SESSION['front_token']);

unset($_SESSION['fuser_id']);

@header('location: ./');
?>