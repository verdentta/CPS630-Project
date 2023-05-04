<!DOCTYPE html>
<html>

<head>
    <title>Smart Customer Services</title>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="icon" href="images/logo-favicon-white.png">
	<link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
   
    <script>
    fetch('http://localhost/CPS630Project/Phase01/server/APIs/getReviews.php')
      .then(res => res.json())
      .then(data => {
        data.forEach(item => {
          const review_info =`
                                <figure style="float:left;" >
                                  <img width=150px height=150px style="object-fit:cover; margin-right:50px;" src=${item.img_url} alt=${item.item_name}>
                                  <figcaption>${item.item_name}</figcaption>
                                </figure>
                              <p style="text-align: left;" ><br>Rating:&nbsp${item.rank}/5<br>Service Rating:&nbsp${item.service_rank}/5<br>${item.review}<br><br><span style="color:gray; font-size: small;">Reviewed By: ${item.full_name}</span><p>
                              <br><br><br><hr><br><br>
                            `;

          document.querySelector("#reviews").insertAdjacentHTML('beforeend', review_info);
        });
      })
      .catch(error => {
        console.error(error);
      });
  </script>
</head>

<body>
    
    <main>
    <h3 style="text-align: center; background-color: #f0f7eeff; padding: 5px;">Reviews</h3>

        <div style="overflow-y: scroll; height:800px;" id="reviews"></div>
		<button style="text-align: center; background-color: #1d1a31ff;  padding: 5px; id="back-btn" onclick="window.location.href='home.php'">&#60; Go Back Home</button>
    </main>
  
</body>

</html>