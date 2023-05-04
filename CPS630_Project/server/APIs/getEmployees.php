<?php
require '../connect.php';
$sql = "SELECT * FROM EMPLOYEE";

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
