<?php include('partials/menu.php'); ?>



        <!-- Main Content section starts -->
        <div class="main-content">
            <div class="wrapper">
               <h1>DASHBOARD</h1>

               <div class="col-4 text-center">
                   <?php 
                    $sql = "SELECT * FROM tbl_category";
                    // Execute the Query
                    $res = mysqli_query($conn, $sql);
                    // Count the rows
                    $count = mysqli_num_rows($res);
                   ?>
                   <h1><?php echo $count; ?></h1>
                   <br>
                   Categories
               </div>

               <div class="col-4 text-center">
                    <?php 
                        $sql2 = "SELECT * FROM tbl_food";
                        // Execute the Query
                        $res2 = mysqli_query($conn, $sql2);
                        // Count the rows
                        $count2 = mysqli_num_rows($res2);
                   ?>
                   <h1><?php echo $count2; ?></h1>
                   <br>
                   Foods
               </div>

               <div class="col-4 text-center">
                    <?php 
                        $sql3 = "SELECT * FROM tbl_order";
                        // Execute the Query
                        $res3 = mysqli_query($conn, $sql3);
                        // Count the rows
                        $count3 = mysqli_num_rows($res3);
                    ?>
                   <h1><?php echo $count3; ?></h1>
                   <br>
                   Total Orders
               </div>

               <div class="col-4 text-center">
                   <?php 
                        // Create sql Query to get total Revenue Generated
                        // Aggegrate Function in SQL
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order";

                        // Execute the Query
                        $res4 = mysqli_query($conn, $sql4);

                        // Get the Value
                        $row4= mysqli_fetch_assoc($res4);

                        // Get thee Total Revenue
                        $total_revenue = $row4['Total'];
                   
                    ?>
                    <h1><?php echo $total_revenue; ?></h1>
                    <br>
                   Revenue Generated
               </div>
               <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main content section ends -->



        <!-- Footer Section Starts -->
<?php include('partials/footer.php'); ?>