<?php 
include('../admin/partials/menu.php'); 
?>



<div class="main-content">
    <div class="wrapper"> 
        <h1>Add Food</h1><br><br>
        <?php

            if(isset($_SESSION['add'])){
                echo ($_SESSION['add']);
                unset ($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo ($_SESSION['upload']);
                unset ($_SESSION['upload']);
            }


        ?><br><br>

        
        
        <form action="" method="POST" enctype="multipart/form-data">



            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Enter The Food Name"></td>

                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" clos="30" rows="5" placeholder="Enter the description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" placeholder="Enter the price of the food">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>

                </tr>

                <tr>
                    <td>Cetgory: </td>
                    <td>
                        <select name="category">




                        <?php
                        // Create PHP code to display categories from database
                        $sql= "SELECT * FROM tbl_category WHERE active='Yes'";
                        $res= mysqli_query($conn, $sql); 

                        //count rows to check whether we have categories or not
                        $count= mysqli_num_rows($res);

                        //if count is greater than zero, we have categories
                        if($count>0){
                            //we have categories
                            while($row=mysqli_fetch_assoc($res)){
                                $id= $row['id'];
                                $title= $row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                            }
                        }else{
                            //we do not have categories
                            ?>
                            <option value="0">No Category Found</option>
                            <?php

                        }


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
                        Active:

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

        <?php 

        //check whether the submit button is clicked or not
        if(isset($_POST['submit'])){


            //Get the values from the form
            $title= $_POST['title'];   
            $description= $_POST['description'];
            $price= $_POST['price'];
            $category= $_POST['category'];
            //check whether the radio button for featured and active is checked or not
            if(isset($_POST['featured'])){
                $featured= $_POST['featured'];  
            }else{
                //set the default value
                $featured= "No";
            }

            if(isset($_POST['active'])){
                $active= $_POST['active'];
            }else{
                //set the default value
                $active= "No";
            }
        

            //upload the image if selected
            //check whether the image is selected or not and upload the image only if selected  
            if(isset($_FILES['image']['name'])){

                //get the details of the selected image
                $image_name= $_FILES['image']['name'];

                //check whether the image is selected or not and upload only if selected
                if($image_name!=""){

                    //auto rename our image
                    //get the extension of the image (jpg, png, gif, etc.)
                    $ext= end(explode('.', $image_name));

                    //rename the image
                    $image_name= "Food-Name-".rand(0000, 9999).'.'.$ext; //e.g. Food-Name-1234.jpg

                    //upload the image
                    $source_path= $_FILES['image']['tmp_name'];
                    $destination_path= "../images/food/".$image_name;

                    //finally upload the image
                    $upload= move_uploaded_file($source_path, $destination_path);

                    //check whether the image is uploaded or not
                    if($upload==false){
                        //set message
                        $_SESSION['upload']= "<div class='error'>Failed to upload image.</div>";
                        //redirect to add food page
                        header('location:'.SITEURL.'admin/add-food.php');
                        die();
                    }

                }
            }else{
                //don't upload image and set the image_name as blank
                $image_name= "";
            }
        

            //create sql query to insert food into database
            $sql2= "INSERT INTO tbl_food SET 
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
            ";

            //execute the query
            $res2= mysqli_query($conn, $sql2);

            //check whether the query executed successfully or not
            if($res2==true){
                //query executed and food added
                $_SESSION['add']= "<div class='success'>Food Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }else{
                //failed to add food
                $_SESSION['add']= "<div class='failed'>Failed to Add Food.</div>";
                header('location:'.SITEURL.'admin/add-food.php');
            }

        }

        ?>



    </div>
</div>









<?php 
include('../admin/partials/footer.php'); 
?>





