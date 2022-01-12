<?php
    //include Constrant File
    include('config/constants.php');
    // echo "delete Page";
    // check wheither the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the Value and Delete
        // echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the image if Avaiable
        if($image_name != "")
        {
            // Image is AVaiable , SO Remove it
            $path = "../images/category/".$image_name;
            // Remove the Image
            $remove = unlink($path);

            // if failed to Remove image then add an error message and stop the process
            if($remove==false)
            {
                // Set the Session Message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove the Category Image.</div>";
                // Redirect to Message Page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the PRocess
                die();
            }
        }

        // Delete Date from Database
        // SQL Quere to Delete Data
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        // Execute the Query
        $res = mysqli_query($conn, $sql);
        // Check whether the DAta is Deleted from database or not
        if($res==true)
        {
            // Set Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            // Redirect to MAnge Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // Set fail Message and Redirect
            $_SESSION['delete'] = "<div class='error'>Failed  to Delete Category.</div>";
            // Redirect to MAnge Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }
    else
    {
        //redirect to Mange Category Page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>