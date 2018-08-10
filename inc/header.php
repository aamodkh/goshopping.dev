<?php 
	session_start();
	include 'inc/config.php';
	include INC_PATH.'inc/functions.php';
	include INC_PATH."class/database.php";
	include INC_PATH."class/category.php";
	$category = new Category();
?>
<!DOCTYPE html>
<html>
<head>
<title>Goshopping || <?php echo (isset($page_title)) ? ucfirst($page_title) : 'HOME';?></title>

<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Grocery Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="<?php echo CSS_URL;?>bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo CSS_URL;?>style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo CSS_URL;?>global.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="<?php echo CSS_URL;?>font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="<?php echo JS_URL;?>jquery-1.11.1.min.js"></script>
<script src="<?php echo JS_URL;?>display_chat.js"></script>
<script src="<?php echo JS_URL;?>send_message.js"></script>
<script src="<?php echo JS_URL;?>sign_in_out.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="<?php echo JS_URL;?>move-top.js"></script>
<script type="text/javascript" src="<?php echo JS_URL;?>easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>

	
<body>
