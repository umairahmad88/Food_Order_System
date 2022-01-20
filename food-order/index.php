<?php include('partials-front/menu.php'); ?>

                          <!-- Search food -->


    <section class="food-search text-center">
        <div class="container"><!-- ((container)) div work as container for aligning the content to centre -->
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search Food Here..." class="box-shadow">
                <input type="submit" name="submit" value="Search" class="btn btn-primary box-shadow" >
            </form>
        </div>
       
    </section>

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

                            <!-- catagory section -->


    <section class="categories">


        <div class="container box-container ">
            <h2 class="text-center text-shadow" >FOOD CATEGORIES</h2>

            <?php 
                //Create SQL Query to Display Category form DataBase
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Execute the Query
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Category Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container ">
                                <?php 
                                    //Check Whether is Avialable or Not
                                    if($image_name=="")
                                    {
                                        //Display Message 
                                        echo "<div class='error'>Image Not Available</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="box-shadow-img img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            
                            <h3 class="float-text text-yellow"><?php echo $title; ?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }
                else
                {
                    //Category is Not Avialable
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>

            
            
           
            
            <div class="clearfix"></div>


        </div>

        
    </section>

                               <!-- food menu -->


    <section class="food-menu">
        <div class="container">

            <h2 class="text-center text-shadow">FOOD MENU</h2>

            <?php 
                //Getting Foods from Database that are active and featured
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count Rows
                $count2 = mysqli_num_rows($res2);

                //Check Whether Food available are not
                if($count2>0)
                {
                    // Food Available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        // Get all the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                            <div class="food-menu-box box-shadow">
                                <div class="food-menu-img">
                                    <?php  
                                        // Check Whether image is available or not
                                        if($image_name=="")
                                        {
                                            // Image not Available
                                            echo "<div class='error'>Image not Available.</div>";
                                        }
                                        else
                                        {
                                            // Image Avialable
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chiken howain pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    
                                    ?>
                                    
                                </div>
                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price; ?></p>
                                    <p class="food-detail"><?php echo $description; ?></p>
                                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        <?php
                    }
                }
                else
                {
                    // Food not Available
                    echo "<div class='error'>Food not Available.</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
        
    </section>

<?php include('partials-front/footer.php'); ?>