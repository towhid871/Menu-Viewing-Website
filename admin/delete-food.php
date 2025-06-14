<?php


    include('../config/constants.php');
    
    // echo "Delete Page";
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        // echo "Get Value & Delete Page";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];



        // Remove the physical image file if available
        if($image_name != ""){
            // Image is available, so remove it
            $path = "../images/food/".$image_name;
            $remove = unlink($path);

            // If failed to remove image then add an error message and stop the process
            if($remove==false){
                // Set the session message
                $_SESSION['remove'] = "<div class='failed'>Failed to Remove Category Image</div>";
                // Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-food.php');
                // Stop the process
                die();
            }
        }

        // Delete data from database
        $sql = "DELETE FROM tbl_food WHERE id=$id"; 

        // Execute the query
        $res = mysqli_query($conn, $sql);


        // Check whether the query executed successfully or not
        if($res==true){
            // Query executed successfully and category deleted
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }else{
            // Failed to delete category
            $_SESSION['delete'] = "<div class='failed'>Failed to Delete Category</div>";   
            header('location:'.SITEURL.'admin/manage-food.php'); 
        }

        //redirect to manage category page with message
        

        

    }
    else{
        $_SESSION['unothorize'] = "<div class='failed'>Unauthorized Access</div>";
        // Redirect to manage category page
        header('location:'.SITEURL.'admin/manage-food.php');

    }
    


?>
