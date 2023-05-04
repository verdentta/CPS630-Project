<?php

class Truck{
    public $truck_id = '';
    public $truck_code = '';
    public $avail_code = '';
}


$sql = "CREATE TABLE TRUCKS (
    truck_id INT(6) PRIMARY KEY,
    truck_code VARCHAR(15),
    avail_code VARCHAR(15)
    )";

if ($conn->query($sql) === TRUE) {
    echo "TRUCKS table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}
?>
