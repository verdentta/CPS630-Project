<?php
require '../connect.php';
if (empty($_GET)) {
    echo "Server Error: No Order ID inputted.";
  
  } else if (isset($_GET['orderID'])) {
    $order_id=$_GET['orderID'];
    $sql = "SELECT * FROM REVIEWS WHERE order_id = '$order_id'" ;
  } else {
    // Invalid Iput
    echo "Error: Invalid query string input.";
  }
  
// Execute query
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Initialize array to hold results
    $item_ids = array();

    // Loop through each row and add to results array
    while ($row = mysqli_fetch_assoc($result)) {
        $item_ids[] = $row['item_id'];
    }
    
    $rows = array();
    foreach ($item_ids as &$value) {
        $sql = "SELECT * FROM `ITEMS` WHERE `item_id` = '$value';";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }
    }
    // Set response headers
    header('Content-Type: application/json');

    // Output results as JSON
    echo json_encode($rows, JSON_PRETTY_PRINT);

} else {
    // No rows were returned, output error message
    echo "No results found.";
}
// Close database connection
mysqli_close($conn);
?>
