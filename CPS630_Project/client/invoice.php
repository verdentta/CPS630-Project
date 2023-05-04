<?php require 'redirect.php';
// get all session varibles 
$shipping_address = $_SESSION['shipping_address'];
$branch = $_SESSION['branch'];
$ccnumber = $_SESSION['ccnumber'];
$datetime = $_SESSION['datetime'];
$name = $_SESSION['name'];
$userID = $_SESSION['user_id'];
$email = $_SESSION['email'];
$price = $_SESSION['total_price'];
$city_code = $_SESSION['city_code'];
$source_code = substr($branch, -6);
$itemIDS = $_SESSION['item_ids'];

// check if coupon was applied
$coupon_msg = $_SESSION['coupon_msg'];

// calculate tax
$taxRate = 13;
$tax = $price*$taxRate/100;
$total_price = $price + $tax;
?>
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

<script type="text/javascript">
    function initMap(){
      var directionsService = new google.maps.DirectionsService();
      var directionsRenderer = new google.maps.DirectionsRenderer();
      var start = <?=json_encode($branch, JSON_THROW_ON_ERROR);?>;
      var end = <?=json_encode($shipping_address, JSON_THROW_ON_ERROR);?>;
      var request = {
        origin: start,
        destination: end,
        travelMode: 'DRIVING'
      };
      directionsService.route(request, function(result, status) {
        if (status == 'OK') {
          var map = new google.maps.Map(document.getElementById("map"));
          directionsRenderer.setMap(map);
          directionsRenderer.setDirections(result);
          var distance = result.routes[0].legs[0].distance.value / 1000;
          document.getElementById("distance").value = distance;
        } else {
          alert('Directions render was not successful for the following reason: ' + status);
        }
      });  
    }
</script>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNvUT1DzGT2dQD6813E0j55Q2vCkU56N0&callback=initMap&libraries=places&v=weekly"
        async
        ></script>
        <script>
	fetch('http://localhost/CPS630Project/Phase01/server/APIs/getItemsByItemID.php?' + new URLSearchParams({  itemIDs: '<?php echo $itemIDS?>'}).toString())
      .then(res => res.json())
      .then(data => {
        data.forEach(item => {
          const item_info = `<tr>
                              <td style="text-align: left;">${item.item_name} </td>
                              <td style="text-align: left;">$${item.price} </td>
                              </tr>
                            `;

          document.querySelector("#item_output").insertAdjacentHTML('beforeend', item_info);
        });
      })
      .catch(error => {
        console.error(error);
      });
  </script>

<body>
    <div id="header"></div>
    <main>
        <div class="stepper-wrapper">
            <div class="stepper-item completed">
              <div class="step-counter">1</div>
              <div class="step-name"><a id="plain" href="delivery.php">Delivery</a></div>
            </div>
            <div class="stepper-item completed">
              <div class="step-counter">2</div>
              <div class="step-name"><a id="plain" href="billing.php">Billing</a></div>
            </div>
            <div class="stepper-item completed">
              <div class="step-counter">3</div>
              <div class="step-name"><a id="plain" href="invoice.php">Review Order</a></div>
            </div>
          </div>
        
        <button id="back-btn" onclick="window.location.href='billing.php'">&#60; Back</button>
        


        <div style="margin-bottom: 100px;">
        <h2>Order Summary</h2>
        <hr>
          <form id="form" action="../server/placeOrder.php" method="POST"> 
              <h3>Items</h3>
              <table id="item_output" style="border:none;" >
              </table>
              <table id="additional-costs" style="border: none; background-color: white;">
              <tr>
                  <td style="text-align: right;  width:69%">Coupon Applied: </td>
                  <td style="text-align: left;  width:69%"><?php echo $coupon_msg; ?>  </td>
                </tr> 
                <tr>
                  <td style="text-align: right;  width:69%; background-color: white;">Taxes: </td>
                  <td style="text-align: left;  width:69%; background-color: white;"> $<?php echo number_format((float)$tax, 2, '.', ''); ?></td>
                </tr> 
                <tr>
                  <td style="text-align: right;  width:69%; background-color: #ededed;">Total Cost: </td>
                  <td style="text-align: left;  width:69%; background-color: #ededed;"> $<?php echo number_format((float)$total_price, 2, '.', ''); ?></td>
                </tr> 
              </table>
              <p hidden>Item IDs:<input type="text" style="border: 0px;" id="itemIds" name="itemIds" value=<?php echo $itemIDS; ?> readonly></p>
              <p hidden>Total Cost: $<input style="border: 0px;" type="text" name="total" value=<?php echo number_format((float)$total_price, 2, '.', ''); ?> readonly></p>
              <hr>
              <h3>Your Information</h3>
              <p hidden>User ID: <input style="border: 0px; margin: 0px;" type="text" name="userid" value=<?php echo $userID; ?> readonly></p>
              <p>Name: <input style="border: 0px; margin: 0px;" type="text" name="user_name" value=<?php echo $name; ?> readonly></p>
              <p>Email: <input style="border: 0px;" type="text" name="user_email" value=<?php echo $email; ?> readonly></p>
              <p>Shipping Address: <?php echo "$shipping_address,"; ?> <?php echo $city_code; ?></p> 
              <p>Payment: **** **** **** <input style="border: 0px;" type="text" id="ccnumber" name="ccnumber" value=<?php echo substr($ccnumber, -4); ?> readonly></p>
              <hr>
              <h3>Delivery Information</h3>
              <p>Selected Branch: <?php echo $branch; ?> </p>
              <p hidden>Branch Code: <input style="border: 0px;" type="text" id="source_code" name="source_code" value="<?php echo $source_code; ?>" readonly></p>
              <p>Date: <input style="border: 0px;" type="text" id="date" name="date" value=<?php echo strtok($datetime, 'T'); ?> readonly></p>
              <p>Time: <input style="border: 0px;" type="text" id="time" name="time" value=<?php echo substr($datetime, strpos($datetime, "T") + 1); ?> readonly></p>
              <p hidden>Distance: <input style="border: 0px;" type="text" id="distance" name="distance" readonly></p>
              
              <input id="checkout-btn"  style="float:left;" type="submit" value="Place Order">
          </form>
          <div id="map"></div><br>
        </div>
        
    </main>
    <div id="footer"></div>

    
</body>

</html>