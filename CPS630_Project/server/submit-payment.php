<?php
session_start();

require 'connect.php';
// Retrieve data from form
$ccnumber = mysqli_real_escape_string($conn, $_POST['ccnumber']);
$cvv = mysqli_real_escape_string($conn, $_POST['cvv']);
$expirydate = mysqli_real_escape_string($conn, $_POST['expdate']);

$userID = $_SESSION['user_id'];

// Set session variable and continue to review cart
$_SESSION['ccnumber'] = $ccnumber;

$salt_ccnumber = bin2hex(random_bytes(16));
$md5_ccnumber = md5($ccnumber.$salt_ccnumber);

// Update user information with their credit card info
$sql = "UPDATE USERS set ccnumber = '$md5_ccnumber', salt_ccnumber='$salt_ccnumber', cvv = '$cvv', expdate = '$expirydate' WHERE user_id = '$userID';";   
mysqli_query($conn, $sql);


header('Location: ../client/invoice.php');
exit(); 
$conn->close();
?>