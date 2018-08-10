<?php include 'inc/header.php';
include 'inc/top-menu.php'; 
include 'admin/class/product.php';
include 'admin/class/productImages.php';
	$product = new Product();
	$product_image = new ProductImages();
	//debugger($_GET);

	if(isset($_GET['id'])) 
	{
	$product_id = (int)sanitize($_GET['id']);
	$act = substr(md5('get-detail-'.$product_id), 3, 15);
	if(isset($_GET['act']) && $_GET['act'] == $act)
	{


	//$child_cat_id = (isset($_GET['cid'])) ? (int)sanitize($_GET['cid']) : 0;

	$product_info = $product->getProductByID($product_id);
	$productimage = $product_image->getImageByProductId($product_id); 
	//debugger($product_info);
	//debugger($productimage);
	$not_found = false;
	if(!$product_info){
		$not_found = true;
	}
}
else{
		$_SESSION['warning'] = "Illegal entry!";
		@header('location: ./');
		exit;
}

} else{
	@header('location: ./');
	exit;
}
?>


	<div class="banner">
			<?php include 'inc/sidebar.php';?>
	
			<div class="w3l_banner_nav_right">
				<?php 
					if($not_found)
					{
						echo '<p class="alert alert-danger">Product information not found.</p>';
					}
					else{
						?>
						<h1 style="text-align: center;"><?php echo $product_info[0]->product_title; ?></h1>
						<div class="clearfix">
						</div>
						<h4 style="padding-bottom: 20px;"><label style="color: red; text-align: justify;">Product Summary: </label> <?php echo $product_info[0]->summary; ?></h2>
						<h4 style="padding-bottom: 20px;"><label style="color: red;">Product Description: </label> <?php echo $product_info[0]->product_title; ?></h4>
						<h4 style="padding-bottom: 20px;"><label style="color: red;">Price: </label> <?php echo $product_info[0]->price; ?></h4>
						 <?php  
						//debugger(UPLOAD_DIR, true);
						//echo (PRODUCT_URL.$productimage[0]->image_name);
						foreach ($productimage as $key => $value) {
						
						
						if($productimage[$key]->image_name!= "" && file_exists(PRODUCT_DIR."/".$productimage[0]->image_name))
						{
							$thumbnail = PRODUCT_URL."/".$productimage[0]->image_name;
						}
						else{
							$thumbnail = IMAGES_URL."default.jpg";}
							 ?>
						<div class="w3l_banner_nav_right_banner" style="background: url(<?php echo $thumbnail;?>) no-repeat !important;">
					</div>
						<?php   
				}
			}

			?>

			</div>

			<div class="clearfix"></div>
	</div>
	<?php include 'inc/footer.php';
	?>