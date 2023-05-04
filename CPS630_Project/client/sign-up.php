<!DOCTYPE html>
<html>

<head>
  <title>Smart Customer Services</title>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="icon" href="images/logo-favicon-white.png">
	<link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script> 
        $(function(){
          $("#header").load("header.html"); 
          $("#footer").load("footer.html"); 
        });
    </script> 
</head>

<body>
  <div id="header"></div>

    <h1 style="text-align: center;">Sign Up</h1>
    <div class="sign-up-form">
     <form action="../server/signup.php" method="POST">
        <label for="full-name">Full Name:</label>
        <input type="text" id="full-name" name="full-name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="phone-number">Phone Number:</label>
        <input type="tel" id="phone-number" name="phone-number" required><br> 

        <label for="address">Address</label>
        <input type="text" id="address" name="address" size="50" placeholder="123 Street, City, State, Country" required><br>

        <input type="submit" value="Sign Up">
    </form>   
    <p>Already have an account? </p>
    <button onclick="window.location.href='sign-in.php'">Sign In</button>
    </div>
    <div id="footer"></div>
</body>

</html>
