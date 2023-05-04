<?php

class Shopping{
    public $receipt_id ='';
    public $store_code = '';
    public $total_price = '';
}

//Re-arranged the order of creating the tables 
//(eg: we need to create a table before we declare it as a foreign key else where)
$sql = "CREATE TABLE SHOPPING (
    receipt_id INT(6) AUTO_INCREMENT PRIMARY KEY,
    store_code VARCHAR(15),
    total_price FLOAT(10, 2)
    )";

if ($conn->query($sql) === TRUE) {
    echo "SHOPPING table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}
?>