<?php
session_start();

require 'connect.php';
// Retrieve data from form
$total_price = $_POST['total'];
$item_ids = $_POST['itemIds'];
$coupon_code = $_POST['coupon'];

// Set session variables 
$_SESSION['total_price'] = $total_price;
$_SESSION['item_ids'] = $item_ids;
if (empty($coupon_code)) {
    $_SESSION['coupon_msg'] = 'NONE';
}else {
    $_SESSION['coupon_msg'] = 'FREE';
}

// Redirect to delivery
header('Location: ../client/delivery.php');
exit(); 
$conn->close();
?>