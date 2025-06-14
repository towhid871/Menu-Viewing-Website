<?php 
include('../admin/partials/menu.php'); 
?>



<div class="main-content">
    <div class="wrapper"> 
        <h1>Add Admin</h1><br><br>

        <?php

        if(isset($_SESSION['add'])){
            echo ($_SESSION['add']);
            unset ($_SESSION['add']);
        }


        ?>
        
        <form action="" method="POST">



            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>

                </tr>

                <tr>
                    <td>
                        Username:

                    </td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                </tr>

                <tr>
                    <td>
                        Password:

                    </td>
                    <td><input type="text" name="password" placeholder="Enter Your Password"></td>
                </tr>


                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">

                    </td>
                </tr>
            </table>
        </form>



    </div>
</div>









<?php 
include('../admin/partials/footer.php'); 
?>





<?php

//proccess the value from Form and save it in Database
//check whether the button is clicked or not

if(isset($_POST['submit']))
{
    //button clicked
    //echo "Button Clicked";
    //1. get the data from Form           
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //passowrd encription with md5

    //2. sql quyert to save to database
    $sql= "INSERT INTO tbl_admin SET
        full_name= '$full_name',
        username= '$username',
        password= '$password'
    
    ";

    //3. execute query and save data in database
    
    
    
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. save whether the (query is exceucted) data is inserted or not and  display result

    if($res==TRUE){
        //echo "Data Inserted";
        $_SESSION['add']= "<div class='success'>Admin Added Successfully</div>";

        header("location:".SITEURL.'admin/manage-admin.php');
    }else{
        //echo "Data Not Inserted";
        $_SESSION['add']= "<div class='failed'>Failed to Add Admin</div>";

        header("location:".SITEURL.'admin/add-admin.php'); 
    }








}

?>