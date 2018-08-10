<?php
session_start();
require '../inc/config.php';
include INC_PATH."inc/functions.php";
include INC_PATH."class/database.php";
include INC_PATH."class/user.php";
$user = new User();
//debugger($_POST,true);

if(isset($_POST) && !empty($_POST)){
	$username = sanitize($_POST['username']);
	$password = sha1($_POST['password']);
	//debugger($username);
	//debugger($password,true);
	
	$user_info = $user->getUserByUsername($username);
	//debugger($user_info,true);
	if(isset($user_info) && $user_info[0]->status == 1){
			if($user_info[0]->password == $password){
				$_SESSION['success'] = "Hello ".$user_info[0]->first_name."! Welcome to goshopping Admin panel!";

				$_SESSION['user_id'] = $user_info[0]->id;
				$_SESSION['first_name'] = $user_info[0]->first_name;
				$_SESSION['email_address'] = $user_info[0]->email_address;
				$_SESSION['role_id'] = $user_info[0]->role_id;
				$_SESSION['is_logged_in'] = true;
				//debugger('here',true);

				@header('location: ../dashboard');
				exit;
			} else {
				$_SESSION['error'] = "Password does not match.";
				@header('location: ../');
				exit;	
			}
	} else {
		$_SESSION['warning'] = "User does not exists or suspended.";
		@header('location: ../');
		exit;
	}
} else {
	$_SESSION['warning'] = "Please login first";
	@header('location: ../');
	exit;
}