<?php
require '../connect.php';
if (empty($_GET)) {
    echo "Server Error: No Item ID(s) inputted.";
  
  } elseif (isset($_GET['itemIDs'])) {
    $itemIDS=$_GET['itemIDs'];
    $itemIDS = str_replace('"', "", $itemIDS);
    $itemIDS = substr($itemIDS, 1, -1);
    $sql = "SELECT item_id, item_name, price FROM ITEMS WHERE item_id IN ($itemIDS);";
  } else {
    // Invalid Iput
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