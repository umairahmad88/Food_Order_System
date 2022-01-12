<?php 
    //include Constants.php file here
    include('config/constants.php');

    //1.get the ID of admin to be deleted
    //3.Video 3:02
    
    //admin/delete-admin.php?id=<?php echo $id; >//

    //echo $id = $_GET['id'];
    $id = $_GET['id'];

    //2.Create SQL Query to Delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if($res==true)
    {
        //Query Exectued Successfully and admin Deleted
        //echo "Admin Deleted"
        //Create session variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to Delete Admin
        //echo "Failed to Delete Admin";

        $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    //3.video 14:18 add session
    

    //3.Redirect to Manage Admin with message


?>