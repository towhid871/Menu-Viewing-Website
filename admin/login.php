<?php

include('../config/constants.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <?php

                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-loginh-message'])){
                    echo $_SESSION['no-loginh-message'];
                    unset($_SESSION['no-loginh-message']);
                }
                

        ?>
        <br><br>


        <form action="login.php" method="POST" class="login-form">
            
            
            <input type="text" name="username" placeholder="Username" required>
            
            <input type="password" name="password" placeholder="Password" required>
            
            <input type="submit" name="submit"  value="Login">

        </form>
    </div>
</body>
</html>



<?php


    if(isset($_POST['submit'])){
        $username= $_POST['username'];
        $password= md5($_POST['password']);


        $sql= "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        $res= mysqli_query($conn, $sql);




        $count= mysqli_num_rows($res);
        if($count==1){
            $_SESSION['login'] = "<div class='success'> Login Successful </div>";
            $_SESSION['user']= $username;
            header('location:'.SITEURL.'/admin');

        }else{
            $_SESSION['login'] = "<div class='failed' > Login Unsuccessful </div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }




?>
