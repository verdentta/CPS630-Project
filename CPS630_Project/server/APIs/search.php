<?php

require '../connect.php';

if (isset($_GET['userID']) && isset($_GET['order'])) {

    $userID = $_GET['userID'];
    $orderID = $_GET['order'];
  
    $sql = "SELECT * FROM ORDERS WHERE order_id=$orderID AND user_id=$userID" ;
    $result = mysqli_query($conn, $sql);
  
    $rows = array();
  
    // Loop through each row and add to results array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
  
    // Set response headers
    header('Content-Type: application/json');
  
    // Output results as JSON
    echo json_encode($rows);
   
  }
// Invalid endpoint
else {
  header('HTTP/1.1 404 Not Found');
  echo 'Invalid API endpoint';
}

// Close the database connection
$conn->close();

?>



