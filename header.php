<?php
date_default_timezone_set("Asia/kolkata");
//echo date_default_timezone_get();
session_start();

if(!isset($_SESSION['cart'])){
	 $_SESSION['cart'] = array();
}

if(!isset($_SESSION['wishlist'])){
	 $_SESSION['wishlist'] = array();
}
$body = 'home.php';
if (isset($_REQUEST['logout'])){
	session_destroy();
	 $_SESSION['cart'] = array();
     $_SESSION['wishlist'] = array();
	 header("LOCATION: ./") ;
}elseif(isset($_REQUEST['cart'])){
	$body = 'cart.php';
}elseif(isset($_REQUEST['product'])){
	$body = 'product.php';
}elseif(isset($_REQUEST['checkout'])){
	$body = 'checkout.php';
}
elseif(isset($_REQUEST['wishlist'])){
	$body = 'wishlist.php';
}
elseif(isset($_REQUEST['terms'])){
	$body = 'terms.php';
}
elseif(isset($_REQUEST['order'])){
	$body = 'order.php';
}
elseif(isset($_REQUEST['a2c'])){
	$pid = trim($_REQUEST['a2c']);
    a2c($pid);
	 sync();
	header('LOCATION:./?cart');
}elseif(isset($_REQUEST['rmcart'])){
	$pid = trim($_REQUEST['rmcart']);
	if(isset($_SESSION['cart'][$pid])){
		unset($_SESSION['cart'][$pid]);
	}
	 sync();
	header('LOCATION:./?cart');
	
}

elseif(isset($_REQUEST['rmwish'])){
	$pid = trim($_REQUEST['rmwish']);
	if(isset($_SESSION['wishlist'][$pid])){
		unset($_SESSION['wishlist'][$pid]);
		
	}
	 sync();
	header('LOCATION:./?wishlist');
}

elseif(isset($_REQUEST['wl'])){
	$pid = trim($_REQUEST['wl']);
    wl($pid);
	 sync();
	header('LOCATION:./?wishlist');
}


if(isset($_POST['corder'])){
	$ts = strtotime('now');
	$order_id = hash('xxh3', (string) $ts, false);
	$cart_json = mysqli_real_escape_string($con, json_encode($_SESSION['checkout']));
	$cid_val = mysqli_real_escape_string($con, isset($_POST['cid']) ? (string) $_POST['cid'] : '');
	// Column `address` is JSON-validated in DB — store delivery text as a JSON string value.
	$addr_json = mysqli_real_escape_string($con, json_encode(isset($_POST['delivery_address']) ? $_POST['delivery_address'] : '', JSON_UNESCAPED_UNICODE));
	$oid_esc = mysqli_real_escape_string($con, $order_id);
	$purchase_when = date('Y-m-d H:i:s', $ts);
	$sql = "INSERT INTO `purchase`(`order_id`, `cart`, `cid`, `address`, `status`, `purchase_date`) VALUES ('".$oid_esc."','".$cart_json."','".$cid_val."','".$addr_json."','Pending','".$purchase_when."');";
	//echo $sql;
	//exit;
	$result =mysqli_query($con,$sql);
	if($result){
		$_SESSION['cart'] = array();
		unset($_SESSION['checkout']);
		
		header('LOCATION:./?order');
		exit;
	}
}


if(isset($_POST['checkout'])){
	$pid=$_POST['cart'];
	//echo json_encode($pid);
	$_SESSION['checkout'] = $pid;
	 //$_SESSION['cart'] = array();
	
	 header('LOCATION:./?checkout');
}
if(isset($_POST['a2c'])){
	$pid = $_POST['pid'];
	$qty = $_POST['qty'];
	 a2c($pid,$qty);
	 sync();
	header('LOCATION:./?cart');
}

function a2c($pid,$qty=1){
	 
	 global $_SESSION;
	 if(is_array($_SESSION['cart'])){
	 $_SESSION['cart'][$pid] = $qty;
	} else{
		$_SESSION['cart'] = array();
		$_SESSION['cart'][$pid] = $qty;
	}
	
}
function wl($pid,$qty=1) {
    if (!isset($_SESSION['wishlist']) || !is_array($_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = array();
    }

    $_SESSION['wishlist'][$pid] = $qty; // or just store '1', or any value
	
}






if (isset($_POST['signup'])){
	
		$cid = hash('xxh3',$_POST['email'],false); 
		$sql = "INSERT INTO `customer`(`cid`, `email`, `phone`, `full_name`, `password`, `address`, `join_date`, `cart`, `wishlist`) 
		VALUES ('".$cid."','".$_POST['email']."','".$_POST['phone']."','".$_POST['name']."','".hash('sha3-256',$_POST['password'],false)."','".$_POST['address']."','".strtotime('now')."','".json_encode(array())."','".json_encode(array())."');";
	
	
	 echo $sql ;
	if(mysqli_query($con,$sql)){
		 
		 header("LOCATION: ./#login") ;
		 
	}
	exit;
	
	
}


function sync(){
global $con;
global $_SESSION;
if(isset($_SESSION['ecom'])){
	$cid = $_SESSION['ecom']['cid'];
	$sql = "UPDATE `customer` SET `cart`='".json_encode($_SESSION['cart'])."',`wishlist`='".json_encode($_SESSION['wishlist'])."' WHERE `cid` = '".$cid."';";
	$result = mysqli_query($con, $sql);
	
}
}
if (isset($_POST['login'])){
	
		
		$sql = "SELECT * FROM `customer` WHERE  `email` = '".$_POST['email']."' AND `password` = '".hash('sha3-256',$_POST['password'],false)."';";
		$result = mysqli_query($con, $sql);

    echo $sql;
   if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
       
		 $_SESSION['cart'] = json_decode($row['cart'],true);
		  $_SESSION['wishlist'] = json_decode($row['wishlist'],true);
		   unset($row['cart']);
		   unset($row['wishlist']);
		   $_SESSION['ecom'] = $row;
		 header("LOCATION: ./#") ;
   }}else{
	   echo "wrong email or password";
   }
	 
	exit;
}




?>