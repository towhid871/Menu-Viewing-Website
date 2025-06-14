<?php 

include('partials-front/menu.php'); ?>



<?php

    //check wether id is passed or not
    if(isset($_GET['category_id'])) {
        //category id is set and get the id
        $category_id = $_GET['category_id'];

        //get the category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        $res = mysqli_query($conn, $sql);

        //check whether the query executed or not
        if($res==TRUE) {
            //check whether we have data or not
            $count = mysqli_num_rows($res);
            if($count==1) {
                //we have data
                $row = mysqli_fetch_assoc($res);
                $category_title = $row['title'];
            } else {
                //we do not have data
                //redirect to home page
                header('location:'.SITEURL);
            }
        }
    } else {
        //redirect to home page
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php

                //get foods based on category id
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id AND active='Yes'";
                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //count rows to check whether we have foods or not
                $count2 = mysqli_num_rows($res2);

                //check whether we have foods or not
                if($count2>0){
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
                                    if($image_name=="") {
                                        //we do not have image, display error message
                                        echo "<div class='failed'>Image not Available.</div>";
                                    } else {
                                        //image is available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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

                                <!-- <a href="#" class="btn btn-primary">Order Now</a> -->
                            </div>
                        </div>
                        <?php
                    }
                }else {
                    //we do not have foods
                    echo "<div class='failed'>Food not Available.</div>";
                }
            ?>

                            

                        


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?> 