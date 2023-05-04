<?php
class Reviews{
    public $purchasing_id ='';
    public $receipt_id = '';
    public $order_id = '';
    public $user_id = '';
    public $rank = '';
    public $review = '';
    public $service_rank = '';
}

// creating reviews table
$sql = "CREATE TABLE REVIEWS (
    purchasing_id INT(6) AUTO_INCREMENT PRIMARY KEY,
    receipt_id INT(6),
    item_id INT(6),
    order_id INT(6),
    user_id INT(6),
    rank INT(6),
    review VARCHAR(5000),
    service_rank INT(6),
    FOREIGN KEY (receipt_id) REFERENCES SHOPPING(receipt_id),
    FOREIGN KEY (item_id) REFERENCES ITEMS(item_id),
    FOREIGN KEY (order_id) REFERENCES ORDERS(order_id),
    FOREIGN KEY (user_id) REFERENCES USERS(user_id)
    )";

if ($conn->query($sql) === TRUE) {
    echo "REVIEWS table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}
?>