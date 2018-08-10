<?php

session_start();
include 'inc/config.php';
include INC_PATH.'inc/functions.php';
include INC_PATH."class/database.php";
include INC_PATH.'class/user.php';

if(isset($_POST) && !empty($_POST)){
	$user = new User();
	$data = array();
	
	if($_POST['password'] != $_POST['re_password']){
		$_SESSION['error'] = "Password does not match.";
		@header('location: login');
		exit;
	}
	
	list($first_name, $last_name) = explode(' ',$_POST['full_name']);

	//filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);


	$data['first_name'] = $first_name;
	$data['last_name'] = $last_name;
	$data['username'] = sanitize($_POST['username']);
	$data['password'] = sha1($_POST['username'].$_POST['password']);
	$data['email_address'] = $data['username'];
	$data['phone_number'] = sanitize($_POST['phone_number']);
	$data['address'] = sanitize($_POST['address']);
	$data['role_id'] = 3;
	$data['status'] = 1;
	//debugger($data,true);

	$user_id = $user->addUser($data);
	//$user_id = 2;
	if($user_id){

		/*Mail */

		$_SESSION['success'] = "Thank you for registering. Your email has been successfully registerd.<br/> Please Login to continue.";
		@header('location: login');
		exit;
	} else {
		$_SESSION['error'] = "There seem to be a tiny error while registering your account.<br/>Please try again or contact our admin.";
		@header('location: login');;
		exit;
	}
} else {
	$_SESSION['error'] = "Please Login first.";
	@header('location: login');
	exit;
}