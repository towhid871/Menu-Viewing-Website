<?php


    if(!isset($_SESSION['user'])){
        $_SESSION['no-loginh-message']= "<div class='failed'> Please login First</div>";
        header('location:'.SITEURL.'admin/login.php');

    }


?>