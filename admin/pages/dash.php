<?php


// Orders
$orderResult = mysqli_query($con, "SELECT COUNT(order_id) AS total_orders FROM purchase");
$orderData = mysqli_fetch_assoc($orderResult);
$totalOrders = $orderData['total_orders'];

// Visitors
$visitorResult = mysqli_query($con, "SELECT COUNT(cid) AS total_visitors FROM customer");
$visitorData = mysqli_fetch_assoc($visitorResult);
$totalVisitors = $visitorData['total_visitors'];

// Products
$productResult = mysqli_query($con, "SELECT COUNT(pid) AS total_products FROM product");
$productData = mysqli_fetch_assoc($productResult);
$totalProducts = $productData['total_products'];

//Categories 
$catResult = mysqli_query($con, "SELECT COUNT(DISTINCT category) AS total_categories FROM product");
$catData = mysqli_fetch_assoc($catResult); // ← corrected this line
$totalcat = $catData['total_categories'];



//Total Purchases
$totalAmount = 0;

$purchasesResult = mysqli_query($con, "SELECT cart FROM purchase");

while ($row = mysqli_fetch_assoc($purchasesResult)) {
    $cart = json_decode($row['cart'], true);
    if (is_array($cart)) {
        foreach ($cart as $pid => $qty) {
            $pid = intval($pid);
            $qty = intval($qty);
            $priceResult = mysqli_query($con, "SELECT product_price FROM product WHERE pid = $pid");
            if ($priceRow = mysqli_fetch_assoc($priceResult)) {
                $totalAmount += $priceRow['product_price'] * $qty;
            }
        }
    }
}


// popularity
$totalOrdersQuery = "SELECT COUNT(*) AS total_orders FROM purchase";
$totalUsersQuery = "SELECT COUNT(*) AS total_customers FROM customer";

$totalOrdersResult = mysqli_query($con, $totalOrdersQuery);
$totalUsersResult = mysqli_query($con, $totalUsersQuery);

$totalOrders = mysqli_fetch_assoc($totalOrdersResult)['total_orders'] ?? 0;
$totalCustomers = mysqli_fetch_assoc($totalUsersResult)['total_customers'] ?? 1;

$popularityRate = min(100, ($totalOrders / $totalCustomers) * 100);

?>


<div class="w3-container" >

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
  <div class="w3-quarter">
    <div class="w3-container w3-red w3-padding-16">
      <div class="w3-left"><i class="fa-solid fa-basket-shopping w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo $totalProducts; ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Products</h4>
    </div>
  </div>
  <div class="w3-quarter">
    <div class="w3-container w3-blue w3-padding-16">
      <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo $totalVisitors; ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Clients</h4>
    </div>
  </div>
  <div class="w3-quarter">
    <div class="w3-container w3-teal w3-padding-16">
      <div class="w3-left"><i class="fa-solid fa-cart-shopping w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo $totalOrders; ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Orders</h4>
    </div>
  </div>
  <div class="w3-quarter">
    <div class="w3-container w3-orange w3-text-white w3-padding-16">
      <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo $totalcat; ?></h3> 
      </div>
      <div class="w3-clear"></div>
      <h4>Product's Categories</h4>
    </div>
  </div>
</div>


  
  <hr>
  <div class="w3-container">
    <h5>General Stats</h5>
	
   

<p>Total Revenue</p>
<div class="w3-grey">
  <div class="w3-container w3-center w3-padding w3-orange" style="width:100%">
    ₹<?= number_format($totalAmount, 2) ?> earned
  </div>
</div>




    <p>Popularity Rate</p>
<div class="w3-grey">
  <div class="w3-container w3-center w3-padding w3-red" style="width:<?= round($popularityRate) ?>%">
    <?= round($popularityRate) ?>%
  </div>
</div>

  </div>
  <hr>

  <div class="w3-container">
  <h5> Product List</h5>
  <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
    <tr>
      <th>Product Name</th>
      <th>Price</th>
	  <th>Action</th>
    </tr>
    <?php
    

    if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM product";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
      echo "<td>₹" . number_format($row['product_price'], 2) . "</td>";
	 echo '<td><a href="./?edit_product=' . $row['pid'] . '" target="_blank">
        <button class="w3-button w3-blue">Edit</button>
      </a></td>';

      echo "</tr>";
    }

    mysqli_close($con);
    ?>
  </table>
 
</div>

  <hr>
  
  <hr>

  
  

 
</div>


