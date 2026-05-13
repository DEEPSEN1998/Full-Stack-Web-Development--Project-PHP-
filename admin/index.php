<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

date_default_timezone_set("Asia/Kolkata");
include 'db.php';
include 'menu.php';
include 'header.php';

if(!isset($_SESSION['admin'])){
	include 'login.php';
	exit;
}elseif(isset($_REQUEST['logout'])){
	session_destroy();
	header("LOCATION: ./");
	exit;
}




?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $body['title'];?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
<style>
html,body,h1,h2,h3,h4,h5 {font-family: Arial, sans-serif}


 
.blur {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.4); /* semi-transparent dark */
  z-index: 998;
  backdrop-filter: blur(5px);
}


.popup {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 90%;
  height:0 auto;
  max-width: 768px;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 0 20px rgba(0,0,0,0.2);
  z-index: 999;
 
}
.popup .body{
	max-height:60vh;
	overflow:auto;
}

.popup  .blur {
  transition: all 0.3s ease-in-out;
}


</style>
</head>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">ElectroShop</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar  w3-collapse w3-white w3-animate-left" style="z-index:1;width:256px;box-shadow:1px 1px 1px 1px grey" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="../assets/images/icons/electroshop.png" class="w3-circle w3-margin-right" style="width:64px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong>Admin</strong></span><br>
      
    </div>
  </div>

  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="./" class="w3-bar-item w3-button w3-padding"> <i class="fa-solid fa-users"></i>  Dashboard</a>
    <a href="./?client" class="w3-bar-item w3-button w3-padding"> <i class="fa-solid fa-user"></i>  My clients</a>
    <a href="./?order" class="w3-bar-item w3-button w3-padding"><i class="fa-solid fa-cart-shopping"></i> Orders</a>
	<a href="./?product" class="w3-bar-item w3-button w3-padding"><i class="fa-solid fa-cart-shopping"></i> Products</a>
    <a href="./?logout" class="w3-bar-item w3-button w3-padding"><i class="fa-solid fa-right-from-bracket"></i> Logout</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:256px;margin-top:43px;padding:4px 6px;">

 <?php
 
 $dir = "./pages/";
 if(file_exists($dir.$body['page'])){
	 include ($dir.$body['page']);
 }else{
	 echo "Error 404, page not exists";
 }
 //echo $dir.$body['page'];
 ?>
  

 
</div>
 <div id="blur" class="blur"></div>
<script>
  function blur_switch(){
	  var obj =document.getElementById('blur');
	  if (obj.style.display === 'block' ) {
		  obj.style.display = 'none';
	  }else{
		  obj.style.display = 'block';
	  }
	  
  }

function closeForm(el) {
   el.parentElement.parentElement.style.display = "none";
    blur_switch();
  }
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>
