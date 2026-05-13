<?php


$body = array("title" => "Dashboard","page" => "dash.php");

$menu = array();
$menu["client"] = array("title" => "client","page" => "client.php");
$menu["order"] = array("title" => "order","page" => "order.php");
$menu["product"] = array("title" => "All products","page" => "product.php");
$menu["edit_product"] = array("title" => "edit_product","page" => "edit_product.php");

foreach($menu as $k => $v){
	if (isset($_REQUEST[$k])){
		$body = $v;
		break;
	}else{
		$body = array("title" => "Dashboard","page" => "dash.php");
	}
} 

?>