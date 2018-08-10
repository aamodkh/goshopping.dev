<?php
?>
<!-- header -->
<div class="agileits_header" style="background-color: brown;">
	<div class="w3l_search">
		<form action="#" method="post">
			<input type="text" name="Product" value="Search a product..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search a product...';}" required="">
			<input type="submit" value=" ">
		</form>
	</div>
	<div class="product_list_header">  
		<a href="cart" class="btn btn-success" style=" height: 46px; font-size: 16px; color: #000; font-weight: bold; ">View your cart</a>
	</div>
	<div class="w3l_header_right">
		<ul>
			<li class="dropdown profile_details_drop">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
				<div class="mega-dropdown-menu">
					<div class="w3ls_vegetables">
						<ul class="dropdown-menu drp-mnu">
							<li><a href="<?php echo SITE_URL."login.php";?>">Login/sign up<i class="fa fa-sign-in"></i></a></li>
							<li><a href="<?php echo SITE_URL."logout.php";?>">Logout<i class="fa fa-sign-out"></i></a></li>
							<li><a href="<?php echo SITE_URL."user.php";?>">Dashboard<i class="fa fa-user"></i></a></li>
						</ul>
					</div>                  
				</div>	
			</li>
		</ul>
	</div>
	<div class="w3l_header_right1">
		<h2><a href="mail.html">Contact Us</a></h2>
	</div>
	<div class="clearfix"> </div>
</div>
<!-- script-for sticky-nav -->
<script>
	$(document).ready(function() {
		 var navoffeset=$(".agileits_header").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".agileits_header").addClass("fixed");
			}else{
				$(".agileits_header").removeClass("fixed");
			}
		 });
		 
	});
</script>
<!-- //script-for sticky-nav -->
<div class="logo_products">
	<div class="container">
		<div class="w3ls_logo_products_left">
			<h1><a href="../"><span>Go</span> Shopping</a></h1>
		</div>
		<div class="w3ls_logo_products_left1">
			<ul class="special_items">
				<li><a href="about.html">About Us</a><i></i></li>
				<li><i class="fa fa-phone" aria-hidden="true"></i>+9779860170348</li>
				<li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:khatiwadaaamod@gmail.com">info@goshopping.com</a></li>
			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<!-- //header -->