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

	<center>
    <h1 style="text-align: center;">Sign In</h1>
    <div class="sign-up-form">
     <form action="../server/login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Sign In">
    </form> 

    <p>Don't have an account yet?</p>
    <button onclick="window.location.href='sign-up.php'">Sign Up</button>
    </center>	
    </div>
  
</body>

</html>
