
<?php




if(isset($_REQUEST['p'])){
	$pid = $_REQUEST['p'];
	
}else{
	echo 'Page request error : 404 - Not Found';
	http_response_code(404);
	exit;
}




?>



    <style>
        .product-container { max-width: 1200px; margin: auto; padding: 20px; min-height:auto;}
        .product-img { height: auto;
         object-fit: contain;
         aspect-ratio: auto;
  padding: 8px;
  width: 100%; }
        .details-table { width: 100%; border-collapse: collapse; }
        .details-table td, .details-table th { border: 1px solid #ddd; padding: 8px; }
        .details-table tr:nth-child(even){ background-color: #f2f2f2; }
        .details-table th { background-color: #f44336; color: white; text-align: left; }
        .product-header { border-bottom: 2px solid #ddd; padding-bottom: 10px; }
        .product-price { font-size: 24px; font-weight: bold; color: #333; }
		.product-des { font-size: 18px;  color: #333; }
        .discount { color: red; font-weight: bold; }
        .button { background-color: #f44336; color: white; padding: 10px; border: none; cursor: pointer; }
    </style>

    <div class="w3-container product-container">
         <?php
		$sql = "SELECT * FROM `product` WHERE `pid` = '" . $pid . "';";
        $result = mysqli_query($con,$sql);
		while($row = mysqli_fetch_assoc($result)){
			 $images = json_decode($row['imgs_link'], true);
             $image_path = $images[0]; 
			 $original_price = (float) $row['product_price'];
             $discount_percent = (float) $row['discount'];
             $discount_amount = ($original_price * $discount_percent) / 100;
             $final_price = $original_price - $discount_amount;
			 
			 
			 
			echo '<div class="w3-row w3-card w3-margin-bottom">
       <form action="" method="post">
        <div class="w3-col m4 w3-padding">
            <img src="./assets/images/products/' .$image_path . '" alt="' . htmlspecialchars($row['product_name']) . '" class="product-img">
        </div>
        
        <div class="w3-col m8 w3-padding">
		<div class="product-header w3-center">
		<h2 >' . htmlspecialchars($row['product_name']) . '</h2>
		 <p style="font-size:14px;" class="w3-text-indigo"><b>Brand : ' . ($row['brand_name']) . '</b></p>
		 </div>
            <p class="product-des" style="margin-left: 40px;">' . base64_decode($row['short_des']) . '</p>
            <p class="product-price" style="margin-left: 40px;"> ' . number_format($final_price, 2) . ' <span class="discount">(' . intval($discount_percent) . '% off)</span></p>
            <p style="margin-left: 40px;"><b>MRP:</b> ₹ ' . number_format($original_price, 2) . ', You save ₹ ' . number_format($discount_amount, 2) . '</p>
            
            <label style="margin-left: 40px;">Quantity:</label>
            <select class="w3-select" style="width: 100px;" style="margin-left: 40px;" name="qty">';

            for ($i = 1; $i <= $row['quantity']; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }

    echo '  </select>
	             <input type="hidden" name="pid" value="'.$row['pid'].'">
				<button class="w3-button button" name="a2c" type="submit">ADD TO CART</button>
            
        </div>
		</form>
    </div>
    
    <h3 class="w3-margin-top">Product Details</h3>
    <p class="product-des">' .base64_decode($row['long_des']) . '</p>';
			
		}
		 ?>
        
    </div>
