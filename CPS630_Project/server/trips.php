<?php

class Trips{
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


//Here I fixed truck_ID from varchar to Int 
$sql = "CREATE TABLE TRIPS (
    trip_id INT(6) AUTO_INCREMENT PRIMARY KEY,
    source_code VARCHAR(15),
    dest_code VARCHAR(15),
    distance FLOAT(10, 1),
    truck_id INT(6), 
    price FLOAT(10, 2),
    FOREIGN KEY (truck_id) REFERENCES TRUCKS(truck_id)
    )";

if ($conn->query($sql) === TRUE) {
    echo "TRIPS table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}
?>
