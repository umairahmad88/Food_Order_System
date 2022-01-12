<?php 
    include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

        <table class="tbl_30">
            <tr>
                <td> Current Password: </td>
                <td>
                    <input type="password" name="current_password" placeholder= "Current Password">
                </td>
            </tr>

            <tr>
                <td>New Password: </td>
                <td><input type="password" name="new_password" placeholder="New Password"></td>
            </tr>

            <tr>
                <td>Confirm Password: </td>
                <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>

        </table>

        </form>
    </div>
</div>

<?php 
    //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Clicked";
        //1.Get the Data from Form
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //2.Check whether the user with current ID and Current Password Exists or Not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //Check whether data is avaiable or not
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                //User Exists and Password can be changed
                //echo "User Found";

                //Check whether the new password and confirm match or not
                if($new_password==$confirm_password)
                {
                    //update the password
                    $sql2 = "UPDATE tbl_admin SET 
                    password='$new_password'
                    WHERE id=$id
                    ";

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether the query executed or not
                    if($res2==true)
                    {
                        //Display Success Message
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                        //Redirecting the User
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        //Display Error Message
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                        //Redirecting the User
                        header('location:'.SITEURL.'admin/manage-admin.php');
                        
                    }

                }
                else
                {
                    //Redirect to Manage Admin PAge with Error Message
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Patch.</div>";
                    //Redirecting the User
                    header('location:'.SITEURL.'admin/manage-admin.php');

                }

                
                
            }
            else
            {
                //User Does NOT Exists set Message and Redirect
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
                //Redirecting the User
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        //3.Check whether the new Password and Confirm Password Match or Not

        //4.Change Password if all above is true

    }

?> 

<?php 
    include('partials/footer.php'); ?>



