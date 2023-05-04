<?php
require 'connect.php';
require 'shopping.php';
require 'trucks.php';
require 'trips.php';
require 'users.php';
require 'orders.php';
require 'items.php';
require 'employees.php';
require 'reviews.php';



// $sql = "CREATE TABLE ORDERS (
//     order_id INT(6) AUTO_INCREMENT PRIMARY KEY,
//     dt_issued DATE,
//     dt_received DATE,
//     total_price FLOAT(10, 2),
//     code INT(4),
//     user_id INT(6),
//     trip_id INT(6),
//     receipt_id INT(6),
//     FOREIGN KEY (user_id) REFERENCES USERS(user_id),
//     FOREIGN KEY (trip_id) REFERENCES TRIPS(trip_id),
//     FOREIGN KEY (receipt_id) REFERENCES SHOPPING(receipt_id)
//     )";

// if ($conn->query($sql) === TRUE) {
//     echo "ORDERS table created successfully. ";
// } else {
//     echo "Error creating table: " . $conn->error;
// }

// $sql = "CREATE TABLE ITEMS (
//     item_id INT(6) PRIMARY KEY,
//     item_name VARCHAR(80),
//     price FLOAT(10, 2),
//     made_in VARCHAR(30),
//     gender VARCHAR (10),
//     dept_code INT(6),
//     img_url VARCHAR(5000)
//     )";

// if ($conn->query($sql) === TRUE) {
//     echo "ITEMS table created successfully. ";
// } else {
//     echo "Error creating table: " . $conn->error;
// }

// //added this extra employee table
// $sql = "CREATE TABLE EMPLOYEE (
//     employee_id INT(6) AUTO_INCREMENT PRIMARY KEY,
//     employee_name VARCHAR(100),
//     employee_role VARCHAR(500),
//     email VARCHAR(50),
//     employee_description VARCHAR(1000)
//     )";

// if ($conn->query($sql) === TRUE) {
//     echo "EMPLOYEE table created successfully. ";
// } else {
//     echo "Error creating table: " . $conn->error;
// }

// // creating reviews table
// $sql = "CREATE TABLE REVIEWS (
//     purchasing_id INT(6) AUTO_INCREMENT PRIMARY KEY,
//     receipt_id INT(6),
//     item_id INT(6),
//     order_id INT(6),
//     user_id INT(6),
//     rank INT(6),
//     review VARCHAR(5000),
//     service_rank INT(6),
//     FOREIGN KEY (receipt_id) REFERENCES SHOPPING(receipt_id),
//     FOREIGN KEY (item_id) REFERENCES ITEMS(item_id),
//     FOREIGN KEY (order_id) REFERENCES ORDERS(order_id),
//     FOREIGN KEY (user_id) REFERENCES USERS(user_id)
//     )";

// if ($conn->query($sql) === TRUE) {
//     echo "REVIEWS table created successfully. ";
// } else {
//     echo "Error creating table: " . $conn->error;
// }

//Insert in Shopping table
$sql= "INSERT INTO SHOPPING (`receipt_id`, `store_code`, `total_price`) VALUES 
                            (111, '1234', 10.00),
                            (112, '1234', 15.00),
                            (113, '1234', 35.99)";


if ($conn->query($sql) === TRUE) {
    echo "Inserted into Shopping table. ";
} else {
    echo "Error: CANNOT Inserted into shopping table" . $conn->error;
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

// Create admin account 

// USERNAME and PASSWORDS:
// admin@gmail.com         admin123
// johnsmith@gmail.com     password
// janedoe@gmail.com       password
// marcusfancy@gmail.com   password  balance=55

$sql = "INSERT INTO `USERS` (`full_name`, `phone_number`, `email`, `user_address`, `city_code`, `login_id`, `salt_password`, `login_password`, `salt_balance`, `balance`) VALUES 
                            ('admin', '1234567891', 'admin@gmail.com', '245 Church St, Toronto, Ontario, Canada', 'M5B1Z4', 'admin', 'e6n9U8LpWcR7vD5zA2TbF1yGtK4sJhX', 'd2cbea94fa39015319405fe8b7324278', NULL, NULL),
                            ('John Smith', '4164164166', 'johnsmith@gmail.com', '1535 Eglinton Avenue, Toronto, Ontario, Canada', 'M4P1A6', 'jsmith', 'dD4aB8tK7mZ6gN9cF1jV5qS3vX2pL0x', '9b9cd1890c5f6b1c5c3bd4b27de87321', 'JwR5x2kH8cZmDqX9LpNtV7yTfPbE4aS6', 'c39969b4428d00d1d69dea64b23e75b8'),
                            ('Jane Doe', '6476470000', 'janedoe@gmail.com', '775 Merivale Road, Ottawa, Ontario, Canada', 'K2H5B6', 'jdoe', 'gV8kW2fH5sL6cQ1xZ7tJ9bD4mN0jP3y', '4473f856ff9df7422d9de06ff0e83f8c', 'G9vLcY3mTqN2jKwZ4bPzE8aD7xX6fS5', '3367326e7e78b02f38ba5756bcc5ab68'),
                            ('Marcus Fancy', '1231231234', 'marcusfancy@gmail.com', '4328 Manitoba Street, North Bay, Ontario, Canada', 'P1B2Y8', 'mfancy', 'uF5aW1tG4mV0cH8lP7pJ6jK3qS9nB2y', '0c31dbdef6db09d19d0af68dba82ee6f', 'F4sN6gH5cTzP7wVjKxR8bL1qY2mX9tD', 'e036d0268ab1bf295d859c39cfec6905');";

if ($conn->query($sql) === TRUE) {
    echo "Inserted into USERS table. ";
} else {
    echo "Error: CANNOT Inserted into USERS table" . $conn->error;
}


// Insert trucks (2 per branch)
$sql = "INSERT INTO `TRUCKS` (`truck_id`, `truck_code`, `avail_code`) VALUES 
                            (456, 'TRUCK1', 'AVAILABLE'),
                            (457, 'TRUCK2', 'AVAILABLE'),
                            (458, 'TRUCK3', 'AVAILABLE'),
                            (459, 'TRUCK4', 'MAINTENANCE'),
                            (460, 'TRUCK5', 'AVAILABLE'),
                            (461, 'TRUCK6', 'AVAILABLE'),
                            (462, 'TRUCK7', 'AVAILABLE'),
                            (463, 'TRUCK8', 'AVAILABLE'),
                            (464, 'TRUCK9', 'MAINTENANCE'),
                            (465, 'TRUCK10', 'MAINTENANCE');";


if ($conn->query($sql) === TRUE) {
    echo "Inserted into TRUCKS table. ";
} else {
    echo "Error: CANNOT Inserted into TRUCKS table" . $conn->error;
}

//mysqli_query($conn, $sql);
$conn->close();
?>
