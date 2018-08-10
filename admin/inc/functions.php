<?php 
function debugger($var, $is_die = false){
	echo "<pre>";
	print_r($var);
	echo "</pre>";
	if($is_die){
		exit;
	}
}

function sanitize($var){
	if(get_magic_quotes_gpc()){
		$var = trim(stripslashes($var));
	}

	$var = strip_tags($var);
	$var = trim($var);
	$var = addslashes($var);
	return $var;
}

function getStatus($status)
{
	if($status == 1){
		return "Active";
	} else if($status == 0){
		return "Inactive";
	} else {
		return "Other";
	}
}

function getRole($role)
{
	if($role == 1){
		return "Super Admin";
	} else if($role == 2){
		return "Vendor";
	} else {
		return "Costumer";
	}
}

function getRandomString($length = 15){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$chars_length = strlen($characters);
	$random_str = '';
	for($i=0; $i < $length; $i++){
		$random_str .= $characters[rand(0, $chars_length-1)];
	}
	return $random_str;
}