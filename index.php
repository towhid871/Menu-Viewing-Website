<?php 

include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>



            <?php 
            
            //create SQL query to display categories from database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count rows to check whether we have categories or not
            $count = mysqli_num_rows($res);
            //check whether we have categories or not
            if($count > 0) {
                //we have categories
                while($row = mysqli_fetch_assoc($res)) {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            //check whether image is available or not
                                if($image_name == "") {
                                    //we do not have image, display error message
                                    echo "<div class='failed'>Image not Available.</div>";
                                }
                                else {
                                    //image is available
                                    ?>
                                        <img src="<?php echo SITEURL?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>

                    <?php
                }
            } else {
                //we do not have categories
                echo "<div class='failed'>Category not Added.</div>";
            }
            

                    
            
            ?>
            

            

            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="categories.php">See All Categories</a>
        </p>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

            //Getting foods from database that are active and featured
            //create SQL query to get foods
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //count rows to check whether we have foods or not
            $count2 = mysqli_num_rows($res2);
            //check whether we have foods or not
            if($count2 > 0) {
                //we have foods
                while($row2 = mysqli_fetch_assoc($res2)) {
                    //get the values
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <a href="<?php echo SITEURL; ?>food-view.php?id=<?php echo $id; ?>">
                        <div class="food-menu-img">
                            <?php 
                            //check whether image is available or not
                            if($image_name == "") {
                                //we do not have image, display error message
                                echo "<div class='failed'>Image not Available.</div>";
                            } else {
                                //we have image, display it
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <!-- <a href="order.html" class="btn btn-primary">Order Now</a> -->
                        </div>
                    </div>
                    <?php
                }
            } else {
                //we do not have foods
                echo "<div class='failed'>Food not Available.</div>";
            }

            ?>

            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?> 