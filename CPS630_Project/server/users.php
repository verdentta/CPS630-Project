<?php

class User{
    public $user_id ='';
    public $full_name = '';
    public $phone_number = '';
    public $email = '';
    public $user_address = '';
    public $city_code = '';
    public $login_id = '';
    public $password = '';
    public $balance = '';
}

//added auto_increment to this..
$sql = "CREATE TABLE USERS (
    user_id INT(6) AUTO_INCREMENT PRIMARY KEY, 
    full_name VARCHAR(80),
    phone_number VARCHAR(15),
    email VARCHAR(50),
    user_address VARCHAR(80),
    city_code VARCHAR(15),
    login_id VARCHAR(20),
    salt_password VARCHAR(32), 
    login_password VARCHAR(32),
    salt_balance VARCHAR(32),
    balance VARCHAR(32),
    ccnumber VARCHAR(32),
    salt_ccnumber VARCHAR(32),
    cvv VARCHAR(10),
    expdate VARCHAR(10)
    )";

if ($conn->query($sql) === TRUE) {
    echo "USERS table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}


?>