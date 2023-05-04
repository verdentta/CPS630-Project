<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    require 'connect.php';
    $distance = mysqli_real_escape_string($conn, $_POST['distance']);
    $price = mysqli_real_escape_string($conn, $_POST['total']);
    $source_code = mysqli_real_escape_string($conn, $_POST['source_code']);
    $item_ids = $_POST['itemIds'];
    $itemIds = substr($item_ids, 1, -1);
    $itemIds_array = explode(',', $itemIds);

    // assign a TRUCK
    $sql = "SELECT * FROM `TRUCKS` WHERE `avail_code` = 'AVAILABLE' ORDER BY RAND() LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    $trucks = mysqli_fetch_assoc($result);
    $truck_id = $trucks['truck_id'];

    // get user_id and dest_code
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $sql = "SELECT * FROM `USERS` WHERE email='$email';";
    $result = mysqli_query($conn, $sql);
    $users = mysqli_fetch_assoc($result);
    $user_id = $users['user_id'];
    $dest_code = $users['city_code'];

    // insert into TRIPS table
    $sql = "INSERT INTO `TRIPS` ( `source_code`, `dest_code`, `distance`, `truck_id`, `price`) 
            VALUES ('$source_code', '$dest_code', $distance, $truck_id, $price );";   
    mysqli_query($conn, $sql);
    
    // get trip_id
    $sql = "SELECT * FROM `TRIPS` ORDER BY trip_id DESC LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    $trips = mysqli_fetch_assoc($result);
    $trip_id = $trips['trip_id'];
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $today = date("Y-m-d");

    // insert into SHOPPING table
    $sql = "INSERT INTO `SHOPPING` (`store_code`, `total_price`) 
    VALUES ('123', '$price');";   
    mysqli_query($conn, $sql);

    // get receipt_id
    $sql = "SELECT * FROM `SHOPPING` ORDER BY receipt_id DESC LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    $shopping = mysqli_fetch_assoc($result);
    $receipt_id = $shopping['receipt_id'];
    
    // insert into ORDERS table
    $sql = "INSERT INTO `ORDERS` (`dt_issued`, `dt_received`, `total_price`, `code`, `user_id`, `trip_id`, `receipt_id`) 
                                VALUES ('$today', '$date', '$price', '123', '$user_id ', $trip_id , '$receipt_id');";
    mysqli_query($conn, $sql);

    $sql = "SELECT * FROM `ORDERS` ORDER BY order_id DESC LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    $orders = mysqli_fetch_assoc($result);
    $order_id = $orders['order_id'];

    // insert into REVIEWS table
    foreach ($itemIds_array as &$value) {
        $sql = "INSERT INTO `REVIEWS` (`receipt_id`, `item_id`, `order_id`, `user_id`, `rank`, `review`) VALUES 
                                    ('$receipt_id', $value, '$order_id', '$user_id', NULL, NULL);";
        mysqli_query($conn, $sql);
    }

    // // Close connection
    $conn->close();

    $_SESSION['order_msg'] = true;
    $_SESSION['orderID'] = $order_id;
    header('Location: ../client/orders.php');
}
?>