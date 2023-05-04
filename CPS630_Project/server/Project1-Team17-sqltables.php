<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cps630project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE ORDERS (
    order_id INT(6) PRIMARY KEY,
    dt_issued DATE,
    dt_received DATE,
    total_price FLOAT(10, 2),
    code INT(4),
    user_id INT(6),
    trip_id INT(6),
    receipt_id INT(6)
    )";

if ($conn->query($sql) === TRUE) {
    echo "ORDERS table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE ITEMS (
    item_id INT(6) PRIMARY KEY,
    item_name VARCHAR(80),
    price FLOAT(10, 2),
    made_in VARCHAR(30),
    dept_code INT(6)
    )";

if ($conn->query($sql) === TRUE) {
    echo "ITEMS table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE USERS (
    user_id INT(6) PRIMARY KEY,
    full_name VARCHAR(80),
    phone_number VARCHAR(15),
    email VARCHAR(50),
    user_address VARCHAR(80),
    city_code VARCHAR(15),
    login_id VARCHAR(20),
    login_password VARCHAR(20),
    balance FLOAT(10, 2)
    )";

if ($conn->query($sql) === TRUE) {
    echo "USERS table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE TRIPS (
    trip_id INT(6) PRIMARY KEY,
    source_code VARCHAR(15),
    dest_code VARCHAR(15),
    distance FLOAT(10, 1),
    truck_id VARCHAR(20),
    price FLOAT(10, 2)
    )";

if ($conn->query($sql) === TRUE) {
    echo "TRIPS table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
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

$sql = "CREATE TABLE SHOPPING (
    receipt_id INT(6) PRIMARY KEY,
    store_code VARCHAR(15),
    total_price FLOAT(10, 2)
    )";

if ($conn->query($sql) === TRUE) {
    echo "SHOPPING table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
