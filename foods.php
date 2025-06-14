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



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php

            //display food that are active
            //SQL query to get food from database
            $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count rows to check whether food is available or not
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                //food available
                while ($row = mysqli_fetch_assoc($res)) {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];

                    ?>

                    <div class="food-menu-box">
                        <a href="<?php echo SITEURL; ?>food-view.php?id=<?php echo $id; ?>">
                        <div class="food-menu-img">
                            <?php 
                            //check whether image is available or not
                            if ($image_name == "") {
                                //image not available
                                echo "<div class='error'>Image not Available</div>";
                            } else {
                                //image available
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
                            <!-- <br> -->

                            <!-- <a href="#" class="btn btn-primary">Order Now</a> -->
                        </div>

                    </div>
                    <!-- food menu box ends here -->

                    <?php
            }
            } else {
                //food not available
                echo "<div class='error'>Food not Available</div>";
            }

            ?>


            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    
<?php include('partials-front/footer.php'); ?> 