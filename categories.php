<?php 

include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>


            <?php 

            //Display all categories that are active
            //sql query to get categories from database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count rows to check whether we have categories or not
            $count = mysqli_num_rows($res);
            //check whether we have categories or not
            if($count>0)
            {
                //we have categories
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

                    ?>

                    <a href="category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                            //check whether image is available or not
                                if($image_name=="")
                                {
                                    //we do not have image, display error message
                                    echo "<div class='failed'>Category not found.</div>";
                                    

                                }else{
                                    //we have image, display it
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            
                            

                            
                        </div>
                    </a>
                    <?php
                }
            }
            else
            {
                //we do not have categories
                echo "<div class='failed'>Category not found.</div>";
            }

            ?>

            
            
            



            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?> 