<?php require 'redirect.php';?>
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
            <div class="stepper-item">
              <div class="step-counter">3</div>
              <div class="step-name"><a id="plain" href="invoice.php">Review Order</a></div>
            </div>
          </div>

        <button id="back-btn" onclick="window.location.href='delivery.php'">&#60; Back</button>
        <div class="sign-up-form">
            <form action="../server/submit-payment.php" method="POST">
                <h3>Enter your Payment Details</h3>
                <label for="cname">Name on Card</label>
                <input type="text" id="cname" name="cardname" required>

                <label for="ccn">Credit Card Number:</label>
                <input id="ccn" type="tel" inputmode="numeric" pattern="[0-9\s]{16}" maxlength="16"
                    placeholder="XXXX XXXX XXXX XXXX" name="ccnumber" required>

                <label for="expdate">Expiry Date</label>
                <input type="text" pattern="(?:0[1-9]|1[0-2])/[0-9]{2}" name="expdate" placeholder="MM/YY" required>

                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" pattern="\d*" maxlength="3" placeholder="123" required>

                <label for="postal_code">Postal code/ZIP</label>
                <input type="text" id="postal_code" name="postal_code">
                <br>
                <input id="checkout-btn"  style="float:right;" type="submit" value="Review Order">
            </form>
        </div>

    </main>
    <div id="footer"></div>
</body>

</html>