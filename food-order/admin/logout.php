<?php 
    //include constants.php for SITURL
    include('config/constants.php');
    //1.Destroy the Session
    session_destroy();   //Unset $_SESSION['user']

    //2.Redirect to Login Page
    header('location:'.SITEURL.'admin/login.php');
?>