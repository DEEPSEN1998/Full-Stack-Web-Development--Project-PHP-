
<div class="w3-container">
  <div style="overflow-x:auto;">
    <input type="text" placeholder="Search Table..." class="w3-input w3-border w3-margin" style="max-width:320px; display:inline;" onkeyup="searchTable(this)">
    <button class="w3-button w3-indigo" onclick="add_prod();">
      <i class="fa-regular fa-square-plus"></i> GENERATE
    </button>

    <table class="w3-table w3-striped w3-bordered w3-margin-top w3-center">
      <thead class="w3-indigo">
        <tr>
          <th>#</th>
          <th>PID</th>
          <th>Product Name</th>
          <th>Brand Name</th>
          <th>Short Description</th>
          
          <th>Product Price</th>
         
          <th>Product Quantity</th>
          <th>Discount</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="sctable">
	  <?php 
	  $sql = "SELECT * FROM `product` ;";
	  $out = mysqli_query($con,$sql);
	  $x=1;
	  if(mysqli_num_rows($out) > 0){
		  while($row = mysqli_fetch_assoc($out)){
	  
	  echo '
        <tr class="w3-border">
          <td>'.$x.'</td>
          <td>'.$row['pid'].'</td>
          <td>'.$row['product_name'].'</td>
          <td>'.$row['brand_name'].'</td>
          <td>'.base64_decode($row['short_des']).'</td>
          <td>'.$row['product_price'].'</td>
          <td>'.$row['quantity'].'</td>
		  <td>'.$row['discount'].'</td>
          <td>
            <a href="./?edit_product='.$row['pid'].'" target="_blank"><button class="w3-button w3-blue" >Edit</button></a>
		
          </td>
        </tr>
	  ';
	  $x++;}}?> 
        
		
      </tbody>
    </table>
  </div>

 
  <div class="popup w3-white" id="cli" style="display:none;">
    <div class="head w3-indigo w3-padding" style="display: flex; justify-content: space-between; align-items: center;">
      <div class="title">PRODUCT - ADD / EDIT</div>
      <button class="w3-btn w3-red" onclick="closeForm(this);">
        <i class="fa fa-xmark"></i>
      </button>
    </div>

    <div class="body w3-padding">
    <form method="post" action="">
  <input type="hidden" id="pid" name="pid">

  <fieldset>
    <legend>Product Name</legend>
    <input type="text" class="w3-input" name="product_name" id="product_name" placeholder="Enter product name" required>
  </fieldset>

  <fieldset>
    <legend>Brand Name</legend>
    <input type="text" class="w3-input" name="brand_name" id="brand_name" placeholder="Enter brand name">
  </fieldset>

  <fieldset>
    <legend>Short Description</legend>
    <textarea class="w3-input" name="short_desc" id="short_desc" placeholder="Enter a short description"></textarea>
  </fieldset>

  <fieldset>
    <legend>Long Description</legend>
    <textarea class="w3-input" name="long_desc" id="long_desc" placeholder="Enter a detailed product description"></textarea>
  </fieldset>

  <fieldset>
    <legend>Product Price</legend>
    <input type="text" class="w3-input" name="price" id="price" min="0" placeholder="Enter price (e.g., 999.99)">
  </fieldset>

  <fieldset>
    <legend>Product Quantity</legend>
    <input type="number" class="w3-input" name="quantity" id="quantity" min="-1" value="-1" placeholder="Enter available quantity">
  </fieldset>

  <fieldset>
    <legend>Discount</legend>
    <input type="number" class="w3-input" name="discount" id="discount" min="0" value="0" placeholder="Enter discount (e.g., 10%)">
  </fieldset>
  
  <fieldset>
    <legend>Category</legend>
    <input type="text" class="w3-input" name="category" id="category"  placeholder="Enter category">
  </fieldset>

  <fieldset class="w3-center">
    <button type="submit" name="sv_prod" class="w3-btn w3-red">SUBMIT</button>
  </fieldset>
</form>

    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" ></script>
<script>



function add_prod() {
    document.getElementById("pid").value = "";
    document.getElementById("product_name").value = "";
    document.getElementById("brand_name").value = "";
    document.getElementById("short_desc").value = "";
    document.getElementById("long_desc").value = "";
    document.getElementById("price").value = "";
	
	document.getElementById("quantity").value = "";
	document.getElementById("discount").value = "";
    document.getElementById("cli").style.display = "block";
    blur_switch();
	
	
	
	 tinymce.init({
    selector: '#long_desc',
    height: 300,
    menubar: false,
	branding: false,
    plugins: 'lists link image preview code table',
    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist table| link image | preview code',
	setup: function (editor) {
      editor.on('init', function () {
        editor.getContainer().insertAdjacentHTML('beforebegin',
          '<div style="background:#222;color:#fff;padding:4px 10px;font-size:12px;border-radius:4px 4px 0 0;">Custom Editor by <strong>DeepNOOB</strong></div>'
        );
      });
    }
  });
	
	
	
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

