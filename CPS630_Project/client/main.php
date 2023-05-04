<?php require 'redirect.php';
$username = $_SESSION['name'];?>
	
 
	    <script>
        // Remove event listeners function
function removeEventListeners(items) {
  items.forEach(item => {
    item.removeEventListener('dragstart', dragStart);
    item.removeEventListener('dragend', dragEnd);
  });
}

fetch('http://localhost/CPS630Project/Phase01/server/APIs/getItems.php')
.then(res => res.json())
.then(data => {
  data.forEach(item => {
    const items = `<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <figure>
        <img width=250px height=250px style="object-fit:cover;" src=${item.img_url} alt=${item.item_name}>
        <figcaption> <br> ${item.item_name} <br> $${item.price}</figcaption>
      </figure>
    </div>`;

    document.querySelector("#items_output").insertAdjacentHTML('beforeend', items);
  });

  const items = document.querySelectorAll("#items_output img");
  
  items.forEach(item => {
    item.addEventListener('dragstart', dragStart);
    item.addEventListener('dragend', dragEnd);
  });

  function dragStart(e) {
    e.dataTransfer.setData('text/plain', e.target.src);
  }

  function dragEnd(e) {
    const clone = document.querySelector('img.clone');
    if (clone) {
      clone.parentNode.removeChild(clone);
    }
  }

  const container = document.querySelector("#items_output");
  container.addEventListener('dragover', dragOver);
  container.addEventListener('dragenter', dragEnter);
  container.addEventListener('dragleave', dragLeave);
  container.addEventListener('drop', dragDrop);

  const cart = document.querySelector("#cart");
  cart.addEventListener('dragover', dragOver);
  cart.addEventListener('dragenter', dragEnter);
  cart.addEventListener('dragleave', dragLeave);
  cart.addEventListener('drop', dragDrop);

  function dragOver(e) {
    e.preventDefault();
  }

  function dragEnter(e) {
    e.preventDefault();
    this.style.border = '2px dashed #ccc';
  }

  function dragLeave() {
    this.style.border = 'none';
  }

function dragDrop(e) {
  e.preventDefault();
  const imageUrl = e.dataTransfer.getData('text/plain');
  
  // Check if the item is already in the cart
  const cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
  const isItemInCart = cartItems.some(item => item === imageUrl);
  
  if (!isItemInCart) {
    const imageElement = document.createElement('img');
    imageElement.src = imageUrl;
    imageElement.width = '30';
    imageElement.height = '30';
    
    if (this.id === 'cart') {
      document.querySelector('#cart').appendChild(imageElement);
      imageElement.addEventListener('click', removeItem);
      
      // Save the image URL to the session storage
      cartItems.push(imageUrl);
      sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
    }
  }
}

  function removeItem(e) {
    e.preventDefault();
    e.target.parentNode.removeChild(e.target);
    
    // Remove the image URL from the session storage
    const cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    const index = cartItems.indexOf(e.target.src);
    if (index > -1) {
      cartItems.splice(index, 1);
      sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
    }
  }
    removeEventListeners(items); // Remove event listeners before adding them again
    // Load the saved images from the session storage
    const cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    cartItems.forEach(imageUrl => {
      const imageElement = document.createElement('img');
      imageElement.src = imageUrl;
      imageElement.width = '30';
      imageElement.height = '30';
      document.querySelector('#cart').appendChild(imageElement);
      imageElement.addEventListener('click', removeItem);
    });
	removeEventListeners(items); // Remove event listeners before adding them again
        })
        .catch(error => {
            console.error(error);
        });
    </script>
	
	<main>
        
        <!-- <?php if ($username=="admin") { ?>
            <p style="color: #1d1a31ff; float:right; position: relative; top: -25px;"><a href="dbMaintainButton.php">DB Maintain</a></p>
        <?php } else { ?>
            <p style="color: #1d1a31ff; float:right; position: relative; top: -25px;" hidden><a href="dbMaintainButton.php">DB Maintain</a></p>
        <?php } ?> -->
        
        <h3 style="text-align: center; background-color: #f0f7eeff; padding: 5px;">All Clothes</h3>

		<div class="row justify-content-left" id="items_output">
		</div>
		
	</main>