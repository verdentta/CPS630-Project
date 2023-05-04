<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
		require 'connect.php';

		// Retrieve data from form
		$name = mysqli_real_escape_string($conn, $_POST['full-name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$phonenumber = mysqli_real_escape_string($conn, $_POST['phone-number']);
		$address = mysqli_real_escape_string($conn, $_POST['address']);
		
		$salt_password = bin2hex(random_bytes(16));
		$md5password = md5($password.$salt_password);
		echo $salt_password."___". $md5password;
	

		// Insert data into database
		$sql = "INSERT INTO `users` (full_name, phone_number, email, user_address, city_code, login_id, salt_password, login_password) 
							VALUES ('$name', '$phonenumber','$email','$address',3243,'$username','$salt_password','$md5password')";
		mysqli_query($conn, $sql);

		// Close connection
		mysqli_close($conn);
		
		// Redirect to login page
		header('Location: ../client/sign-in.php');
}
?>