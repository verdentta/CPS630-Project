<?php require 'redirect.php';
$user_id = $_SESSION['user_id'];
$username = $_SESSION['name'];
$msg = $_SESSION['order_msg'];
$order_num = $_SESSION['orderID'];
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
	fetch('http://localhost/CPS630Project/Phase01/server/APIs/getOrders.php?' + new URLSearchParams({  userID: '<?php echo $user_id?>'}).toString())
      .then(res => res.json())
      .then(data => {
        data.forEach(order => {
          const order_info = `<div class="order">
                            <h4>Order #${order.order_id}</h4>
                            <form action="write-review.php" method="POST">
                              <p hidden>Order ID: <input type="number" style="border: 0px;" id="order_id" name="order_id" value="${order.order_id}" readonly></p>
                              <p>Total Price: ${order.total_price}</p>
                              <p>Date Ordered: ${order.dt_issued}</p>
                              <p>Delivery Date: ${order.dt_received}</p>
                              <p>Ordered By User: ${order.user_id}</p>
                              <input type="submit" style="background-color: #1d1a31ff; padding: 10px;" value="Review this Order">
                            </form>
                            <hr>
                            </div>`;

          document.querySelector("#order_output").insertAdjacentHTML('beforeend', order_info);
        });
      })
      .catch(error => {
        console.error(error);
      });
  </script>


<body>
  <div id="header"></div>
  <main>
    
    <?php if ($msg==true) { ?>
          <section>
              <p style="color: green;" >Payment Successful!</p>
              <p style="color: green;" > Thank you for ordering from SCS, your Order number is <?php echo $order_num?>.</p>
              <?php $_SESSION['order_msg']=false;?>
            </section>
        <?php }?>
    
    

    <form id="form" action="orders-submit.php" method="get"> 
        <input type="text" id="userID" style="width: 50px; border: 1px solid gray; border-radius: 0; padding: 1px;" name="userID" style="opacity:0.5;" readonly />
        <input type="search" id="order"style="width: 150px; border: 1px solid gray; border-radius: 0; padding: 1px;" name="order" placeholder="Search by orderID...">
        <input type="submit" style="width: 100px; border: 1px solid gray; padding: 3px;" value="Search">
    </form>
    
    <script>
       var userID = <?php echo $_SESSION['user_id']; ?>;
        document.getElementById("userID").value = userID;
    </script>

    <div id="order_output"></div>
	<button style="text-align: center; background-color: #1d1a31ff;  padding: 5px; id="back-btn" onclick="window.location.href='home.php'">&#60; Go Back Home</button>

</main>
  <div id="footer"></div>
</body>

</html>

