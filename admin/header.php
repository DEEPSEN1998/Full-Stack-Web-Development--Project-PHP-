<?php


if (isset($_POST['sv_prod'])){
	if(!empty($_POST['pid'])){
		$sql = "UPDATE `product` SET 
  `product_name` = '".$_POST['product_name']."',
  `brand_name` = '".$_POST['brand_name']."',
  `short_des` = '".base64_encode($_POST['short_desc'])."',
  `long_des` = '".base64_encode($_POST['long_desc'])."',
  `imgs_link` =  '".(!empty($_POST['img_link']) ? json_encode($_POST['img_link']) : json_encode(array()))."',
  `product_price` = '".$_POST['price']."',
  `quantity` = '".$_POST['quantity']."',
  `discount` = '".$_POST['discount']."' ,
   `category` = '".$_POST['category']."'
WHERE `pid` = '".$_POST['pid']."' ;";

$pid = $_POST['pid'];
	}else{
		mkdir("../storage/".$pid);
		$pid = hash('xxh3',$_POST['product_name'],false); 
		$sql = "INSERT IGNORE INTO `product`( `pid`, `product_name`, `brand_name`, `short_des`, `long_des`, `imgs_link`, `product_price`, `quantity`, `discount` ,`category`) VALUES ('".$pid."','".$_POST['product_name']."','".$_POST['brand_name']."','".base64_encode($_POST['short_desc'])."','".base64_encode($_POST['long_desc'])."','".json_encode(array())."','".$_POST['price']."','".$_POST['quantity']."','".$_POST['discount']."','".$_POST['category']."');";
	}
	
	if(mysqli_query($con,$sql)){
		
		header("LOCATION: ./?edit_product=".$pid." ") ;
	}
	exit;
	
	
}


  
  if (isset($_POST['order_stat'])) {
    $oid = $_POST['oid'];
    $new_status = $_POST['o_status'];
   

  
    $query = "UPDATE purchase SET status = '$new_status' WHERE order_id = '$oid'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('Order updated successfully'); location.reload();</script>";
    } else {
        echo "<script>alert('Failed to update order');</script>";
    }
	header("LOCATION: ./?order") ;
}










?>