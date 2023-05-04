<?php

session_start();

        require 'connect.php';

        // Retrieve data from form
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Get salt from DB based on username
        $sql = "SELECT salt_password FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $salt_password = $row['salt_password'];

        $salted_md5_password = md5($password.$salt_password);
        //echo $salt_password."___".$salted_md5_password;

        // Check if user exists
        $sql = "SELECT * FROM users WHERE email='$email'";
        echo $email;
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
 
        if($user) {
                // Verify password
                //echo $password;
                //echo $user['login_password'];
                if($salted_md5_password==$user['login_password']) {
                        // Password is correct, set session variables
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['name'] = $user['full_name'];
                        // Redirect to home page
                        header('Location: ../client/home.php');
                } else {
                        // Password is incorrect
                        $error = 'Invalid email or password.';
                        echo"Invalid email or password1";
                }
        } else {
                // User does not exist
                $error = 'Invalid email or password.';
                echo"Invalid email or password2";
        }
        $conn->close();

?>