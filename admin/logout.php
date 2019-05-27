<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

session_start();

unset($_SESSION['username']);

unset($_SESSION['email']);

unset($_SESSION['image']);

unset($_SESSION['roles']);

unset($_SESSION['status']);

unset($_SESSION['password']);

unset($_SESSION['full_name']);

unset($_SESSION['session_token']);

unset($_SESSION['user_id']);

unset($_SESSION['added_by']);

@header('location: ./');

?>