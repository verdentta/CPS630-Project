<?php
    session_start();
    
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['msg'] = "You have to log in first";
        header('location: sign-in.php');
    }
    
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user_id']);
        header("location: sign-in.php");
    }
?>