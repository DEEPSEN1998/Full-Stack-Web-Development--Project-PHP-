<style>
/* Background blur or dark overlay */
#v_blur_bg {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.4); /* semi-transparent dark */
  z-index: 998;
}

/* Popup box styling */
.popup {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 90%;
  max-width: 500px;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 0 20px rgba(0,0,0,0.2);
  z-index: 999;
  padding: 16px;
}

/* Smooth transitions */
.popup, #v_blur_bg {
  transition: all 0.3s ease-in-out;
}
</style>

<div class="w3-container">

  <div style="overflow-x:scroll;">
  <input type="text" placeholder="Search Table...." class="filter w3-input w3-border w3-border-indigo w3-margin" style="max-width:320px;display:inline;" onkeyup="searchTable(this)">
  
  <table class="w3-table w3-center w3-striped">
    <tr class="w3-indigo">
      <th>#</th>
      <th>OID</th>
      <th>STATUS</th>
      <th>Client Details</th>
      
      
      <th>DATE</th>
      <th>Actions</th>
    </tr>
    <tbody class="sctable" id="ldtab">
      <?php

$sql = "SELECT * FROM `purchase`;";
$res = mysqli_query($con, $sql);
$count = 1;

function statusText($code) {
  $map = [
    'Pending'    => "PENDING",
    'Shipped'    => "SHIPPED",
    'Delivered'  => "DELIVERED",
    'Cancelled'  => "CANCELLED"
  ];
  return $map[$code] ?? "UNKNOWN";
}


while($row = mysqli_fetch_assoc($res)) {
  $oid = $row['order_id'];
  $cid = $row['cid'];
  $status = $row['status'];
  $address = $row['address'];
  $addrDec = json_decode((string) $address, true);
  if (json_last_error() === JSON_ERROR_NONE && is_string($addrDec)) {
    $address = $addrDec;
  }
  $purchase_date = date("d-m-Y h:i A", strtotime((string) $row['purchase_date']) ?: time());
  $cart = json_decode($row['cart'], true); 
  

  echo '<tr class="w3-border">
    <td>' . $count . '</td>
    <td>' . $oid . '</td>
    <td>
      <span class="w3-text-blue w3-strong">' . statusText($status) . '</span><br>
      <button class="w3-btn w3-margin w3-indigo" onclick="shp(this);" data-oid="' . $oid . '" data-status="400" data-pay="FP">Change Status</button>
    </td>
    <td>
      CID: ' . $cid . '<br>
      ' . $address . '
    </td>
    <td style="text-transform:uppercase;">' . $purchase_date . '</td>
    <td>
      <button onclick="cfm(this);" data-qs="Remove this order permanently?" data-true="./?rmod=' . $oid . '" class="w3-btn w3-red">DELETE</button>
    </td>
  </tr>';


  $count++;
}

?>

     
    </tbody>
  </table>
</div>

<div id="v_blur_bg"></div>
<div class="popup w3-white" id="cli" style="display:none;">
  <div class="head w3-custom w3-padding" style="display: flex; justify-content: space-between; align-items: center;">
  <div class="title">SET/EDIT STATUS</div>
  <button class="w3-btn w3-red" onclick="v_blur();this.closest('.popup').style.display='none';">
    <i class="fa fa-xmark"></i>
  </button>
</div>


  <div class="body w3-white w3-border w3-custom-border">
  
  
  
    <form action="" method="POST">
      <fieldset>
        <legend>Order ID:</legend>
        <input name="oid" id="orderId" value="" readonly class="w3-input" />
      </fieldset>

      

      <fieldset>
  <legend>Order Status:</legend>
  <select name="o_status" id="o_status" required class="w3-select">
    <option value="Pending">PENDING</option>
    <option value="Shipped">SHIPPED</option>
    <option value="Delivered">DELIVERED</option>
    <option value="Cancelled">CANCELLED</option>
  </select>
</fieldset>

      <!--
	  <fieldset>
        <legend>Payment Status:</legend>
        <select name="p_status" id="p_status" required class="w3-select">
          <option value="FP">Full Paid</option>
          <option value="NP">Not Paid</option>
        </select>
      </fieldset>
-->
      <button type="submit" name="order_stat" class="w3-btn w3-green">Update</button>
      <button type="button" onclick="v_blur();this.parentElement.parentElement.parentElement.style.display='none';" class="w3-btn w3-red">Cancel</button>
    </form>
  </div>
</div>

</div>

<script>
  function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
  }

  function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
  }

  function searchTable(input) {
    const filter = input.value.toLowerCase();
    const rows = document.querySelectorAll("#ldtab tr");
    rows.forEach(row => {
      row.style.display = row.textContent.toLowerCase().includes(filter) ? "" : "none";
    });
  }

  function shp(btn) {
    let oid = btn.dataset.oid;
    let status = btn.dataset.status;
    let payment = btn.dataset.pay;

    // Populate the form inputs with the data attributes
    document.getElementById("orderId").value = oid;
    document.getElementById("o_status").value = status;
    

    // Show the popup
    document.getElementById("cli").style.display = "block";

    // Show the blur background
    document.getElementById("v_blur_bg").style.display = "block";
  }

  function v_blur() {
    // Hide the popup
    document.getElementById("cli").style.display = "none";
    
    // Hide the blur background
    document.getElementById("v_blur_bg").style.display = "none";
  }

  function cfm(btn) {
    if (confirm(btn.getAttribute("data-qs"))) {
      window.location.href = btn.getAttribute("data-true");
    }
  }
</script>


