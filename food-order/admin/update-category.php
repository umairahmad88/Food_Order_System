<?php 
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        
        <?php 
            if(isset($_GET['id']))
            {
                //Check whether the ID is set or not
            if(isset($_GET['id']))
            {
                //Get the ID and All other details
                $id = $_GET['id'];
                //Create SQL Query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the Rows to check whether the id is valid or not 
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data 
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //Redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                //redirect to Manage Cateory
                header('location:'.SITEURL.'admin/manage-category.php');
            }

            }
            else
            {
                //redirect to Manage Cateory
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                        
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php if($current_image != "")
                        {
                            //Display the image 
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                            <?php
                        } 
                        else
                        {
                            // Display Message
                            echo "<div class='error'>Image not Added.</div>";
                        }

                        ?>
                    </td>







                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary"> 
                    </td>
                </tr>

                
            </table>
        </form>
        <?php 
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. Get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2.Updating new image if selected
                //Check wether the image is selected or Not
                if(isset($_FILES['image']['name']))
                {
                    //Get the image Details 
                    $image_name = $_FILES['image']['name'];

                    //check whether available or Not
                    if($image_name != "")
                    {
                        //Image Available
                        //A.Upload the New Image

                        // if we upload the image two time auto name the image or renaming the image    auto rename our image
                        // Get the extension of our (jpg,png,gif etc) e.g "food.jpg"
                        $ext=end(explode('.',$image_name));
                        // explode function will breake the name of image with name and extintion and break around the . opertor 

                        //rename the image
                        $image_name="Food_Category_".rand(000,999).'.'.$ext;//e.g. Food_Category_834.jpg
                        //this name will be save in our database


                        $source_path=$_FILES['image']['tmp_name'];

                        $destination_path="../images/category/".$image_name;

                        //finally uplaod the image 
                        $upload=move_uploaded_file($source_path,$destination_path);
                        if($upload==false)
                        {
                            //Set message
                            $_SESSION['upload']="<div class='error'>Failed to Upload image.</div>";
                            //redirect to add category page
                            header('location:'.SITEURL.'admin/manage-category.php');

                            die();
                        }

                        //B.Remove the Current Image if available
                        if($current_image != "")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //Click whether the image is removed or not
                            //if failed to remove then display message and stop the process
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error' >Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                        }
                        
                    } 
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                //3.Update the database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                    ";

                    //execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                //4. Redirect to  MAnage Category with  Message
                //Check whether executed or Not
                if($res2==true)
                {
                    //Category Updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to update Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                
            }
        ?>

        

    </div>
</div>





<?php 
    include('partials/footer.php');
?>