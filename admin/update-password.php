<?php 
include('../admin/partials/menu.php'); 
?>


<div class="main-content">
    <div class="wrapper"> 
        <h1>Change Password</h1><br><br>

        <?php

            if(isset($_GET['id'])){
                $id=$_GET['id'];
            }


        ?>
        


        <form action="" method="POST">



            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" placeholder="old Password"></td>

                </tr>

                <tr>
                    <td>
                        New Password:

                    </td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>

                <tr>
                    <td>
                        Confirm New Password:

                    </td>
                    <td><input type="password" name="confirm_new_password" placeholder="Confirm New Password"></td>
                </tr>

                


                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Password" class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>



    </div>
</div>


<?php 

            if(isset($_POST['submit'])){
                $id= $_POST['id'];
                $current_password= md5($_POST['current_password']);
                $new_password= md5($_POST['new_password']);
                $confirm_new_password= md5($_POST['confirm_new_password']);



                $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password'";

                $res = mysqli_query($conn, $sql);
                if($res==TRUE){
                    $count=mysqli_num_rows($res);
                    if($count==1){
                        // echo "User found";
                        if($new_password==$confirm_new_password){
                            $sql2= "UPDATE tbl_admin SET
                            password = '$new_password' WHERE id='$id'";
                            $res2= mysqli_query($conn, $sql2);
                            if($res2==TRUE){
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                                header("location:".SITEURL.'admin/manage-admin.php');


                            }else{
                                $_SESSION['change-pwd'] = "<div class='failed'>Failed to change password. </div>";
                                header("location:".SITEURL.'admin/manage-admin.php');

                            }


                        }else{

                            $_SESSION['pwd-not-found'] = "<div class='failed'>Password not matched. </div>";
                            header("location:".SITEURL.'admin/manage-admin.php');
                        }
                    }else{
                        $_SESSION['pwd-not-found'] = "<div class='failed'>User not found. </div>";
                        header("location:".SITEURL.'admin/manage-admin.php'); 
                    }
                }

            }


?>








<?php 
include('../admin/partials/footer.php'); 
?>