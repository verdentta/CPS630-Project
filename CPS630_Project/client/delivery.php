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
            <div class="stepper-item">
              <div class="step-counter">2</div>
              <div class="step-name"><a id="plain" href="billing.php">Billing</a></div>
            </div>
            <div class="stepper-item">
              <div class="step-counter">3</div>
              <div class="step-name"><a id="plain" href="invoice.php">Review Order</a></div>
            </div>
          </div>

        <button id="back-btn" onclick="window.location.href='home.php'">&#60; Back</button>

        <div class="sign-up-form">
            <form action="../server/submit-delivery.php" method="POST">
                <h3>Delivery Instructions</h3>
                <label for="branch">Branch:</label>
                <select id="branch" name="branch" required>
                    <option value="6559 Chouettes Lane, Ottawa, Ontario, Canada, K1C7E6">Branch 1 - 6559 Chouettes Lane Ottawa Ontario Canada, K1C7E6</option>
                    <option value="32775 Bell Road, Niagara Region, Ontario, Canada, L0S1V0">Branch 2 - 32775 Bell Road, Niagara Region, Ontario, Canada, L0S1V0</option>
                    <option value="207 Green Lane, Markham, Ontario, Canada, L3T7H5">Branch 3 - 207 Green Lane, Markham, Ontario, Canada, L3T7H5</option>
                    <option value="4001 Steeles Avenue West, Toronto, Ontario, Canada, M3N2T8">Branch 4 - 4001 Steeles Avenue West, Toronto, Ontario, Canada, M3N2T8</option>
                    <option value="6415 Steeles Avenue East, Scarborough, Ontario, Canada, M1X1N5">Branch 5 - 6415 Steeles Avenue East, Scarborough, Ontario, Canada, M1X1N5</option>
                </select>

                <label for="delivery-date">Date & Time:</label>
                <input type="datetime-local" id="delivery-date" name="delivery-date" min="2023-01-01" max="3000-12-31" required>
                <br>
                <input id="checkout-btn"  style="float:right;" type="submit" value="Continue to Billing">
            </form>
        </div>
    </main>

    <div id="footer"></div>
</body>

</html>