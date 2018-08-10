<?php include 'inc/header.php';?>
<!-- <div class="w3ls_logo_products_left">
			<h1><a href="index.php"><span>Go</span> Shopping</a></h1>
		</div> -->

<?php include 'inc/top-menu.php';
?>


<?php
include 'inc/sidebar.php'; 
//debugger($_POST,true);
if(!isset($_SESSION['customer_id']) || $_SESSION['customer_id'] == " ")
{
    //$a = array();
  	//$a= $_POST;
    //debugger($_SESSION['you'],true);
    //session_destroy();
    
    $_SESSION['item_name'] = $_POST['item_name'];
    $_SESSION['product_id'] = $_POST['product_id'];
    $_SESSION['negotiation_border'] = $_POST['negotiation_border'];
    $_SESSION['amount'] = $_POST['amount'];
    $_SESSION['discount_amount'] = $_POST['discount_amount'];
    $_SESSION['currency_code'] = $_POST['currency_code'];
    $_SESSION['warning'] = "Please login first to start negotiation!";
    $_SESSION['to_negotiation'] = 1;
    echo "<script>window.location.href='login.php';</script>";
    //@header("location:login.php");
    //echo "here";
    // $a = $_SESSION;
   // debugger($_SESSION);

  
}
?>
<!-- banner -->
<h1 style="text-align: left; color: red; padding-top: 20px;">CHAT PANEL</h1>
 <div class="w3l_banner_nav_right">
 	<?php 
if(isset($_SESSION['success']) && $_SESSION['success'] != ""){
	?>
		<div class="alert alert-success"><?php echo $_SESSION['success'];?></div>
	<?php
	} 
	unset($_SESSION['success']);
 ?>
<h2 style="float:right; color: green; text-align: justify;">Our system will help you to negotiate for the price. We hope for your high satisfaction and work to facilate our costumers as far as possible.</h2>
</div>
				<?php 
				//debugger($_POST);
				//$a = array();
				if(!isset($_SESSION['to_negotiation']))
				{
					$_SESSION['item_name'] = $_POST['item_name'];
    				$_SESSION['product_id'] = $_POST['product_id'];
    				$_SESSION['negotiation_border'] = $_POST['negotiation_border'];
    				$_SESSION['amount'] = $_POST['amount'];
    				$_SESSION['discount_amount'] = $_POST['discount_amount'];
    				$_SESSION['currency_code'] = $_POST['currency_code'];
				} 
				$a = array();
				//debugger($_SESSION);
				//debugger($_POST);
				$_SESSION['updated_price'] = $_SESSION['amount'];
				$x = rand(1,4);
    			$_SESSION['x'] = $x;
    			$_SESSION['message_number'] = 1;    			//debugger($_SERVER,true);
				//debugger($a);
				//debugger($_SESSION);
				//debugger($_POST,true);
			 ?>
			 <div class="banner">
		<div class="w3l_banner_nav_right">
			 <?php //echo exec("python ".SITE_URL."python.py C:\python.exe"); ?>
			 <div id ='chatbox'>
		 <section id ='signInArea' style="width:700px;">
			<form  name='signIn' action='' onsubmit='return false' >
				<span id='InvalidUsername'>InvalidUsername</span>
				<input type ='hidden' size ='13px' name='username' id='username' value='<?php echo $_SESSION['first_name']; ?>'/>
				<input type ='submit' id= 'userSignIn' value='start'/>
			</form>
		</section>

		<section id ='chatArea'  style="width:700px; ">
		</section>

		<section id ='messageTypingArea' style="width:700px;">
			<!-- <div id= 'signInToChat'>
				<button id='signInButton' type ='button'>sign In TO Enter Chat</button>
			</div> -->
			<div id='chatEnabled'>
				<form name='newmessage' class='newmessage' action='' onsubmit='return false'>
				   <section class='left style="width:500px;"'>
				   	<input class="disabled" type="textarea" style="resize: none; height: match-parent; width:703px;" name ='newMessageContent' id='newMessageContent' placeholder='Enter your message here'></>
				   	<input  type='submit' id='newMessageSend' value='send'/>
				   </section>
				   	
				</form>
			</div>
		</section>
	</div>

		</div>
	</div>
		<div class="clearfix"></div>


		 
<!-- //top-brands -->
<?php include 'inc/footer.php';?>
<script src="<?php echo JS_URL;?>minicart.min.js"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}

	function closeCart(){
		var minicart_ = paypal.minicart;
		minicart_.view.hide();
	}
</script>
