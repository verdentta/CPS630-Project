<?php

require '../connect.php';

// #1 URL delete.php
if (isset($_GET['table']) && isset($_GET['idName'])&& isset($_GET['idValue'])) {

  $table= $_GET['table'];
  $idName= $_GET['idName'];
  $idValue= $_GET['idValue'];
 
  $sql = "DELETE FROM $table WHERE $idName = $idValue;" ;

  if (mysqli_query($conn, $sql)) {
      echo json_encode(array('status' => 'success', 'message' => 'Record deleted successfully'));
  } else {
      echo json_encode(array('status' => 'error', 'message' => 'Failed to delete Row'));
  }

}

// Close the database connection
$conn->close();

?>



