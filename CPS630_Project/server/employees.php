<?php
class Employees{
    public $employee_id ='';
    public $name = '';
    public $role = '';
    public $email = '';
    public $code = '';
    public $description = '';
}

//added this extra employee table
$sql = "CREATE TABLE EMPLOYEE (
    employee_id INT(6) AUTO_INCREMENT PRIMARY KEY,
    employee_name VARCHAR(100),
    employee_role VARCHAR(500),
    email VARCHAR(50),
    employee_description VARCHAR(1000)
    )";

if ($conn->query($sql) === TRUE) {
    echo "EMPLOYEE table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}
?>