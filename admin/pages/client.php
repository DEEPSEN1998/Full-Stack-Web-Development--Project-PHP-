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


<div style="overflow-x:auto;">
  <input type="text" placeholder="Search Table..." class="w3-input w3-border w3-margin" style="max-width:320px; display:inline;" onkeyup="searchTable(this)">
 

  <table class="w3-table w3-striped w3-bordered w3-margin-top w3-center">
    <thead class="w3-indigo">
      <tr>
        <th>#</th>
        <th>CID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody class="sctable">
<?php

$sql = "SELECT * FROM `customer`";
$result = mysqli_query($con, $sql);
$i = 1;

while ($row = mysqli_fetch_assoc($result)) {
  echo '<tr>
          <td>'.$i++.'</td>
          <td>'.$row['cid'].'</td>
          <td>'.$row['full_name'].'</td>
          <td>'.$row['email'].'</td>
          <td>'.$row['phone'].'</td>
          <td>'.$row['address'].'</td>
          <td>
            <button class="w3-button w3-blue" onclick="fillForm(\''.htmlspecialchars($row['cid']).'\', \''.htmlspecialchars($row['full_name']).'\', \''.htmlspecialchars($row['email']).'\', \''.htmlspecialchars($row['phone']).'\', \''.htmlspecialchars($row['address']).'\')">Edit</button>
          </td>
        </tr>';
}
?>
</tbody>

  </table>
</div>
<div id="v_blur_bg"></div>
<div class="popup w3-white" id="cli" style="display:none;">
  <div class="head w3-indigo w3-padding" style="display: flex; justify-content: space-between; align-items: center;">
    <div class="title">CLIENT - EDIT</div>
    <button class="w3-btn w3-red" onclick="closForm()">
      <i class="fa fa-xmark"></i>
    </button>
  </div>

  <div class="body w3-padding">
    <form method="post" action="">
      <input type="hidden" id="cid" name="cid">

      <fieldset>
        <legend>Name</legend>
        <input type="text" class="w3-input" name="name" required id="name" placeholder="Full Name">
      </fieldset>

      <fieldset>
        <legend>Father Name</legend>
        <input type="text" class="w3-input" name="faname" id="faname" placeholder="Father's Name">
      </fieldset>

      <fieldset>
        <legend>Email</legend>
        <input type="email" class="w3-input" name="email" id="email" placeholder="Email">
      </fieldset>

      <fieldset>
        <legend>Phone</legend>
        <input type="text" class="w3-input" name="phone" id="phone" placeholder="Phone Number">
      </fieldset>

      <fieldset>
        <legend>Address</legend>
        <textarea class="w3-input" name="address" id="address" placeholder="Enter address here..."></textarea>
      </fieldset>

      <fieldset class="w3-center">
        <button type="submit" name="aecli" class="w3-btn w3-red">SUBMIT</button>
      </fieldset>
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

function fillForm(cid, name, email, phone, address) {
  document.getElementById("cid").value = cid;
  document.getElementById("name").value = name;
  document.getElementById("email").value = email;
  document.getElementById("phone").value = phone;
  document.getElementById("address").value = address;
  document.getElementById("faname").value = ""; // optional
  document.getElementById("cli").style.display = "block";
  document.getElementById("v_blur_bg").style.display = "block";
}


function openForm() {
    document.getElementById("cid").value = "";
    document.getElementById("name").value = "";
    document.getElementById("faname").value = "";
    document.getElementById("email").value = "";
    document.getElementById("phone").value = "";
    document.getElementById("address").value = "";
    document.getElementById("cli").style.display = "block";
   document.getElementById("v_blur_bg").style.display = "block";
  }

  function closForm() {
    document.getElementById("cli").style.display = "none";
    document.getElementById("v_blur_bg").style.display = "none";
  }

  function searchTable(input) {
    const filter = input.value.toUpperCase();
    const table = document.querySelector(".sctable");
    const rows = table.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
      const cells = rows[i].getElementsByTagName("td");
      let match = false;

      for (let j = 0; j < cells.length - 1; j++) {
        if (cells[j].innerText.toUpperCase().includes(filter)) {
          match = true;
          break;
        }
      }

      rows[i].style.display = match ? "" : "none";
    }
  }
 
</script>

