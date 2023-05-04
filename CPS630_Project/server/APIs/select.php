<?php

require '../connect.php';

// #1 URL select.php/getTables
if (strpos($_SERVER['REQUEST_URI'], '/getTables') !== false) {
  // Query the database for all table names
  $tables = array();
  $result = $conn->query("SHOW TABLES");
  while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
  }

  // Return the table names as JSON
  header('Content-Type: application/json');
  echo json_encode($tables);
}
// #2 URL select.php/getColumns?table=''
elseif (strpos($_SERVER['REQUEST_URI'], '/getColumns') !== false) {
  // The requested URL includes /getColumns
  $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
  parse_str($query, $params);
  
  if (isset($params['table'])) {
    // Query the database for the columns in the specified table
    $table_name = $params['table'];
  $columns = array();
  $result = $conn->query("SHOW COLUMNS FROM $table_name");
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

// #3 URL select.php?table=''&column=''
elseif (isset($_GET['table']) && isset($_GET['column'])) {

  $table = $_GET['table'];
  $column = $_GET['column'];

  $sql = "SELECT $column FROM $table" ;
  $result = mysqli_query($conn, $sql);

  $rows = array();

  // Loop through each row and add to results array
  while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
  }

  // Set response headers
  header('Content-Type: application/json');

  // Output results as JSON
  echo json_encode($rows,JSON_PRETTY_PRINT);
 
}


// Invalid endpoint
else {
  header('HTTP/1.1 404 Not Found');
  echo 'Invalid API endpoint';
}

// Close the database connection
$conn->close();

?>



