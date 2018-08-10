<?php
session_start();
include 'inc/config.php';
include 'admin/inc/functions.php';
include 'admin/class/database.php';
include 'admin/class/order.php';

$order = new Orders();
//debugger($_GET,true);
//debugger($_SESSION['customer_id'],true);
if(isset($_SESSION['customer_id']) && !isset($_GET['pid']))
{
	if(isset($_POST) && !empty($_POST))
	{
		$cart = $_POST;
		//debugger($cart);
	} else
	{
		$cart = $_SESSION['cart'];
	}

	$cart_id = getRandomString(20);
	$success = array();
	for($i=0; $i < count($cart['product_id']); $i++){
		$temp = array();
		$temp['cart_id'] = $cart_id;
		$temp['user_id'] = $_SESSION['customer_id'];
		$temp['product_id'] = $cart['product_id'][$i];
		$temp['quantity'] = $cart['quantity'][$i];
		$temp['price'] = $cart['quantity'][$i]*$cart['price'][$i];
		$temp['status'] = 0;
		//debugger($temp,true);

		$order_id = $order->addCart($temp);
		$success[] = $order_id;
	}

	if(count($success) >= 1){
		$_SESSION['success'] = "Thank you for ordering the products. Your order will be shortly reviewed by admin and will be processed. Total cost is:".$temp['price'];
		unset($_SESSION['cart']);
	?>
	<script type="text/javascript">
		localStorage.removeItem('PPMiniCart');
		document.location.href = 'index';
	</script>
	<?php
	exit;
	} else {
		$_SESION['error'] = "Sorry! There was problem while adding your cart.";
		?>
	<script type="text/javascript">
		document.location.href = 'user';
	</script>
	<?php
	exit;
	}


} elseif (isset($_GET['pid']) && ($_GET['pid']!="") && isset($_GET['price']) && $_GET['price']!= " ")
{
				
		//echo "here";
		$id = sanitize($_GET['pid']);
		$price = sanitize($_GET['price']);
		$act = substr(md5("negotiationborder".$id),5,10);
		if(($_GET['act']) == $act)
		{
			//echo "here";
			//$productt = $product->getProductById($id);
			//echo "here";
			//$productt[0]->price = $price; 
			//debugger($productt);
			$cart = $_GET;
			//debugger($cart,true);
			$cart_id = getRandomString(20);
			$success = array();
			$temp = array();
			$temp['cart_id'] = $cart_id;
			$temp['user_id'] = $_SESSION['customer_id'];
			$temp['product_id'] = $id;
			$temp['quantity'] = 1;
			$temp['price'] = $price;
			$temp['status'] = 0;
		//debugger($temp,true);

		$order_id = $order->addCart($temp);
		$success[] = $order_id;
		
			

	// debugger($_GET,true);
	// exit;
}
if(count($success) >= 1){
	?> 
	<script type="text/javascript">
		alert("successfully added to cart!");
	</script>

	<?php  
	session_destroy();
	session_start();
		$_SESSION['success'] = "Thank you for ordering the products. Your order will be shortly reviewed by admin and will be processed. Total cost is:".$temp['price'];
		
	?>
	<script type="text/javascript">
		localStorage.removeItem('PPMiniCart');
		document.location.href = 'index';
	</script>
	<?php
	exit;
	} else 
	{
		$_SESION['error'] = "Sorry! There was problem while adding your cart.";
		?>
	<script type="text/javascript">
		document.location.href = 'user';
	</script>
	<?php
	exit;
	}
}
 else {
	if(isset($_POST) && !empty($_POST)){
		$_SESSION['cart'] = $_POST;
	}
	$_SESSION['warning'] = "Please Login / register first.";
	@header('location: login');
	exit;
	}
