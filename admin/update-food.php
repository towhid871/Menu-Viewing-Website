<?php ob_start(); ?>
<?php include('../admin/partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1><br><br>

        <?php
            if(isset($_GET['id'])){
                // Get the ID of the category to be updated
                $id = $_GET['id'];

                // SQL query to get category details
                $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
                
                // Execute query
                $res2 = mysqli_query($conn, $sql2);

                $row2 = mysqli_fetch_assoc($res2);

                // Check if query returned data
                
                   
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price']; 
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
                
            }else {
                // Redirect if id is not set
                header('location:'.SITEURL.'admin/manage-food.php');
                exit();
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter The Category Name" value="<?php echo ($title); ?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <input type="text" name="description" placeholder="Enter The Food Description" value="<?php echo ($description); ?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" placeholder="Enter The Food Price" value="<?php echo ($price); ?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image != ""){
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" alt="<?php echo $title; ?>" width="100px">
                                <?php
                            } else {
                                echo "<div class='failed'>Image Not Added</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
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
                                $category_title= $row['title'];
                                $category_id= $row['id'];
                                
                                
                                ?>

                                <option <?php if($current_category==$category_id){
                                    echo "selected";
                                } ?>value="<?php echo $category_id; ?>"><?php echo $category_title; ?> </option>

                                <?php
                                
                            }
                        }else{
                            //we do not have categories
                            
                            echo "<option value='0'>No Category Found</option>";
                            

                        }


                        ?>
                        
                        </select>

                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                // Get all data from form with basic escaping
                $id = $_POST['id'];
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $price = mysqli_real_escape_string($conn, $_POST['price']);
                $current_image = $_POST['current_image'];
                $category = mysqli_real_escape_string($conn, $_POST['category']);
                $featured = mysqli_real_escape_string($conn, $_POST['featured']);
                $active = mysqli_real_escape_string($conn, $_POST['active']);
                

                // Check if new image is selected
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
                    // New image upload process
                    $image_name = $_FILES['image']['name'];

                    // Get extension
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                    // Rename image
                    $image_name = "Food_".rand(0000,9999).".".$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/".$image_name;

                    // Upload the new image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check upload success
                    if($upload == false){
                        $_SESSION['upload'] = "<div class='failed'>Failed to Upload New Image</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        die();
                    }

                    // Remove old image if exists
                    if($current_image != ""){
                        $remove_path = "../images/food/".$current_image;
                        if(file_exists($remove_path)){
                            $remove = unlink($remove_path);

                            if($remove == false){
                                $_SESSION['failed-remove'] = "<div class='failed'>Failed to Remove Current Image</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();
                            }
                        }
                    }

                } else {
                    // No new image selected, keep old image
                    $image_name = $current_image;
                }

                // Update the database
                $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = '$price',  
                    image_name = '$image_name',
                    category_id = '$category', 
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id";

                $res3 = mysqli_query($conn, $sql3);

                if($res3 == true){
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    exit;
                } else {
                    $_SESSION['update'] = "<div class='failed'>Failed to Update Food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    exit;
                }
            }
        ?>
    </div>
</div>


<?php include('../admin/partials/footer.php');?>
<?php ob_end_flush(); ?>
