<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
             
             if(isset($_SESSION['add']))//checking weather the session is set or not
             {
                 echo $_SESSION['add'];//display session message
                 //to show message of successfull one time only
                 unset($_SESSION['add']);//removing session message 
             } 
        ?>
        

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                        
                    </td>
                </tr>
                

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                    
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>


<?php
// process the value from Form and save it in database
// check weather the button is clicked or not
if(isset($_POST['submit']))
{
    // button clicked 
    //echo "button clicked";
    //get the data from form
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=$_POST['password'];

    // incrypt the password using md5 function 
    $password=md5($_POST['password']);

    //echo "full name is $full_name and Username is $username and Passowrd is $password";

    //sql query to save the data in database
    // at left is the name of column and at right is the variable name in which the fetched data from form is strored

    $sql="INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password' 
        ";


    //executing query and saving data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    //     //mysqli_query will execute the mysql query

    // check weather the (query) data is executed or not and display appropiate message
    if($res==TRUE)
    {
        //data inserted
        //create a session variable to display message
        $_SESSION['add'] ="admin add successfully";//add session name
        //redirect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
    } 
    else{
        //failed to insert data
        $_SESSION['add'] ="Failed to Add Admin";//add session name
        //redirect page to manage admin
        header("location:".SITEURL.'admin/add-admin.php');
    }

    
}

?>