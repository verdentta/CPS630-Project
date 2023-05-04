<?php

class Items{
    public $item_id ='';
    public $item_name = '';
    public $price = '';
    public $made_in = '';
    public $dept_code = '';
    public $gender = '';
    public $img_url = '';
}

$sql = "CREATE TABLE ITEMS (
    item_id INT(6) PRIMARY KEY,
    item_name VARCHAR(80),
    price FLOAT(10, 2),
    made_in VARCHAR(30),
    gender VARCHAR (10),
    dept_code INT(6),
    img_url VARCHAR(5000)
    )";

if ($conn->query($sql) === TRUE) {
    echo "ITEMS table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}


?>