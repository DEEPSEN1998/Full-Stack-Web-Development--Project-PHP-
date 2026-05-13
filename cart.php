


<?php
$cart = $_SESSION['cart'];
?>




    <style>
	    
        .cart_page .product-featured {
            padding: 20px;
        }
        
        .cart_page .showcase-title {
            font-size: 24px;
            margin: 5px 0;
        }
        .cart_page .price-box {
            font-size: 16px;
            color: red;
        }
        .cart_page .add-cart-btn {
            margin-top: 10px;
        }
		.cart{
		width:70%;
		margin:16px auto;
		background-color:#fff;
		}
		.cart  img{
		width:100%;
		aspect-ratio:16/9;
		padding:8px;
		object-fit: contain;
		}
		
		@media (max-width:600px){
		  .w3-col.s6{
		  width:100% !important;
		  .showcase-title{
		  text-align:center;
		  padding:4px 4px;
		  }
		  .w3-small{
		  text-align:justify;
		  padding:4px 4px;
		  margin:2px;
		  }
		  
		   .w3-button{
		 justify-content: center;
         display: flex;
         margin-left: 65px;
         margin-bottom: 8px;
		  }
		  }  
		 
		}
    </style>


    <div class="w3-container product-featured cart_page">
        <h2 class="w3-text-red w3-center ">Shopping Cart</h2>
		<form action="" method ="post">
		<?php
		$total =0;
        $i=0;		
		foreach($cart as $k => $v){
		$qty = intval($v);
		$sql = "SELECT * FROM `product` WHERE `pid` = '" . $k . "';";
        $result = mysqli_query($con,$sql);
		while($row = mysqli_fetch_assoc($result)){
			 $images = json_decode($row['imgs_link'], true);
             $image_path = $images[0]; 
			 $original_price = (float) $row['product_price'];
             $discount_percent = (float) $row['discount'];
             $discount_amount = ($original_price * $discount_percent) / 100;
             $final_price = ($original_price - $discount_amount);
			 $total+=$final_price*$qty;
			 
			 echo'<div class="cart w3-card">
		 <div class="w3-row">
		 <div class="w3-col s6">
		   <img src="./assets/images/products/' .$image_path . '" alt="' . htmlspecialchars($row['product_name']) . '" class="">
		 
		 </div>
          
            <div class="w3-col s6">
                <h3 class="showcase-title">' . htmlspecialchars($row['product_name']) . '</h3>
                
				<p class="w3-small">' .base64_decode($row['long_des']) . '</p>
                				<label for="qty">QUANTITY</label>
								<input type="number" class="w3-input" style="max-width:128px;"  name="cart['.$i.'][qty]" value="'.$qty.'">
                                 <input type="hidden" name="cart['.$i.'][pid]" value="'.$k.'" >
								 
								   <input type="hidden" name="cart['.$i.'][amt]" value="'.$final_price.'" >
				<div class="price-box">
                   ' . number_format($final_price*$qty, 2) . ' <del class="w3-text-grey">' . number_format($qty*$original_price, 2) . '</del>
                </div>

                <a href="./?rmcart='.$k.'"><button class="w3-button  w3-red w3-round add-cart-btn" type="button">Remove</button></a>
            </div>
			</div>
        </div>';
		$i++;
		}
		
		}?>
		<!-- <div class="cart w3-card">
		 <div class="w3-row">
		 <div class="w3-col s6">
		   <img src="./assets/images/mac.jpeg" alt="MacBook Air" class="">
		 
		 </div>
          
            <div class="w3-col s6">
                <h3 class="showcase-title">MacBook Air</h3>
                <p class="w3-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis, fugiat, neque dolorem sed assumenda corporis cupiditate odio nisi harum ipsum sit aliquam voluptas aperiam magnam maiores optio earum praesentium dolore?</p>
                <div class="price-box">
                    ₹89,900.00 <del class="w3-text-grey">₹99,900.00</del>
                </div>
                <button class="w3-button  w3-red w3-round add-cart-btn">Remove</button>
            </div>
			</div>
        </div>
		
		
		
		 <div class="cart w3-card">
		 <div class="w3-row">
		 <div class="w3-col s6">
		   <img src="./assets/images/s25.jpeg" alt="Samsung S25 Ultra" class="">
		 
		 </div>
          
            <div class="w3-col s6">
                <h3 class="showcase-title">Samsung S25 Ultra</h3>
                <p class="w3-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, aliquam doloribus magnam quae veritatis provident voluptatem. Vero, amet, perferendis, voluptas quasi repellendus tempore fugit provident officiis cumque perspiciatis et ducimus.</p>
                <div class="price-box">
                    ₹181,000.00 <del class="w3-text-grey">₹191,000.00</del>
                </div>
                <button class="w3-button w3-red w3-round add-cart-btn ">Remove</button>
            </div>
			</div>
        </div>
-->
       

        

        <div class="w3-container w3-padding w3-center">
            <h3>Total: ₹<?php echo number_format($total,2);   ?></h3>
          
  <button class="w3-button w3-green w3-large w3-round" type="submit" name="checkout">Proceed to Checkout</button>


        </div>
		</form>
    </div>


