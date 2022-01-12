
<?php
    // include constants Page
    include('config/constants.php');



    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process to delete
        // echo "Process to Delete";
        // 1.get ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 2.Remove the Image if Available
        // Check whether available or Not
        if($image_name != "")
        {
            // it has image and need to be remove
            // get the image Path
            $path = "../images/food/".$image_name;

            // Remove image File from folder
            $remove = unlink($path);
            
            // Check whether image is Removed or not
            if($remove==false)
            {
                // Failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                
                // Redirect to Manage Food
                header('location:'.SITEURL.'admin/manage-food.php');
                // Stop the Process of Deleting Food
                die();
            }
        }
        
        // 3.Delete food from Database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        // Execute the Query
        $res = mysqli_query($conn, $sql);

        // check whether the Query execcuted or not
         // 4.Redirect to MAnage FOod with session Message
        if($res==true)
        {
            // Food Deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            // Failed to Delete Food
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
       
    }
    else
    {
        // redirect to MAnage Food Page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>