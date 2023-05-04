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

	
	</head>

<body>
    <div id="header"></div>
    <main>
       
        <div id="cart">
  <h2>Your shopping cart</h2>
  <div id="cart-items"></div>
</div>
<div id="matching-items">
  <h2>Matching items</h2>
</div>

		<script>
  // Define a function to calculate the total cost
	 calculateTotalCost = (cartItemCounts, itemMap) => {
		let totalCost = 0;
		cartItemCounts.forEach((count, imageUrl) => {
		const item = itemMap.get(imageUrl);
		if (item) {
				totalCost += item.price * count;
			}
		});
		return totalCost;
		}

  // Load the saved images from the session storage
   cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];

  // Fetch the items from the server
  fetch('http://localhost/CPS630Project/Phase01/server/APIs/getItems.php')
    .then(res => res.json())
    .then(items => {
      // Create a map of items based on the img_url
      const itemMap = new Map();
      items.forEach(item => itemMap.set(item.img_url, item));

      // Count the quantity of each item in the cart
      const cartItemCounts = new Map();
      cartItems.forEach(imageUrl => {
        cartItemCounts.set(imageUrl, (cartItemCounts.get(imageUrl) || 0) + 1);
      });

      // Display the matching items
      const matchingItemsTable = document.createElement('table');
      matchingItemsTable.classList.add('matching-items-table');
      const headerRow = matchingItemsTable.insertRow();
      headerRow.insertCell().textContent = 'Image';
      headerRow.insertCell().textContent = 'Name';
      headerRow.insertCell().textContent = 'Price';
      headerRow.insertCell().textContent = 'Quantity';
      headerRow.insertCell().textContent = 'Total';
      headerRow.insertCell().textContent = 'Delete';
      let totalCost = 0;
      // create array for checkout item ID's
      var itemIds = [];
      cartItemCounts.forEach((count, imageUrl) => {
        const item = itemMap.get(imageUrl);
        if (item) {
          // get itemId to pass to reviews/shopping table after order is placed
          const itemId = item.item_id;
          itemIds.push(itemId);
          const row = matchingItemsTable.insertRow();
          const imageCell = row.insertCell();
          const imageElement = document.createElement('img');
          imageElement.src = item.img_url;
          imageElement.width = 100;
          imageElement.height = 100;
          imageCell.appendChild(imageElement);
          const nameCell = row.insertCell();
          nameCell.textContent = item.item_name;
          const priceCell = row.insertCell();
          priceCell.textContent = `$${item.price}`;
		  
          const quantityCell = row.insertCell();
          const quantityInput = document.createElement('input');
          quantityInput.type = 'number';
          quantityInput.min = 1;
          quantityInput.value = count;
		  quantityInput.addEventListener('input', () => {
            // Update the quantity and total cost when the input changes
            const newCount = Number(quantityInput.value);
            cartItemCounts.set(imageUrl, newCount);
            sessionStorage.setItem('cartItems', JSON.stringify(Array.from(cartItemCounts.keys())));
            const newTotalCost = calculateTotalCost(cartItemCounts, itemMap);
            totalCostElement.value = `${newTotalCost.toFixed(2)}`;
            totalCell.textContent = `$${(item.price * newCount).toFixed(2)}`;
          });
          quantityCell.appendChild(quantityInput);
          const totalCell = row.insertCell();
          totalCell.textContent = `$${(item.price * count).toFixed(2)}`;
          
		  const deleteCell = row.insertCell();
          const deleteButton = document.createElement('button');
		  deleteButton.textContent = 'Delete';
		  deleteButton.addEventListener('click', () => {
            // Remove the item from the cart and update the display
            cartItemCounts.delete(imageUrl);
            sessionStorage.setItem('cartItems', JSON.stringify(Array.from(cartItemCounts.keys())));
            row.remove();
			if (cartItemCounts.size === 0) {
  refreshPage();
}
            const newTotalCost = calculateTotalCost(cartItemCounts, itemMap);
            totalCostElement.value = `${newTotalCost.toFixed(2)}`;
            // Update itemIds array if item is removed
            const removeItem = itemMap.get(imageUrl);
            const removeItemId = item.item_id;
            var index = itemIds.indexOf(removeItemId);
            if (index !== -1) {
              itemIds.splice(index, 1);
            }
            itemIdsElement.value = JSON.stringify(itemIds);
          });
          deleteCell.appendChild(deleteButton);
          totalCost += item.price * count;
        }
      });
	  
      const matchingItemsContainer = document.querySelector('#matching-items');
      matchingItemsContainer.innerHTML = '';
      matchingItemsContainer.appendChild(matchingItemsTable);

      // Display the total cost and pass to PHP form
      const totalCostElement = document.querySelector('#totalcost');
      totalCostElement.value = `${totalCost.toFixed(2)}`;

      // Pass itemIds array to PHP form
      const itemIdsElement = document.querySelector('#itemIds');
      itemIdsElement.value = JSON.stringify(itemIds);
    });

	var isCouponApplied = false;

function applyCoupon() {
  if (isCouponApplied) {
    alert('Coupon code has already been used');
    return;
  }

  const couponCode = document.querySelector('#coupon').value;
  const totalCostElement = document.querySelector('#totalcost');
  const totalCost = parseFloat(totalCostElement.value);

  // Check if the coupon code is valid
  if (couponCode === 'free') {
    // Apply the discount
    let discountedTotalCost = totalCost * 0.75;
    totalCostElement.value = discountedTotalCost.toFixed(2);
    isCouponApplied = true; // Set the variable to true
  } else {
    alert('Invalid coupon code');
  }
}

function refreshPage() {
  window.location.reload();
}
</script>

<form action="../server/start-checkout.php" method="POST">
        <p>Total cost: $<input type="text" style="border: 0px;" id="totalcost" name="total" readonly></p>
        <p hidden>Item IDs:<input type="text" style="border: 0px;" id="itemIds" name="itemIds" readonly></p>
        <p>
          Coupon code: <input type="text" name="coupon" id="coupon">
          <button type="button" onclick="applyCoupon()">Apply</button>
        </p>
        <br>
        <input id="checkout-btn" type="submit" value="Checkout">
    </form>
 </main>
    
</body>

</html>
