<?php require 'redirect.php';
$order_id = $_POST['order_id'];
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
    <script>
    const url = ('http://localhost/CPS630Project/Phase01/server/APIs/getItemsByOrderID.php?' + new URLSearchParams({  orderID: '<?php echo $order_id?>'}).toString());
    fetch(url)
      .then(res => res.json())
      .then(data => {
        data.forEach(item => {
          const item_info = ` <figure>
                                    <img width=100px height=100px style="object-fit:cover;" src=${item.img_url} alt=${item.item_name}>
                                    <figcaption> <br> ${item.item_name} <br> $${item.price}</figcaption>
                              </figure>
                              <p hidden>Item ID:  &nbsp <input style="border-width: 0px;" type="number" name="item_id_${item.item_id}" value="${item.item_id}" readonly></p>
                              <p>Review &nbsp <input style="border-width: thin;" type="text" name="review_${item.item_id}"></p>
                              <p>Rank (between 1 and 5): &nbsp <input type="number" id="rank" name="rank_${item.item_id}" min="1" max="5"></p>
                              <hr>
                              `;

          document.querySelector("#items_list").insertAdjacentHTML('beforeend', item_info);
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
    
    <form action="../server/submit-review.php" method="POST">
        <h3 style="text-align: center;">Review Your Order</h3>
        <div id="items_list"></div>
        <p hidden>Order ID <input style="border-width: 0;" type="number" name="orderID" value="<?php echo $order_id?>"></p>
        <p>How was our service? (between 1 and 5): &nbsp <input type="number" id="service_rank" name="service_rank" min="1" max="5"></p>
        <input type="submit" style="background-color: #1d1a31ff; padding: 10px;" value="Submit Review">
    </form>
    </main>
    <div id="footer"></div>
</body>

</html>