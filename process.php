<?php

session_start();
include 'inc/config.php';
include INC_PATH.'inc/functions.php';
include INC_PATH."class/database.php";
include INC_PATH.'class/user.php';
$user = new User();

if(isset($_POST) && !empty($_POST)){
	$username = sanitize($_POST['username']);
	$password = sha1($username.$_POST['password']);
	//debugger($username,true);
	$status = array();
				$status['last_login'] = 'CURRENT_TIMESTAMP';
	$lupdate = $user->updateLogin($username,$status);
	$user_info = $user->getUserByUsername($username);

	if(isset($user_info) && $user_info[0]->status == 1){
			if($user_info[0]->password == $password)
			{
				
				$_SESSION['customer_id'] = $user_info[0]->id;
				$_SESSION['first_name'] = $user_info[0]->first_name;
				$_SESSION['email_address'] = $user_info[0]->email_address;
				$_SESSION['role_id'] = $user_info[0]->role_id;
				
				//debugger($lupdate);
				$_SESSION['last_login'] = date_timestamp_get(($user_info[0]->last_login));
				//debugger($lupdate);
				if(isset($_SESSION['to_negotiation']))
				{
					//debugger('yes',true);
					$_SESSION['success'] = "Hello ".$user_info[0]->first_name."! You can continue your negotiation!";
					@header('location:negotiation');
					exit;

				//debugger($_SESSION,true);
					
				}
				else
				{
					$_SESSION['success'] = "Hello ".$user_info[0]->first_name."! Welcome to goshopping User Dashboard!";

				//debugger($_SESSION,true);
				@header('location: user');
				exit;
				}

				
			} else {
				$_SESSION['error'] = "Password does not match.";
				@header('location: login');
				exit;	
			}
	} else {
		$_SESSION['warning'] = "User does not exists or suspended.";
		@header('location: login');
		exit;
	}
} else {
	$_SESSION['warning'] = "Please login first";
	@header('location: login');
	exit;
}