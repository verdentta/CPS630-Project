<?php
require '../connect.php';

if (empty($_GET)) {
    // return All ITEMS
    $sql = "SELECT * FROM ORDERS ORDER BY order_id DESC;";
  
  } else if (isset($_GET['userID'])) {
    // return All GENDER ITEMS
    $userID=$_GET['userID'];
    $sql = "SELECT * FROM ORDERS WHERE user_id = $userID ORDER BY order_id DESC;" ;
  
  } else {
    // Innvalid Iput
    echo "Error: Invalid query string input.";
  }
  
// Execute query
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Initialize array to hold results
    $rows = array();

    // Loop through each row and add to results array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    // Set response headers
    header('Content-Type: application/json');

    // Output results as JSON
    echo json_encode($rows,JSON_PRETTY_PRINT);
} else {
    // No rows were returned, output error message
    echo "No results found.";
}

// Close database connection
mysqli_close($conn);
?>