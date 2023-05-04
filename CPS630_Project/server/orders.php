<?php

// class Order {
//     public $order_id ='';
//     public $dt_issued = '';
//     public $dt_received = '';
//     public $total_price = '';
//     public $order_code = '';
//     public $user_id = '';
//     public $trip_id = '';
//     public $receipt_id = '';
//     public $user_id = '';
//     public $trip_id = '';
//     public $receipt_id = '';
// }

$sql = "CREATE TABLE ORDERS (
    order_id INT(6) AUTO_INCREMENT PRIMARY KEY,
    dt_issued DATE,
    dt_received DATE,
    total_price FLOAT(10, 2),
    code INT(4),
    user_id INT(6),
    trip_id INT(6),
    receipt_id INT(6),
    FOREIGN KEY (user_id) REFERENCES USERS(user_id),
    FOREIGN KEY (trip_id) REFERENCES TRIPS(trip_id),
    FOREIGN KEY (receipt_id) REFERENCES SHOPPING(receipt_id)
    )";

if ($conn->query($sql) === TRUE) {
    echo "ORDERS table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}


?>