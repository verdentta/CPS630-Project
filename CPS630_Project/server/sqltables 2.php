<?php
require 'connect.php';

class Shopping{
    public $receipt_id ='';
    public $store_code = '';
    public $total_price = '';
}

//Re-arranged the order of creating the tables 
//(eg: we need to create a table before we declare it as a foreign key else where)
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

// class Trip{
//     public $trip_id ='';
//     public $source_code = '';
//     public $dest_code = '';
//     public $distance = '';
//     public $truck_id = '';
//     public $price = '';
//     public $truck_id = '';
// }

//Here I fixed truck_ID from varchar to Int 
$sql = "CREATE TABLE TRIPS (
    trip_id INT(6) PRIMARY KEY,
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
    login_password VARCHAR(20),
    balance FLOAT(10, 2)
    )";

if ($conn->query($sql) === TRUE) {
    echo "USERS table created successfully. ";
} else {
    echo "Error creating table: " . $conn->error;
}

// class Order{
//     public $order_id ='';
//     public $dt_issued = '';
//     public $dt_received = '';
//     public $total_price = '';
//     public $code = '';
//     public $user_id = '';
//     public $trip_id = '';
//     public $receipt_id = '';
//     public $user_id = '';
//     public $trip_id = '';
//     public $receipt_id = '';
// }

$sql = "CREATE TABLE ORDERS (
    order_id INT(6) PRIMARY KEY,
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

// class Item{
//     public $item_id ='';
//     public $item_name = '';
//     public $price = '';
//     public $made_in = '';
//     public $dept_code = '';
//     public $gender = '';
//     public $img_url = '';
// }

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

// class Employee{
//     public $employee_id ='';
//     public $name = '';
//     public $role = '';
//     public $email = '';
//     public $code = '';
//     public $description = '';
// }
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

//Insert in Shopping table
$sql= "INSERT INTO SHOPPING (`receipt_id`, `store_code`, `total_price`)VALUES 
                            (111, '1234', 10.00),
                            (112, '1234', 15.00),
                            (113, '1234', 35.99)";


if ($conn->query($sql) === TRUE) {
    echo "Inserted into Shopping table. ";
} else {
    echo "Error: CANNOT Inserted into shopping table" . $conn->error;
}

// Insert trucks (2 per branch)
$sql = "INSERT INTO `TRUCKS` (`truck_id`, `truck_code`, `avail_code`) VALUES 
                            ('1', '1001', '1'),
                            ('2', '1002', '1'), 
                            ('3', '1003', '0'),
                            ('4', '1004', '1'), 
                            ('5', '1005', '1'), 
                            ('6', '1006', '1'), 
                            ('7', '1007', '1'), 
                            ('8', '1008', '0'), 
                            ('9', '1009', '1'), 
                            ('10', '1010', '1');";

if ($conn->query($sql) === TRUE) {
    echo "Inserted into TRUCKS table. ";
} else {
    echo "Error: CANNOT Inserted into TRUCKS table" . $conn->error;
}

//Insert in Trucks table
$sql= "INSERT INTO TRUCKS (`truck_id`, `truck_code`, `avail_code`)VALUES 
                            (456, 'TRUCK1', 'AVAILABLE'),
                            (457, 'TRUCK2', 'MAINTENANCE'),
                            (458, 'TRUCK3', 'AVAILABLE')";


if ($conn->query($sql) === TRUE) {
    echo "Inserted into TRUCKS table. ";
} else {
    echo "Error: CANNOT Inserted into TRUCKS table" . $conn->error;
}

//Insert in Trips table
$sql= "INSERT INTO TRIPS (`trip_id`, `source_code`, `dest_code`, `distance`, `truck_id`, `price`)VALUES 
                            (344, 'M2R2F7', 'L4E3C5', 30.0, 456, 10.00),
                            (345, 'M2R2F7', 'L4E3C5', 30.0, 456, 15.00),
                            (346, 'N2R2F4', 'M4E7C5', 50.0, 458, 55.00)";


if ($conn->query($sql) === TRUE) {
    echo "Inserted into TRIPS table. ";
} else {
    echo "Error: CANNOT Inserted into TRIPS table" . $conn->error;
}

//Insert in Users table
$sql= "INSERT INTO USERS (`user_id`, `full_name`, `phone_number`, `email`, `user_address`, `city_code`, `login_id`, `login_password`, `balance`)VALUES 
                            (1, 'John Smith', '4164164166', 'johnsmith@gmail.com', '123 cherry street toronto on', 'L4E2D4', 'jsmith', 'password', 10.00),
                            (2, 'Jane Doe', '6476470000', 'janedoe@gmail.com', '100 cherry street toronto on', 'L4E2D4', 'jdoe', 'password', 15.00),
                            (3, 'Marcus Fancy', '1231231234', 'marcusfancy@gmail.com', '123 jackson street toronto on', 'M4E7C5', 'mfancy', 'password', 55.00)";


if ($conn->query($sql) === TRUE) {
    echo "Inserted into users table. ";
} else {
    echo "Error: CANNOT Inserted into users table" . $conn->error;
}

//Insert in Users table
$sql= "INSERT INTO ORDERS (`order_id`, `dt_issued`, `dt_received`, `total_price`, `code`, `user_id`, `trip_id`, `receipt_id`)VALUES 
                            (444, '2023-03-18', '2023-03-18', 10.00, 1, 1, 344, 111),
                            (445, '2023-03-19', '2023-03-19', 15.00, 1, 2, 345, 112),
                            (446, '2023-03-19', '2023-03-19', 35.99, 1, 3, 346, 113)";


if ($conn->query($sql) === TRUE) {
    echo "Inserted into orders table. ";
} else {
    echo "Error: CANNOT Inserted into orders table" . $conn->error;
}


//Insert in items table
//department code (0=Top,1=Bottom, 2=Activewear, 3=Outwear)
$sql = "INSERT INTO ITEMS (`item_id`, `item_name`, `price`, `made_in`, `gender`, `dept_code`,`img_url`) VALUES
        (1, 'Mens Jean Jacket', 20, 'Canada', 'male', 0, 'https://images.unsplash.com/photo-1600804889194-e6fbf08ddb39?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1965&q=80'),
        (2, 'Mens Hoodie', 35, 'USA', 'male', 0, 'https://images.unsplash.com/photo-1554411529-ee36dfde51b9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MjZ8fG1lbiUyMGhvb2RpZXxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60'),
        (3, 'Mens Jeans', 40, 'Canada', 'male', 1, 'https://images.unsplash.com/photo-1511196044526-5cb3bcb7071b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8bWVuJTIwamVhbnN8ZW58MHwxfDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60'),
        (4, 'Mens Shorts', 15, 'Canada', 'male', 1, 'https://images.unsplash.com/photo-1621496503717-095a410e1566?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWVuJTIwc2hvcnRzfGVufDB8MXwwfHw%3D&auto=format&fit=crop&w=500&q=60'),
        (5, 'Mens Sports Suit', 80, 'USA', 'male', 2, 'https://images.unsplash.com/photo-1599577466565-e9686fee4c18?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTd8fG1lbiUyMGd5bXxlbnwwfDF8MHx8&auto=format&fit=crop&w=500&q=60'),
        (6, 'Mens Winter Jacket', 200, 'Canada', 'male', 3, 'https://images.unsplash.com/photo-1516384903227-139a8cf0ec21?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80'),
        (7, 'Mens Snow Pants', 50, 'Canada', 'male', 3, 'https://images.unsplash.com/photo-1610024062303-e355e94c7a8c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OXx8bWVuJTIwc2tpaW5nfGVufDB8MXwwfHw%3D&auto=format&fit=crop&w=500&q=60'),
        
        (8, 'Womens T-shirt', 10, 'Canada', 'female', 0, 'https://images.unsplash.com/photo-1456885284447-7dd4bb8720bf?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8d29tZW5zJTIwVCUyMHNob3J0fGVufDB8MXwwfHw%3D&auto=format&fit=crop&w=500&q=60'),
        (9, 'Womens Sweater', 30, 'USA', 'female', 0, 'https://images.unsplash.com/photo-1631832255415-8583788a11cb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8d29tZW5zJTIwc3dlYXRlcnxlbnwwfDF8MHx8&auto=format&fit=crop&w=500&q=60'),
        (10, 'Womens Hoodie', 40, 'Canada', 'female', 0, 'https://images.unsplash.com/photo-1599265866618-44bf5b03def6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8d29tZW5zJTIwaG9vZGllfGVufDB8MXwwfHw%3D&auto=format&fit=crop&w=500&q=60'),
        (11, 'Womens Shorts', 10, 'Canada', 'female', 1, 'https://images.unsplash.com/photo-1488778578932-0f84d315fcae?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fHdvbWVucyUyMHNob3J0c3xlbnwwfDF8MHx8&auto=format&fit=crop&w=500&q=60'),
        (12, 'Womens Jeans', 30, 'Canada', 'female', 1, 'https://images.unsplash.com/photo-1592595293637-8557fa6d3c64?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8d29tZW5zJTIwamVhbnN8ZW58MHwxfDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60'),
        (13, 'Womens Dress Pants', 20, 'Canada', 'female', 1, 'https://images.unsplash.com/photo-1584273143981-41c073dfe8f8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fHdvbWVuJTIwYnVzaW5lc3MlMjBzdWl0fGVufDB8MXwwfHw%3D&auto=format&fit=crop&w=500&q=60'),
        (14, 'Womens Sports Jacket', 100, 'Canada', 'female', 2, 'https://images.unsplash.com/photo-1617085606193-6b17105cff2a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8d29tZW4lMjBydW5uaW5nfGVufDB8MXwwfHw%3D&auto=format&fit=crop&w=500&q=60'),
        (15, 'Womens Jacket', 155, 'USA', 'female', 3, 'https://images.unsplash.com/photo-1521164275317-a65412b69b80?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MjB8fHdvbWVuJTIwamFja2V0fGVufDB8MXwwfHw%3D&auto=format&fit=crop&w=500&q=60'),
        (16, 'Womens Snow Pants', 90, 'Canada', 'female', 3, 'https://images.unsplash.com/photo-1614358571391-7c8d63674c15?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8d29tZW4lMjBza2lpbmd8ZW58MHwxfDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60');";

if ($conn->query($sql) === TRUE) {
    echo "Inserted into ITEMS table. ";
} else {
    echo "Error: CANNOT Inserted into ITEMS table" . $conn->error;
}




$sql= "INSERT INTO EMPLOYEE (`employee_name`, `employee_role`, `email`, `employee_description`)VALUES 
                            ('Darryn Roopnarine', 'Marketing Director', 'darryn.roopnarine@torontomu.ca', 'As Marketing Director, I bring a wealth of experience and expertise to our team. With a proven track record of driving growth through innovative campaigns and creative strategies, I am passionate about helping our clients succeed. My focus on social media and digital marketing allows me to stay ahead of the curve and engage audiences in new and exciting ways. I am committed to understanding client needs and working closely with our team to develop strategies that truly make an impact. With a dedication to excellence and a passion for innovation, I am excited to help take our clients to new heights.'),
                            ('Nika Sharifi-Darian', 'Graphic Designer', 'nika.sharifidariani@torontomu.ca', 'I am a passionate graphic designer with a love for creating visually stunning designs that captivate and engage audiences. With years of experience in both print and digital media, I have developed a keen eye for detail and a deep understanding of how to communicate complex ideas through design. My dedication to understanding client needs and delivering exceptional work has helped me to build strong relationships with clients and colleagues alike. I am committed to bringing my creativity and expertise to every project, and to helping our clients achieve their goals through outstanding design.'),
                            ('Sakshi Padhiar', 'Software Engineer', 'sakshi.padhiar@torontomu.ca', 'As a Software Engineer, I am passionate about developing high-quality software that meets the needs of our clients. With over 5 years of experience in web development, I have a deep understanding of the latest technologies and frameworks, which allows me to build robust and scalable applications. My focus on user experience and attention to detail ensures that every project I work on delivers outstanding results. I am dedicated to collaborating with our team to understand client needs and bring their vision to life. With a commitment to excellence and a passion for technology, I am excited to continue pushing the boundaries of whats possible in software development.'),
                            ('Shivani Patel', 'Project Manager', 'shivani.v.patel@torontomu.ca', 'As a Project Manager, I am passionate about delivering exceptional results for our clients. With years of experience managing complex projects, I have developed a deep understanding of what it takes to deliver projects on time and within budget. My focus on communication, organization, and attention to detail allows me to keep our team on track and ensure that every project meets or exceeds our clients expectations. I am committed to working closely with our clients to understand their needs and develop customized project plans that deliver outstanding results. With a dedication to excellence and a passion for project management, I am excited to help our clients achieve their goals.'),
                            ('Romeo Paul', 'Sales Director', 'romeo.paul@torontomu.ca', 'As Sales Director, I am passionate about helping our clients achieve their business goals through effective sales strategies. With years of experience in sales and business development, I have a deep understanding of what it takes to build and maintain strong client relationships. My focus on understanding client needs, building trust, and delivering exceptional results allows me to achieve outstanding sales outcomes for our clients. I am committed to working closely with our team to develop customized sales strategies that meet the unique needs of each client. With a dedication to excellence and a passion for sales, I am excited to help take our clients businesses to the next level.')";


if ($conn->query($sql) === TRUE) {
    echo "Inserted into EMPLOYEE table. ";
} else {
    echo "Error: CANNOT Inserted into EMPLOYEE table" . $conn->error;
}

//mysqli_query($conn, $sql);
$conn->close();
?>
