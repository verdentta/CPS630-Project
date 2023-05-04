<?php
session_start();

require 'connect.php';
// Retrieve data from form
$branch = mysqli_real_escape_string($conn, $_POST['branch']);
$datetime = mysqli_real_escape_string($conn, $_POST['delivery-date']);

// Set session variables 
$_SESSION['branch'] = $branch;
$_SESSION['datetime'] = $datetime;

$userid = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = '$userid'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
if($user) {
    $_SESSION['shipping_address'] = $user['user_address'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['city_code'] = $user['city_code'];
}

// Redirect to invoice
header('Location: ../client/billing.php');
exit(); 
$conn->close();
?>