



  <style>
    .section-header {
      font-size: 18px;
      font-weight: bold;
      padding: 10px;
      background-color: #f1f1f1;
    }
    .payment-option {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      cursor: pointer;
    }
    .payment-option:hover, .payment-option.active {
      background-color: #f9f9f9;
      border-left: 4px solid #2196F3;
    }
    .pay-method-content {
      display: none;
      padding: 10px;
      border: 1px solid #ddd;
      margin-bottom: 10px;
    }
    .pay-method-content.active {
      display: block;
    }
    .checkout-box {
      max-width: 900px;
      margin: auto;
    }
  </style>


<div class="w3-white w3-card-4 w3-margin checkout-box" style="margin: 40px auto; max-width: 100%; padding: 20px;">

<?php


$user = ['name' => '', 'phone' => '', 'address' => ''];

if (isset($_SESSION['ecom']) && isset($_SESSION['ecom']['cid'])) {
    $user_id = $_SESSION['ecom']['cid']; 
    $user['name'] = $_SESSION['ecom']['full_name'];
    $user['phone'] = $_SESSION['ecom']['phone'];
    $user['address'] = $_SESSION['ecom']['address'];
    

   
} else {
    echo "<div class='w3-red w3-padding'>You must be logged in to continue.</div>";
    exit;
}



/*if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['corder'])) {
    $name =  $_POST['name'];
    $phone =  $_POST['phone'];
    $address =  $_POST['address'];
    $billing = isset($_POST['billing_address'][0]) ?  $_POST['billing_address'][0] : '';
    $slot =  $_POST['delivery_slot'];
    $payment = $_POST['payment'];
    $cart = json_encode($_SESSION['checkout']);
    $cid = intval($_SESSION['ecom']['cid']);
    $order_id = uniqid("ORD");
    $status = "Pending";
    $purchase_date = date('Y-m-d H:i:s');
    $full_address = $address . ($billing ? "\nBilling: " . $billing : "") . "\nSlot: " . $slot . "\nPhone: " . $phone;

    $sql = "INSERT INTO `purchase` (`order_id`, `cart`, `cid`, `address`, `status`, `purchase_date`)
            VALUES ('$order_id', '$cart', '$cid', '$full_address', '$status', '$purchase_date');";

    if (mysqli_query($con, $sql)) {
        echo "<div class='w3-panel w3-green w3-padding'>Order placed successfully! Your Order ID is <strong>$order_id</strong>.</div>";
        unset($_SESSION['checkout']);
    } else {
        echo "<div class='w3-panel w3-red w3-padding'>Failed to place order. Please try again.</div>";
    }
}

*/





?>

<style>

input[readonly] ,textarea[readonly] {
  color: grey;
}



</style>

  <form action="" method="POST">
    <!-- Address <--><input type="hidden" name="cid" value="<?php echo $user_id; ?>">
    <div class="section-header">1. Delivery Address</div>
    <div class="w3-padding">
	<label>Name :</label>
      <input class="w3-input w3-margin-bottom" type="text" name="name" placeholder="Full Name" required readonly value="<?php echo htmlspecialchars($user['name']); ?>">
<label>Phone :</label>  
<input class="w3-input w3-margin-bottom" type="text" name="phone" placeholder="Phone Number" required readonly value="<?php echo htmlspecialchars($user['phone']); ?>">
<label for="">Billing Address :</label>
<textarea class="w3-input w3-margin-bottom" name="address" placeholder="Full Address" required readonly><?php echo htmlspecialchars($user['address']); ?></textarea>

	  
	  <label>Delivery Address (optional)</label>
<textarea class="w3-input w3-margin-bottom" name="delivery_address"  placeholder="Delivery Address (if different)" ><?php echo $user['address'];?></textarea>
    </div>
	
	


    <!-- Delivery Slot -->
    <div class="section-header">2. Delivery Slot</div>
    <div class="w3-padding">
      <select class="w3-select w3-margin-bottom" name="delivery_slot" required>
        <option value="" disabled selected>Select delivery time</option>
        <option value="Morning">Morning (9 AM - 12 PM)</option>
        <option value="Afternoon">Afternoon (12 PM - 3 PM)</option>
        <option value="Evening">Evening (5 PM - 9 PM)</option>
      </select>
    </div>

    <!-- Payment -->
    <div class="section-header">3. Payment Options</div>
    <div class="w3-row-padding w3-padding">
      <div class="w3-third">
        <div class="payment-option active" onclick="showMethod('cod')">Cash on Delivery</div>
        <div class="payment-option" onclick="showMethod('upi')">UPI</div>
        <div class="payment-option" onclick="showMethod('card')">Credit/Debit Card</div>
        <div class="payment-option" onclick="showMethod('wallet')">Wallet</div>
      </div>
      <div class="w3-twothird">

        <!-- COD -->
        <div class="pay-method-content active" id="cod">
          <p>Pay in cash when your order is delivered.</p>
          <input type="radio" name="payment" value="cod" checked hidden>
        </div>

        <!-- UPI -->
        <div class="pay-method-content" id="upi">
          <label>Enter UPI ID</label>
          <input class="w3-input w3-margin-bottom" type="text" name="upi_id" placeholder="example@upi">
          <input type="radio" name="payment" value="upi" hidden>
        </div>

        <!-- Card -->
        <div class="pay-method-content" id="card">
          <input class="w3-input w3-margin-bottom" type="text" name="card_number" placeholder="Card Number">
          <input class="w3-input w3-margin-bottom" type="text" name="card_name" placeholder="Cardholder Name">
          <div class="w3-row">
            <div class="w3-half">
              <input class="w3-input w3-margin-bottom" type="text" name="expiry" placeholder="MM/YY">
            </div>
            <div class="w3-half">
              <input class="w3-input w3-margin-bottom" type="text" name="cvv" placeholder="CVV">
            </div>
          </div>
          <input type="radio" name="payment" value="card" hidden>
        </div>

        <!-- Wallet -->
        <div class="pay-method-content" id="wallet">
          <p>Choose a wallet</p>
          <select class="w3-select w3-margin-bottom" name="wallet_choice">
            <option value="" disabled selected>Select Wallet</option>
            <option value="Paytm">Paytm</option>
            <option value="PhonePe">PhonePe</option>
            <option value="AmazonPay">Amazon Pay</option>
          </select>
          <input type="radio" name="payment" value="wallet" hidden>
        </div>
      </div>
    </div>
<?php 
$checkout = $_SESSION['checkout'];
$qty = 0; 
$total =0;	
		foreach($checkout as $k => $v){
		$total += floatval($v['amt'])*intval($v['qty']);
        $qty += intval($v['qty']);
        		
		
		}
?>
    <!-- Order Summary -->
    <div class="section-header">4. Order Summary</div>
    <div class="w3-padding">
      <p>Total Items: <strong><?php  echo $qty ;?></strong></p>
      <p>Total Amount: ₹<strong><?php  echo number_format($total,2);?></strong></p>
    </div>

    <!-- Place Order -->
    <div class="w3-center w3-padding">
      <button class="w3-button w3-blue w3-large" type="submit" name="corder">Place Order</button>
    </div>
  </form>
</div>

<script>
function showMethod(id) {
  // Hide all
  document.querySelectorAll('.pay-method-content').forEach(el => el.classList.remove('active'));
  document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('active'));

  // Show selected
  document.getElementById(id).classList.add('active');
  event.target.classList.add('active');

  // Update selected radio
  document.querySelectorAll('input[name="payment"]').forEach(input => {
    if (input.value === id) input.checked = true;
    else input.checked = false;
  });
}
</script>

