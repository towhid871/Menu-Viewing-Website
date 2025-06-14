<?php


include('../config/constants.php');


//1. get the id of Admin Detected
$id= $_GET['id'];
//2. Create SQL query to delete admin
$sql= "delete from tbl_admin where id=$id";

//exceute the query
$res= mysqli_query($conn, $sql);

if($res==TRUE){
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}else{
    $_SESSION['delete'] = "<div class='failed'>Failed To Delete Admin</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
//3. redirect to manage.admin page (with msg)

?>


