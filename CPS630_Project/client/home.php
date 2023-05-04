<?php require 'redirect.php';
$username = $_SESSION['name'];?>
<!DOCTYPE html>
<html>
<head>
    <title>Smart Customer Services</title>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="icon" href="images/logo-favicon-white.png">
	<link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
    <script> 
        $(function(){
          $("#header").load("header.html"); 
          $("#footer").load("footer.html"); 
        });
    </script> 
</head>
<body ng-app="myApp">
	<div id="header"></div>
	<br>
	<p style="color: #1d1a31ff; float:left; position: relative; top: -25px; ">Welcome, <?php echo $username; ?> </p>
        <?php if ($username=="admin") { ?>
            <p style="color: #1d1a31ff; float:right; position: relative; top: -25px;"><button><a href="dbMaintainButton.php">DB Maintain</a></button></p>
        <?php } else { ?>
            <p style="color: #1d1a31ff; float:right; position: relative; top: -25px;" hidden><button><a href="dbMaintainButton.php">DB Maintain</a></button></p>
        <?php } ?>
	
	<div ng-view></div>
	<script>
var app = angular.module("myApp", ["ngRoute"]);
app.config(function($routeProvider) {
    $routeProvider
	.when("/", {
        templateUrl : "main.php",
    })
    .when("/home", {
        templateUrl : "main.php",
    })
    .when("/about", {
        templateUrl : "about.php",
    })
	.when("/contactus", {
        templateUrl : "contactus.php",
    })
    .when("/cart", {
        templateUrl : "cart.php",
    })
	.when("/womensall", {
        templateUrl : "womensall.php",
    })
	.when("/orders", {
        templateUrl : "orders.php",
    })
	.when("/reviews", {
        templateUrl : "reviews.php",
    })
	.when("/mensall", {
        templateUrl : "mensall.php",
    })
	.when("/womenstops", {
        templateUrl : "womenstops.php",
    })
    .when("/womensbottoms", {
        templateUrl : "womensbottoms.php",
    })
    .when("/womensactivewear", {
        templateUrl : "womensactivewear.php",
    })
	.when("/womensouterwear", {
        templateUrl : "womensouterwear.php",
    })
	.when("/menstops", {
        templateUrl : "menstops.php",
    })
    .when("/mensbottoms", {
        templateUrl : "mensbottoms.php",
    })
    .when("/mensactivewear", {
        templateUrl : "mensactivewear.php",
    })
	.when("/sign-in", {
        templateUrl : "sign-in.php",
    })
	.when("/mensouterwear", {
        templateUrl : "mensouterwear.php",
    });
});
</script>
</body>
	
	<div id="footer"></div>
</html>

