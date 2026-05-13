<?php
$out=array();
$pid=$_REQUEST['edit_product'];
$sql = "SELECT * FROM `product` WHERE `pid`='".$pid."';";
$res = mysqli_query($con,$sql);
if(mysqli_num_rows($res) > 0){
		  while($row = mysqli_fetch_assoc($res)){
			  $row['imgs_link']=json_decode($row['imgs_link']);
			$out=$row;  
}}

?>
<h2> EDIT PRODUCT - <?php echo $out['product_name'];?></h2>
 <div class="w3-container w3-padding">
    <form method="post" action="">
  <input type="hidden" id="pid" name="pid" value="<?php echo $out['pid'];?>">

  <fieldset>
    <legend>Product Name</legend>
    <input type="text" class="w3-input" name="product_name" value="<?php echo $out['product_name'];?>" id="product_name" placeholder="Enter product name" required>
  </fieldset>

  <fieldset>
    <legend>Brand Name</legend>
    <input type="text" class="w3-input" name="brand_name" value="<?php echo $out['brand_name'];?>" id="brand_name" placeholder="Enter brand name">
  </fieldset>

  <fieldset>
    <legend>Short Description</legend>
    <textarea class="w3-input" name="short_desc"  id="short_desc" placeholder="Enter a short description"><?php echo base64_decode($out['short_des']);?></textarea>
  </fieldset>

  <fieldset>
    <legend>Long Description</legend>
    <textarea class="w3-input" name="long_desc"  id="long_desc" placeholder="Enter a detailed product description"><?php echo base64_decode($out['long_des']);?></textarea>
  </fieldset>
<div class="w3-row">
  <fieldset class="w3-col s3">
    <legend>Product Price</legend>
    <input type="number" class="w3-input" value="<?php echo $out['product_price'];?>" name="price" id="price" min="0" placeholder="Enter price (e.g., 999.99)">
  </fieldset>

  <fieldset class="w3-col s3">
    <legend>Product Quantity</legend>
    <input type="number" class="w3-input" value="<?php echo $out['quantity'];?>" name="quantity" id="quantity" min="-1" value="-1" placeholder="Enter available quantity">
  </fieldset>

  <fieldset class="w3-col s3">
    <legend>Discount</legend>
    <input type="number" class="w3-input" value="<?php echo $out['discount'];?>" name="discount" id="discount" min="0" value="0" placeholder="Enter discount (e.g., 10%)">
  </fieldset>
  
  
  
</div>

 <fieldset>
    <legend>Product Category</legend>
    <input type="text" class="w3-input" name="category" value="<?php echo $out['category'];?>" id="category" placeholder="Enter product category" required>
  </fieldset>


<fieldset >  <legend>Images - <button class="w3-btn w3-blue" type="button" onclick="document.getElementById('uploadPopup').style.display='block';blur_switch();">Upload Image</button></legend>

<div class="w3-row-padding w3-margin-bottom" id="srt_imgs">
<?php $x=1; foreach ($out['imgs_link'] as $img) {
	$rmb= "this.closest('.image-card').remove()";
echo '
  <div class="w3-col s3 w3-center w3-padding image-card">
    <div class="w3-card w3-padding" style="width:256px; position:relative;">
      <img src="../storage/' . $pid . '/' . $img . '" style="width:100%;height:auto;">
      <input type="hidden" name="img_link[]" value="'.htmlspecialchars($img).'">
      <button class="w3-button w3-red w3-small" style="position:absolute;top:0;left:0;" onclick="'.$rmb.'">X</button>
    </div>
  </div> 
';} ?>
</div>

 </fieldset>

  <div class="w3-center w3-margin-top">
    <button type="submit" name="sv_prod" class="w3-btn w3-red">SUBMIT</button>
  </div>
</form>

    </div>
	
  <div class="popup w3-white" id="uploadPopup" style="display:none;">
    <div class="head w3-indigo w3-padding" style="display: flex; justify-content: space-between; align-items: center;">
      <div class="title">Upload Image</div>
      <button class="w3-btn w3-red" onclick="closeForm(this);">
        <i class="fa fa-xmark"></i>
      </button>
    </div>
	
	<div class="body w3-padding">
	 <div class="w3-container">
      <!-- File input field -->
	   <input type="hidden" id="pid" name="pid" value="<?php echo $out['pid'];?>">
      <input type="file" id="imageUploader" accept="image/*">
      <!-- Preview Area -->
      <div id="imagePreview" style="margin-top: 10px;">
        <!-- Image preview will be displayed here -->
      </div>
    </div>
    <footer class="w3-container w3-border">
      <button class="w3-btn w3-red" onclick="document.getElementById('uploadPopup').style.display='none';blur_switch();">Cancel</button>
      <button class="w3-btn w3-green" onclick="uploadImage()">Upload</button>
    </footer>
	    </div>
  </div>
</div>

	
	
	
	
	
	
	
	
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" ></script>
	<script>
	 tinymce.init({
    selector: '#long_desc',
    height: 512,
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
  
  
  const uploader = document.getElementById('imageUploader');
  const preview = document.getElementById('imagePreview');

  // Handle file selection and preview
  uploader.addEventListener('change', function () {
    const file = this.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
      // Clear the preview before showing the new image
      preview.innerHTML = '<img src="' + e.target.result + '" style="max-width: 100%; max-height: 200px; object-fit: cover;">';
    };
    reader.readAsDataURL(file);
  });

  // Handle AJAX image upload
  function uploadImage() {
    const file = uploader.files[0];
	const pid = document.getElementById('pid').value;
    if (!file) {
      alert('Please select an image to upload.');
      return;
    }

    const formData = new FormData();
    formData.append('image', file);
	formData.append('pid', pid);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'upload_img.php', true);

    // Set up the callback for when the request completes
    xhr.onload = function () {
      if (xhr.status === 200) {
        alert('Image uploaded successfully!');
        document.getElementById('uploadPopup').style.display = 'none'; // Close popup
		blur_switch();
      } else {
        alert('Error uploading image. Please try again.');
      }
    };

    // Send the form data with the image
    xhr.send(formData);
  } 
  
   const tbody = document.getElementById('srt_imgs');
  Sortable.create(tbody, {
    animation: 150,
    ghostClass: 'w3-pale-yellow',
    onEnd: function () {
      [...tbody.rows].forEach((row, i) => {
        row.cells[0].innerText = i + 1;
      });
    }
  });
	</script>