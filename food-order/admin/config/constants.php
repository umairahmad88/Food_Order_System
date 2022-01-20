<?php

    //start session
    session_start();

    //execute Query and save data in database
    //connect database
    //create constants to store non repeating values because database name database username database password will remain same for whole project
    define('SITEURL','http://localhost/food-order/');
    define('LOCALHOST','localhost');        
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');        
    define('DB_NAME','food-order');

    $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
    $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());
?>