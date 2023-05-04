<?php
require '../connect.php';



if (empty($_GET)) {
  // return All ITEMS
  $sql = "SELECT * FROM ITEMS";

} else if (isset($_GET['gender']) && !isset($_GET['dept_code'])) {
  // return All GENDER ITEMS
  $gender=$_GET['gender'];
  $sql = "SELECT * FROM ITEMS WHERE gender= $gender" ;

} else if (isset($_GET['gender']) && isset($_GET['dept_code']) && count($_GET) === 2) {
  // return specific gender and deptcode
  $gender=$_GET['gender'];
  $dept_code=$_GET['dept_code'];
  $sql = "SELECT * FROM ITEMS WHERE gender= $gender AND dept_code=$dept_code" ;
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
