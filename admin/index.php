<?php 
include('../admin/partials/menu.php'); 
?>







         <!-- Main Contnet start -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>

                <br><br>
                <?php

                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }

                ?>

                <br><br>

                <div class="col-4 text-center">


                <?php 


                    // SQL Query to get all categories
                    $sql = "SELECT * FROM tbl_category";
                    // Execute the query
                    $res = mysqli_query($conn, $sql);
                    // Count rows
                    $count = mysqli_num_rows($res);


        

                ?>
                    <h1><?php echo $count; ?></h1><br>
                    <b> Categories </b>
                </div>

                <div class="col-4 text-center">

                <?php


                    // SQL Query to get all foods
                    $sql2 = "SELECT * FROM tbl_food";
                    // Execute the query
                    $res2 = mysqli_query($conn, $sql2);
                    // Count rows
                    $count2 = mysqli_num_rows($res2);
                ?>
                    <h1><?php echo $count2; ?></h1><br>
                    <b>Foods</b>
                </div>

                <!-- <div class="col-4 text-center">
                    <h1>5</h1><br>
                    Categories
                </div>

                <div class="col-4 text-center">
                    <h1>5</h1><br>
                    Categories
                </div>

                <div class="col-4 text-center">
                    <h1>5</h1><br>
                    Categories
                </div> -->

                <div class="clearfix"></div>


            </div>

        </div>
         
         <!-- Main Contnet end -->




<?php 
include('../admin/partials/footer.php'); 
?>