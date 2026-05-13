<?php

 

if (!isset($_SESSION['ecom']['cid'])) {
    echo "<div class='w3-container w3-red w3-padding'>Please log in to view your orders.</div>";
    exit;
}

$cid = $_SESSION['ecom']['cid'];


$sql = "SELECT *  FROM `purchase` WHERE `cid` = '".$cid."';";
$result = mysqli_query($con, $sql);


?>



<div class="w3-container w3-margin-top">
  <h2 class="w3-text-blue">My Orders</h2>

 
    

    
         <?php
		 if ($result && mysqli_num_rows($result) > 0) {
			 echo '<div class="w3-responsive">
      <table class="w3-table-all w3-hoverable w3-small">
        <thead>
          <tr class="w3-light-grey">
            <th>Order ID</th>
            <th>Date</th>
            <th>Total (₹)</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>';
			 
    while ($row = mysqli_fetch_assoc($result)) {
		//var_dump($row);
        
		 $statusClass = 'w3-grey'; // default

switch ($row['status']) {
  case 'Pending':   $statusClass = 'w3-yellow'; break;
  case 'Shipped':   $statusClass = 'w3-blue';   break;
  case 'Delivered': $statusClass = 'w3-green';  break;
  case 'Cancelled': $statusClass = 'w3-red';    break;
}
$total=0;
$products = json_decode($row['cart'],true);
foreach($products as $k => $v){
	$total+=floatval($v['amt'])*intval($v['qty']);
}
echo '<tr>
        <td>'.$row['order_id'].'</td>
        <td>'.date('d-m-Y h:i a', strtotime((string) $row['purchase_date']) ?: time()).'</td>
        <td>'.number_format($total,2).'</td>
        <td>
          <span class="w3-tag '.$statusClass.'">
            '.$row['status'].'
          </span>
        </td>
      </tr>';

    }
}else{
	echo '<div class="w3-panel w3-pale-yellow w3-leftbar w3-border-yellow">
      <p>You have not placed any orders yet.</p>
    </div>';
}
		 
		 
		 
		 
		 
		 ?>
            
        
        </tbody>
      </table>
    </div>
 
</div>


