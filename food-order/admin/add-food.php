<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of Food">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>
                        Select Image:
                    </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" >

                            
                        <!-- select category from database instead of manually adding -->
                        <?php 
                        //crate php code to display categories from database
                        //1. create sql to get all active categories from database
                        $sql ="SELECT * FROM tbl_category WHERE active='Yes'";
                        //executing query
                        $res=mysqli_query($conn,$sql);
                        //count rows to check whether we have catigories or not
                        $count=mysqli_num_rows($res);
                        //if count is greater than zero, we have categories else we don not have categotires
                        if($count>0)
                        {
                            //we have categories from datbase
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id=$row['id'];
                                $title=$row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php

                            }
                        }
                        else{
                            // we dont have category
                            ?>
                            <option value="0">No category found</option>
                            <?php
                        }

                        // display on drop down list

                        ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Featured:
                    </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        Active
                    </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

                        <!-- to insert data in database -->
        <?php 
        //check weather button is clicked or not 
        if(isset($_POST['submit']))
        {
            // add the food in database
            //echo "clicked";\
            //1. get the data from form and then inset into database
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $category=$_POST['category'];
            // for featured and actie check wheather radio button for featured and active checked or not
            if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else{
                $featured="No";// setting the default value
            }

            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else{
                $active="No";// setting the default value
            }


            //2. upload the image is selected

            //check weather the select image is clicked or not and upload the image only if the image is selected
            if(isset($_FILES['image']['name']))
            {
                //get the details of the selected image 
                $image_name=$_FILES['image']['name'];
                //check wheather the image is selected or not and upload only if selectd
                if($image_name!="")
                {
                    //image is selectd 
                    //A.rename the image 
                    //get the extension of seleectd image(jpg ,png ,gif,etc.)
                    $explo=explode('.',$image_name);
                    $ext = end($explo);

                    
                    //create new name for image
                    $image_name="Food-Name-".rand(0000,9999).".".$ext;//new image name may be like"food-name-656"
                    //B. upload the image
                    //get the src path and destination path
                    // source path is the current location of the image
                    $src=$_FILES['image']['tmp_name'];
                    //destination path for the image to be uploaded
                    $dst="../images/food/".$image_name;

                    //finlay upload the food image 
                    $upload =move_uploaded_file($src,$dst);

                    //check wheater image uploaded or not
                    if($upload==false)
                    {
                        //failed to upload the image 
                        //redirect to add food page with error message
                        
                        $_SESSION['upload']="<div class='error'>Failed to upload the image.</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        //stop the process
                        die();
                    }
                }

            }
            else
            {
                $image_name="";//setting default value as blank
            }
            //3. inset into database
            //create an sql query to save or add food 
            //for numerical we do not need to pass inside quotes '' but for string value is complsory to add quotes
            $sql2="INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
            ";

            //execute the query 
            $res2=mysqli_query($conn,$sql2);
            //check wheather data inserted or not
            //4. redirect with message to manage food page
            if($res2 == true)
            {
                //data inserted successfully
                $_SESSION['add']="<div class ='success'>Food Added successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else{
                //failed to insert data
                $_SESSION['add']="<div class='error'> Failed to add food.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');

            }

            
        }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>