<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<?php
$user_id = $_SESSION['user_id'];
?>

<body>

    <form id="form" action="../server/APIs/search.php" method="get"> 
        <input type="text" id="userID" name="userID" style="opacity:0.5;" readonly />
        <input type="search" id="order" name="order" placeholder="Search by orderID...">
        <input type="submit" value="Search">
    </form>
    <?php echo $_SESSION['user_id']; ?>
    <script>
        //WILL BE USED TO SET USERID AS GLOBAL VARIABLE AFTER USER SIGN IN
    //    var userID = 

        // document.getElementById("userID").value = userID;
    </script>

</body>
</html>


