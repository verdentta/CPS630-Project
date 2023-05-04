<?php
require 'connect.php';
// Retrieve data from form
$order_id = $_POST['orderID'];
$service_rank = $_POST['service_rank'];

$sql = "SELECT * FROM REVIEWS WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $sql);
// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Initialize array to hold results
    $rows = array();

    // Loop through each row and add to results array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row['item_id'];
    }

    // $items = array();
    foreach ($rows as &$value) {
        $item_id = $_POST['item_id_'.$value];
        $review = $_POST['review_'.$value];
        $rank = $_POST['rank_'.$value];

        $sql = "UPDATE REVIEWS
                SET review = '$review', rank = '$rank', service_rank = '$service_rank'
                WHERE order_id = '$order_id' AND item_id = $item_id";

       if ($conn->query($sql) === TRUE) {
        // Redirect to reviews page
        header('Location: ../client/reviews.php');
        } else {
            echo "Error submitting review: " . $conn->error;
        }
    }

}

exit(); 
$conn->close();
?>