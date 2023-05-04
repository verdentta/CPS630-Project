<?php

require '../connect.php';

// #1 URL update.php/getTables
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

// #2 URL select.php/getID?table=''
elseif (strpos($_SERVER['REQUEST_URI'], '/getID') !== false) {
 
  if (isset($_GET['table'])) {
    $table_name = $_GET["table"];
    // Define the SQL query
    $sql = "SELECT column_name 
            FROM information_schema.columns 
            WHERE table_name = '$table_name' AND column_key = 'PRI';";

    // Execute the SQL query and get the result set
    $result = $conn->query($sql);

    // Process the result set
    if ($result->num_rows > 0) {
        // Output the primary key column name(s)
        while ($row = $result->fetch_assoc()) {
            
            header('Content-Type: application/json');
            echo json_encode($row["column_name"]);
        }
    } else {
        echo "No primary key found.";
    }

  }
  
}

//getRecord?table=''&id=''
elseif (strpos($_SERVER['REQUEST_URI'], '/getRecord') !== false) {
  // The requested URL includes /getColumns
   
  if (isset($_GET['table']) && isset($_GET['id'])) {
            // Get the table name and ID key name from the URL parameters
      $table_name = $_GET['table'];
      $id_name = $_GET['id'];

      // Query to get the primary key name
      $sql = "SELECT column_name
              FROM information_schema.columns
              WHERE table_name = '$table_name'
              AND column_key = 'PRI'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Fetch the primary key name from the result
        $row = $result->fetch_assoc();
        $primary_key_name = $row["column_name"];
      } else {
        echo "No primary key found for this table";
      }

      // Use the primary key name in a SQL query
      $sql = "SELECT *
              FROM $table_name
              WHERE $primary_key_name = $id_name";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Fetch all rows as an array
        $rows = array();
        while($row = $result->fetch_assoc()) {
          $rows[] = $row;
        }

        // Convert the array to JSON and output it
      
        $json_data = json_encode($rows);
        header('Content-Type: application/json'); //We want to remove it bc we dont want to update the key!!!
        $data = json_decode($json_data, true);  // Decode the JSON string into a PHP array
        $object = array_shift($data);           // Remove the first object from the array
        array_shift($object);                   // Remove the first key-value pair from the object
        array_unshift($data, $object);          // Add the modified object back to the array
        $json_data = json_encode($data);        // Encode the modified array into JSON
        echo $json_data;
      } else {
        echo "0 results";
      }


  }
}




else{
    $table = $_GET['table'];
    $columns = $_GET['columns'];
    $columns = json_decode($_GET['columns'], true);
    $primary_key_name = $_GET['key'];
    $id_name = $_GET['id'];
    

    echo 'Table: ' . $table . '<br>';
    echo 'Columns: ' . print_r($columns, true) . '<br>';
    echo 'Primary key name: ' . $primary_key_name . '<br>';
    echo 'id name: ' . $id_name . '<br>';

    $sql = "UPDATE " . $table . " SET ";
    foreach ($columns as $key => $value) {
        $sql .= $key . " = '" . $value . "',";
    }
    $sql = rtrim($sql, ",");
    $sql .= " WHERE " . $primary_key_name . " = " . $id_name; //id = input, $primary_key_name = $id_name
    $sql .= ";";

    echo 'sql: ' . $sql . '<br>';


    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Columns inserted successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to insert columns'));
    }
}

// Close the database connection
$conn->close();

?>



