<?php include 'inc/header.php';?>
<?php include 'inc/top-menu.php'; 
//include ADMIN_URL."inc/notification.php"; 
include INC_PATH."class/banner.php";
include INC_PATH."class/product.php";
$banner = new Banner();
$product = new Product();
if(isset($_SESSION['success']) && $_SESSION['success'] != ""){
	?>
		<div class="alert alert-success"><?php echo $_SESSION['success'];?></div>
	<?php
	} 
	unset($_SESSION['success']);
?>
<!-- banner -->

	<div class="banner">
		<?php include 'inc/sidebar.php';?>
		<div class="w3l_banner_nav_right">

			<section class="slider">
				<div class="flexslider">
					<ul class="slides">
						<?php  
							$all_banners = $banner->getAllBanner(1);
							if($all_banners){
								foreach($all_banners as $lists){
								?>
								<li>
									<div class="w3l_banner_nav_right_banner" style="background: url(<?php echo UPLOAD_URL.'banner/'.$lists->image_name;?>) no-repeat 0px 0px; background-size: cover">
										<h3 style="color: black; font-style: bold;"><?php echo $lists->title;?></h3>
										<div class="more">
											<a target= "_blank" href="<?php echo "http://".$lists->link;?>" class="button--saqui button--round-l button--text-thick " data-text="Shop now">Go ahead!</a>
										</div>
									</div>
								</li>
								<?php
								}
							}

						?>
						
					</ul>
				</div>

			</section>
			<!-- flexSlider -->
				<link rel="stylesheet" href="<?php echo CSS_URL;?>flexslider.css" type="text/css" media="screen" property="" />
				<script defer src="<?php echo JS_URL;?>jquery.flexslider.js"></script>
				<script type="text/javascript">
				$(window).load(function(){
				  $('.flexslider').flexslider({
					animation: "slide",
					start: function(slider){
					  $('body').removeClass('loading');
					}
				  });
				});
			  </script>
			<!-- //flexSlider -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- banner -->
	<!-- <div class="banner_bottom">
			<div class="wthree_banner_bottom_left_grid_sub">

			</div>
			<div class="wthree_banner_bottom_left_grid_sub1">
				<h2 class ="class:danger">The site is under construction!</h2>

				<div class="col-md-4 wthree_banner_bottom_left">
					<div class="wthree_banner_bottom_left_grid">
						<img src="<?php echo IMAGES_URL;?>4.jpg" alt=" " class="img-responsive" />
						<div class="wthree_banner_bottom_left_grid_pos">
							<h4>Discount Offer <span>25%</span></h4>
						</div>
					</div>
				</div>
				<div class="col-md-4 wthree_banner_bottom_left">
					<div class="wthree_banner_bottom_left_grid">
						<img src="<?php echo IMAGES_URL;?>5.jpg" alt=" " class="img-responsive" />
						<div class="wthree_banner_btm_pos">
							<h3>introducing <span>best store</span> for <i>groceries</i></h3>
						</div>
					</div>
				</div>
				<div class="col-md-4 wthree_banner_bottom_left">
					<div class="wthree_banner_bottom_left_grid">
						<img src="<?php echo IMAGES_URL;?>6.jpg" alt=" " class="img-responsive" />
						<div class="wthree_banner_btm_pos1">
							<h3>Save <span>Upto</span> $10</h3>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
	</div> -->
<!-- top-brands -->
<?php  
	$product_data = $product->getBrandedProducts();
	//debugger($product_data);
	if($product_data){
		
?>	<div class="top-brands">
		<div class="container">
			<h3>People are positive about</h3>
			<?php 
			//$pradeep = "hello";
			// $result = shell_exec("C:/xampp/htdocs/goshopping.dev/new.py");
			// $result = json_decode($result);
			// passthru("C:/xampp/htdocs/goshopping.dev/new.py");
			// print $result; 
			// $title = "Some title";
			// $message = "some message";
			// $command = "C:/xampp/htdocs/goshopping.dev/new.py -t $title";
			// exec($command);

			$data = array('This product is very expensive', 'df', 'gh');

// Execute the python script with the JSON data
			$result = shell_exec("C:/xampp/htdocs/goshopping.dev/new.py ".$data[0]." ");
			debugger($result);
			//$resultt = shell_exec("C:/Users/dell/nmt-chatbot/inference.py ");
			//debugger($resultt);
// Decode the result
				//$resultData = json_decode($result, true);

// This will contain: array('status' => 'Yes!')
				var_dump($result);
			?>
			<div class="agile_top_brands_grids">
				<?php include 'cat-product.php'; ?>
			</div>
		</div>
	</div>
<?php } ?>
<!-- //top-brands -->
<!-- fresh-vegetables -->

<?php  
	$product_data = $product->getTopProducts();
	//debugger($product_data);
	if($product_data){
		
?>	<div class="top-brands">
		<div class="container">
			<h3>Heavy discount offers</h3>
			<div class="agile_top_brands_grids">
				<?php include 'cat-product.php'; ?>
			</div>
		</div>
	</div>
<?php } ?>
<!-- //fresh-vegetables -->
<?php include 'inc/footer.php';?>