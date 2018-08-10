<?php 
require '../inc/session.php';
include INC_PATH.'inc/functions.php';
include INC_PATH.'class/database.php';
include INC_PATH.'class/product.php';
include INC_PATH.'class/productImages.php';

$product = new Product();
$product_images = new ProductImages();

if(isset($_POST) && !empty($_POST)){
	$data = array();
	/*debugger($_POST);
	debugger($_FILES, true);*/

	$data['product_title'] = sanitize($_POST['product_title']);
	$data['category_id'] = sanitize($_POST['category_id']);
	$data['child_cat_id'] = isset($_POST['child_cat_id']) ? sanitize($_POST['child_cat_id']) : null;
	$data['summary'] = sanitize($_POST['summary']);
	$data['description'] = sanitize(htmlentities($_POST['description']));
	$data['price'] = sanitize($_POST['price']);
	$data['discount'] = sanitize($_POST['discount']);
	$data['negotiation_border'] = sanitize($_POST['negotiation_border']);
	$data['is_negotiable'] = (isset($_POST['is_negotiable'])) ? sanitize($_POST['is_negotiable']) : 0;
	$data['status'] = sanitize($_POST['status']);
	$data['is_featured'] = (isset($_POST['featured'])) ? sanitize($_POST['featured']) : 0;
	$data['is_trending'] = (isset($_POST['trending'])) ? sanitize($_POST['trending']) : 0;
	$data['is_branded'] = (isset($_POST['branded'])) ? sanitize($_POST['branded']) : 0;
	$data['vendor_id'] = (isset($_POST['vendor_id'])) ? sanitize($_POST['vendor_id']) : 0;
	$data['added_by'] = $_SESSION['user_id'];

	$product_id = (int)sanitize($_POST['product_id']);

	if($product_id){
		$act = "updat";
		$success = $product->updateProduct($data, $product_id);
	} else {
		$act = "act";
		$product_id = $product->addProduct($data);
		$success = ($product_id) ? 'true' : 'false';
	}
	if($success){

		if(isset($_FILES['product_images']) && $_FILES['product_images']['error'][0] ==0){
			$path = "../../upload";
			if(!is_dir($path)){
				mkdir($path);
			}

			$upload_path = $path."/product";
			if(!is_dir($upload_path)){
				mkdir($upload_path);
			}

			$files = $_FILES['product_images'];
			for($i=0; $i<count($files['name']); $i++){
				$ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
				if(in_array(strtolower($ext), $allowed_exts)){
					$file_name = "Product-".date('Ymdhis').rand(0,999).".".$ext;

					$success = move_uploaded_file($files['tmp_name'][$i],$upload_path."/".$file_name);
					if($success){
						$tmp_array = array();
						$tmp_array['product_id'] = $product_id;
						$tmp_array['image_name'] = $file_name;

						$product_images->addImages($tmp_array);
						unset($tmp_array);
					}
				}
			}
		}

		$_SESSION['success'] = "Product ".$act."ed successfully.";
		@header('location: ../product-list');
		exit;
	} else {
		$_SESSION['error'] = "Sorry! There was probelm while ".$act."ing product.";
		@header('location: ../product-list');
		exit;
	}
} else if(isset($_GET['id']) && isset($_GET['act'])) {
	$id = (int)sanitize($_GET['id']);
	if($_GET['act'] == substr(md5('delete-product-'.$id), 4,15)){
		$product_info = $product->getProductById($id);
		if($product_info){
			$pro_images = $product_images->getImagesByProduct($id);

			//debugger($pro_images, true);
			$del = $product->deleteProduct($id);
			//$del = true;
			if($del){
				if($pro_images){
					//echo PRODUCT_DIR;
					foreach($pro_images as $key=>$images){
						if($images->image_name != "" && file_exists(PRODUCT_DIR.$images->image_name)){
							//echo "here <br/>";
							unlink(PRODUCT_DIR.$images->image_name);
						}
					} 
					$product_images->deleteImageByParent($id);
				}

				//exit;
				$_SESSION['success'] = "Product Deleted successfully.";
				@header('location: ../product-list');
				exit;
			} else {
				$_SESSION['error'] = "Sorry! There was problem while deleting product.";
				@header('location: ../product-list');
				exit;		
			}
		} else {
			$_SESSION['error'] = "Product not found.";
			@header('location: ../product-list');
			exit;	
		}
	} else {
		$_SESSION['error'] = "Token Mismatch.";
		@header('location: ../product-list');
		exit;
	}
} else {
	$_SESSION['error'] = "Please fill the form.";
	@header('location: ../product-add');
	exit;
}