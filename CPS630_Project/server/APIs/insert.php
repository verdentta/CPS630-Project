<?php
//http://localhost/Project/server/APIs/insert.php?table=Employee&columns={%22employee_name%22:%22shiv%22,%22employee_role%22:%22gg%22,%22email%22:%22s@gmail.com%22,%22employee_description%22:%22hihi%22}
// Get the POST request data
require '../connect.php';
if (strpos($_SERVER['REQUEST_URI'], '/getColumns') !== false) {
        // The requested URL includes /getColumns
    $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    parse_str($query, $params);
    
    if (isset($params['table'])) {
        // Query the database for the columns in the specified table
        $table_name = $params['table'];
    $columns = array();
    $result = $conn->query("SHOW COLUMNS FROM $table_name WHERE `Key` != 'PRI'"); //So that it doesnt return primary keys
    while ($row = $result->fetch_array()) {
        $columns[] = $row[0];
    }

    // Return the columns as JSON
    header('Content-Type: application/json');
    echo json_encode($columns);
        // The URL contains a table parameter
        // Do something with the $params['table'] value
    }
}
else{
    $table = $_GET['table'];
    $columns = $_POST['columns'];
    $columns = json_decode($_GET['columns'], true);


    echo 'Table: ' . $table . '<br>';
    echo 'Columns: ' . print_r($columns, true);

    

    // Construct the SQL query
    $sql = "INSERT INTO " . $table . " (";
    foreach ($columns as $key => $value) {
        $sql .= $key . ",";
    }
    $sql = rtrim($sql, ",");
    $sql .= ") VALUES (";
    foreach ($columns as $key => $value) {
        $sql .= "'" . $value . "',";
    }
    $sql = rtrim($sql, ",");
    $sql .= ")";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Columns inserted successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to insert columns'));
    }
}



// Close the database connection
mysqli_close($conn);

?>


