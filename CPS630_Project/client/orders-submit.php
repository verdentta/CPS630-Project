<?php require 'redirect.php';
    $userID = $_GET['userID'];
    $orderID = $_GET['order'];
    $username = $_SESSION['name'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Your Orders</title>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="icon" href="images/logo-favicon-white.png">
  <link rel="stylesheet" href="style.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script>
    $(function () {
      $("#header").load("header.html");
      $("#footer").load("footer.html");
    });
  </script>
  <script>
    const url = ('http://localhost/CPS630Project/Phase01/server/APIs/search.php?' + new URLSearchParams({order:<?php echo $orderID;?>, userID:<?php echo $userID;?>}).toString());
    fetch(url)
      .then(res => res.json())
      .then(data => {
        data.forEach(order => {
          const order_info = `<div class="order">
                            <h4>${order.order_id}</h4>
                            <p>Total Price: ${order.total_price}</p>
                            <p>Date Ordered: ${order.dt_issued}</p>
                            <p>Date Delivered: ${order.dt_received}</p>
                            <p>Ordered By User: ${order.user_id}</p><hr>
                            </div>`;

          document.querySelector("#order_output").insertAdjacentHTML('beforeend', order_info);
        });
      })
      .catch(error => {
        console.error(error);
      });
  </script>
</head>

<body>
  <div id="header"></div>
  <main>
    <p style="color: #1d1a31ff; float:left; position: relative; top: -25px; ">Welcome, <?php echo $username; ?> </p>
		<?php if ($username=="admin") { ?>
            <p style="color: #1d1a31ff; float:right; position: relative; top: -25px;"><a href="dbMaintainButton.php">DB Maintain</a></p>
        <?php } else { ?>
            <p style="color: #1d1a31ff; float:right; position: relative; top: -25px;" hidden><a href="dbMaintainButton.php">DB Maintain</a></p>
        <?php } ?>
    <h1>Your Orders</h1>

    <form id="form" action="orders-submit.php" method="get"> 
        <input type="text" id="userID" style="width: 50px; border: 1px solid gray; border-radius: 0; padding: 1px;" name="userID" style="opacity:0.5;" readonly />
        <input type="search" id="order"style="width: 150px; border: 1px solid gray; border-radius: 0; padding: 1px;" name="order" placeholder="Search by orderID...">
        <input type="submit" style="width: 100px; border: 1px solid gray; padding: 3px;" value="Search">
    </form>
    
    <script>
        //WILL BE USED TO SET USERID AS GLOBAL VARIABLE AFTER USER SIGN IN
       var userID = <?php echo $_SESSION['user_id']; ?>;

        document.getElementById("userID").value = userID;
    </script>

    <div id="order_output"></div>
  </main>
  <div id="footer"></div>
</body>

</html>