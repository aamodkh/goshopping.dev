<?php
include 'inc/header.php';
//require $_SERVER['DOCUMENT_ROOT'].'/inc/config.php';

if(!isset($_SESSION['customer_id']) || $_SESSION['customer_id'] == "" || !isset($_SESSION['role_id']) ){
    session_destroy();
    @header('location: login');
    exit;
}

//include INC_PATH.'inc/functions.php';
//include INC_PATH."class/database.php";
include INC_PATH.'class/user.php';
$user = new User();
//debugger($_SESSION, true);
include 'admin/inc/notifications.php';?>
<h2 style="text-align: center; padding-top: 40px;"><?php echo $_SESSION['first_name']." Dashboard"; ?></h2>
<h3 style="padding-top: 40px; padding-left: 40px; text-align: center; "><a class="btn btn-success" href="<?php echo SITE_URL; ?>">GO to home page</a></h3>
<h3 style="padding-top: 40px; padding-left: 40px; text-align: center;"><a class="btn btn-success" href="<?php echo SITE_URL."cart/"; ?>">View your cart</a></h3>
<h3 style="padding-top: 40px; padding-left: 40px; text-align: center; "><a class="btn btn-success" href="<?php echo SITE_URL."logout/"; ?>">Log out</a></h3>
</body>