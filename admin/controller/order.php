<?php 
require '../inc/session.php';
include INC_PATH.'inc/functions.php';
include INC_PATH.'class/database.php';
include INC_PATH.'class/order.php';

$banner = new Orders();


/*debugger($_POST);
debugger($_GET);
debugger($_FILES, true);*/

if(isset($_POST) && !empty($_POST)){
	//debugger($_POST,true);
	$id = (int) sanitize($_POST['cart_id']);
	$status = (int) sanitize($_POST['status']);
	//debugger($id);
	//debugger($status,true);
	$data = array();
	$data['status'] = $status;
	$order = $banner->updateStatus($id,$data);
	//debugger($order,true);
	if($order)
	{
		$_SESSION['success'] = "The update has been performed successfully.";
		@header("location:../order.php");
		exit;
	}
	else
	{
		$_SESSION['warning'] = "Unable to update status";
		@header("location: ../order.php");
		exit;
	}

}