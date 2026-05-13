<?php




$wishlist = $_SESSION['wishlist'] ?? [];

//var_dump($wishlist);


?>

<style>
.price-box {
  display: flex;
  align-items: center;
  gap: 10px; /* space between items */
  flex-wrap: wrap; /* allow wrap on small screens */
}
.price-box .price {
  margin: 0;
  font-weight: bold;
}
.price-box del {
  color: gray;
}
.price-box .add-cart-btn {
  margin-left: auto; /* push button to the right */
}

@media (max-width: 600px) {
  .price-box {
    flex-direction: column;
    align-items: center;
  }

  .price-box .add-cart-btn {
    margin-left: 0;
  }
}

</style>

	<div class="product-main" style="padding:10px">

            <h2 class="title">Products</h2>

            <div class="product-grid">
			
			
			
			<?php
			foreach($wishlist as $k => $v){
		
		   $sql = "SELECT * FROM `product` WHERE `pid` = '" . $k . "';";
			
        $result = mysqli_query($con,$sql);
		while($row = mysqli_fetch_assoc($result)){
			 $images = json_decode($row['imgs_link'], true);
             $image_path = $images[0]; 
			 $original_price = (float) $row['product_price'];
             $discount_percent = (float) $row['discount'];
             $discount_amount = ($original_price * $discount_percent) / 100;
             $final_price = $original_price - $discount_amount;
			
			echo '<div class="showcase">

                <div class="showcase-banner">

                  <img src="./assets/images/products/' .$image_path . '" alt="' . htmlspecialchars($row['product_name']) . '" width="300" class="product-img default">
                 

                  <p class="showcase-badge">' . $discount_percent . '% </p>

                  <div class="showcase-actions">

                   

                    

                    <a href="./?a2c='.$row['pid'].' "><button class="btn-action">
            <ion-icon name="bag-add-outline"></ion-icon>
          </button>
           </a>

                  </div>

                </div>

                <div class="showcase-content">

                  <a href="#" class="showcase-category">' . htmlspecialchars($row['category']) . '</a>

                  <a href="#">
                    <h3 class="showcase-title">' . htmlspecialchars($row['product_name']) . '</h3>
                  </a>

                  <div class="showcase-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                    <ion-icon name="star-outline"></ion-icon>
                  </div>

                  <div class="price-box">
                    <p class="price">' . number_format($final_price, 2) . '</p>
                    <del>' . number_format($original_price, 2) . '</del>
					<a href="./?rmwish='.$k.'"><button class="w3-button w3-red w3-round add-cart-btn" type="button">Remove</button></a>
                  </div>

                </div>

              </div>';
			
		}
		}
			?>

              
              
              </div>

            </div>

         

  
	<script src="./assets/js/script.js"></script>
