<?php 
session_start();
session_destroy();
session_start();
$_SESSION['success'] = "you are logged out successfully!";
@header("location:../");
exit;

?>
