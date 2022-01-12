<?php include('config/constants.php'); ?>

<html>
    <head>
        <title>
            login - Food Order System
        </title>
        <link rel="stylesheet" href="../css/adminn.css">
        
        <link rel="stylesheet" href="../css/style.css ">
    </head>
    <body>
        <div class="login box-shadow-img" style="border-radius: 10px;">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Login Form Start Here -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username" style="margin: 2%; height:30px;border:none; background-color: rgb(236, 235, 235); "> <br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password" style="margin: 2%; height:30px;border:none; background-color: rgb(236, 235, 235);"> <br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- Login Form Start Here -->

            
        </div>    

    </body>
</html>


<?php
    //Check whether the Submit Buttom is Clicked or NOT
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL  to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        
        //3.Execute the Query
        $res = mysqli_query($conn, $sql);

        //4.Count rows to check whether the user exists or not
        $conn = mysqli_num_rows($res);

        if($conn==1)
        {
            //User Available
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username;  //to check whether user is login or not
            //Redirect to Home page/Deshboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User not Available
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //Redirect to Home page/Deshboard
            header('location:'.SITEURL.'admin/login.php');
        }

    }

?>