<?php include 'inc/header.php';?>
<?php include 'inc/top-menu.php'; 

	include 'admin/class/product.php';
	$product = new Product();

if(isset($_GET['pid'])){
	$category_id = (int)sanitize($_GET['pid']);
	$child_cat_id = (isset($_GET['cid'])) ? (int)sanitize($_GET['cid']) : 0;

	$category_info = $category->getCategoryInfo('*', $category_id);
	$not_found = false;
	if(!$category_info){
		$not_found = true;
	}

	if($child_cat_id > 0){
		$child_cat_info = $category->getCategoryInfo('*',$child_cat_id);

		if(!$child_cat_info){
			$not_found = true;
		} else {
			$category_info = $child_cat_info;
		}

	}


} else {
	@header('location: ./');
	exit;
}
?>
<!-- banner -->
		<div class="banner">
			<?php include 'inc/sidebar.php';?>
	
			<div class="w3l_banner_nav_right">
				<?php 
					if($not_found){
						echo '<p class="alert alert-danger">Category information not found.</p>';
					} else {
						//debugger(UPLOAD_DIR, true);
						if(isset($category_info[0]->cat_image) && file_exists(UPLOAD_DIR.'category/'.$category_info[0]->cat_image)){
					?>
				<section class="slider">
					<h3 style="color: red;padding-left: 20px; padding-bottom: 20px;"><?php echo $category_info[0]->title;?></h3>
					<h3>Please scroll down <i class="fa fa-arrow-down"></i></h3>
					<div class="w3l_banner_nav_right_banner" style="background: url(<?php echo UPLOAD_URL.'category/'.$category_info[0]->cat_image;?>) no-repeat !important;">
					</div>

				</section>
				<?php } }?>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php 
		if(!$not_found){
			if($child_cat_id == 0){
				$product_data = $product->getProductByCategory($category_id);
			} else {
				$product_data = $product->getProductByCategory($category_id, $child_cat_id);
				//debugger($product_data[0]->id,true);
			}

			if($product_data){
				/*Product Lists*/
				include 'cat-product.php';
			} else {
				echo '<p class="alert alert-danger">Sorry! No product found in this category.</p>';
			}
		}
		?> 
<!-- //top-brands -->
<?php include 'inc/footer.php';?>