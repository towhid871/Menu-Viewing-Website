<?php 
include('../admin/partials/menu.php'); 
?>

<div class="main-content">
    <div class="wrapper"> 
        <h1>Manage Food</h1>

        <br><br>
        <?php

            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }

            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset ($_SESSION['remove']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
            }

            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];   
                unset ($_SESSION['failed-remove']);

            }

            

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }

            if(isset($_SESSION['unothirize'])){
                echo $_SESSION['unothirize'];
                unset ($_SESSION['unothirize']);
                
            }


        ?><br><BR>


                <!-- button to add category -->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add food</a><br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S/N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    <?php

                        $sql= "SELECT * FROM tbl_food";
                        $res=mysqli_query($conn, $sql);
                        // if($res == false){
                        //     echo "SQL Error: " . mysqli_error($conn);
                        //     die(); // Stop execution if query fails
                        // }

                        $count = mysqli_num_rows($res);

                        $sn= 1;
                        if($count>0){
                            while($row= mysqli_fetch_assoc($res)){
                                $id=$row['id'];
                                $title= $row['title'];
                                $price= $row['price'];  
                                $image_name= $row['image_name'];
                                $featured= $row['featured'];
                                $active= $row['active'];

                                ?>
                                            <tr>
                                                <td><?php echo $sn++; ?></td>
                                                <td><?php echo $title; ?></td>
                                                <td><?php echo $price; ?> BDT</td>

                                                <td>
                                                    <?php
                                                        
                                                        if($image_name != ""){
                                                        ?> 
                                                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px">
                                                        <?php
                                                        }
                                                        
                                                        else {
                                                            echo "<div class='failed'>Image Not Added</div>";
                                                        }       
                                                    ?>
                                                </td>
                                                
                                                <td><?php echo $featured; ?></td>
                                                <td><?php echo $active; ?></td>
                                                <td>
                                                    
                                                    <!-- <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Category</a> -->
                                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update food</a>
                                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-alert">Delete Food</a>
                                                    
                                                    


                                                </td>
                                            </tr>                        

                                <?php
                                }

                        }else{
                                echo "<tr><td colspan='7' class='failed'>Food Not Added Yet</td></tr>";
 
                        }
                        
                        

                    ?>

                </table>
    </div>
</div>




<?php 
include('../admin/partials/footer.php'); 
?>