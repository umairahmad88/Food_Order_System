<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <!-- add-category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
        <!-- enctype="multipart/form-data"     this property will allow us to upload the file  -->
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>select image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" > Yes
                        <input type="radio" name="featured" value="No" > No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" > Yes
                        <input type="radio" name="active" value="No" > No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
                
                
            </table>
        </form>

        <!-- ends add-category form  -->

        <!-- Add category Form Ends -->
        <?php 
            // check weather the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                // echo "Clicked";

                //1. Get the value from category form
                $title =$_POST['title'];
                
                // for radio input type we need to check weather the button is selected  or not
                if(isset($_POST['featured']))
                {
                    // Get the value from form 
                    $featured =$_POST['featured'];
                }
                else{
                    // set the default value
                    $featured ="No";
                }


                if(isset($_POST['active']))
                {
                    // Get the value from form 
                    $active=$_POST['active'];
                }
                else{
                    // set the default value
                    $active="No";
                }

                
                // check weather the image is slected or not and set the value for image name accordinly
                //print_r($_FILES['image']);//is an array and we will display the array


                //die();  //break the code here
                //check weather the file is selected or not 


                // Array ( [name] => menu-pizza.jpg [type] => image/jpeg [tmp_name] => C:\xampp\tmp\phpD55F.tmp [error] => 0 [size] => 112983 )
                // has name property and then name of image so 
                if(isset($_FILES['image']['name']))
                {
                    // upload the image
                    // to upload the image we need, source path and destination path
                    $image_name=$_FILES['image']['name'];

                    //upload the image only if image is selected
                    if($image_name!="")
                    {

                    
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
                            header('location:'.SITEURL.'admin/add-category.php');

                            die();
                        }
                    }
                }
                else{
                    // Don't upload image and set the image_name value as blank
                    $image_name="";
                }



                //2. create sql query to insert category into database
                $sql="INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    
                ";

                //3. Execute the Query and save 
                $res=mysqli_query($conn,$sql);

                // check weather the query executed or not and data added or not
                if($res==true)
                {
                    // Query Executed and Category Added
                    $_SESSION['add']="<div class='success'>Catogory Added Successfully.</div>";
                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // Failed to Add Category 
                    $_SESSION['add']="<div class='error'>Failed to Add Category.</div>";
                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>
    </div>
</div>


<?php include('partials/footer.php');?>