<?php 
include 'session.php';
include 'functions.php';
include '../class/database.php';
include '../class/category.php';
include '../class/productImages.php';
include '../class/order.php';
$images = new ProductImages();
$order = new Orders();
$cat = new Category();

$act = sanitize($_POST['act']);

if($act == substr(md5('get-sub-cat'), 5,15)){
	$id = (int)sanitize($_POST['cat_id']);
	if($id > 0){
		$sub_cat = $cat->getChildCat($id);
		if($sub_cat){
			echo json_encode($sub_cat);
			exit;
		} else {
			echo 0;
			exit;
		}
	} else {
		echo 0;
		exit;
	}

} else if($act == md5('del-image')){
	$id = (int)sanitize($_POST['data']);
	if($id > 0){
		$image_info = $images->getImageById($id);

		if($image_info){
			$del = $images->deleteImage($image_info[0]->id);
			if($del){
				if($image_info[0]->image_name  != "" && file_exists(PRODUCT_DIR.$image_info[0]->image_name) ){
					unlink(PRODUCT_DIR.$image_info[0]->image_name);
				}
				echo 1;
				exit;
			} else {
				echo 0;
				exit;
			}
		} else {
			echo 0;
			exit;
		}
	} else {
		echo 0;
		exit;
	}
} else if($act == substr(md5('statusupdate'), 4,6))
{	
	$id = (int)sanitize($_POST['id']);
	$status = (int)sanitize($_POST['status']);
	$update = $order->updateStatus($id, $status);
	return $update;
}
else 
{
	echo "-1";
	exit;
}
