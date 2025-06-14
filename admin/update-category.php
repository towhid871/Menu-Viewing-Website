<?php include('../admin/partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1><br><br>

        <?php
            if(isset($_GET['id'])){
                // Get the ID of the category to be updated
                $id = $_GET['id'];

                // SQL query to get category details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                
                // Execute query
                $res = mysqli_query($conn, $sql);

                // Check if query returned data
                $count = mysqli_num_rows($res);
                if($count == 1){
                    // Data found
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    // No category found with this ID
                    $_SESSION['no-category-found'] = "<div class='failed'>Category Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                    exit();
                }
            } else {
                // Redirect if id is not set
                header('location:'.SITEURL.'admin/manage-category.php');
                exit();
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter The Category Name" value="<?php echo htmlspecialchars($title); ?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image != ""){
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
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
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                // Get all data from form with basic escaping
                $id = $_POST['id'];
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $featured = mysqli_real_escape_string($conn, $_POST['featured']);
                $active = mysqli_real_escape_string($conn, $_POST['active']);
                $current_image = $_POST['current_image'];

                // Check if new image is selected
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
                    // New image upload process
                    $image_name = $_FILES['image']['name'];

                    // Get extension
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                    // Rename image
                    $image_name = "Category_".rand(0000,9999).".".$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;

                    // Upload the new image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check upload success
                    if($upload == false){
                        $_SESSION['upload'] = "<div class='failed'>Failed to Upload New Image</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        exit();
                    }

                    // Remove old image if exists
                    if($current_image != ""){
                        $remove_path = "../images/category/".$current_image;
                        if(file_exists($remove_path)){
                            $remove = unlink($remove_path);

                            if($remove == false){
                                $_SESSION['failed-remove'] = "<div class='failed'>Failed to Remove Current Image</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                exit();
                            }
                        }
                    }

                } else {
                    // No new image selected, keep old image
                    $image_name = $current_image;
                }

                // Update the database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    featured = '$featured',
                    active = '$active',
                    image_name = '$image_name'
                    WHERE id = $id";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true){
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                } else {
                    $_SESSION['update'] = "<div class='failed'>Failed to Update Category</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>
    </div>
</div>

<?php include('../admin/partials/footer.php');?>
