<?php 
require '../inc/session.php';
include INC_PATH.'inc/functions.php';
include INC_PATH.'class/database.php';
include INC_PATH.'class/banner.php';

$banner = new Banner();

/*debugger($_POST);
debugger($_GET);
debugger($_FILES, true);*/

if(isset($_POST) && !empty($_POST)){
	$data = array();
	$data['title'] = sanitize($_POST['banner_title']);
	$data['link'] = sanitize($_POST['banner_link']);
	$data['status'] = sanitize($_POST['status']);
	$data['image_name'] = "";
	$banner_id = sanitize($_POST['banner_id']);

	$default_image= sanitize($_POST['default_image']);

	if(isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] == 0){
		$ext = pathinfo($_FILES['banner_image']['name'], PATHINFO_EXTENSION);
		if(in_array($ext, $allowed_exts)){
			$file_name = "banner-".date('Ymdhis').rand(0,999).".".$ext;

			$upload_dir = "../../uploads";
			if(!is_dir($upload_dir)){
				mkdir($upload_dir);
			}

			$upload_path = $upload_dir."/banner";
			if(!is_dir($upload_path)){
				mkdir($upload_path);
			}

			

			$success = move_uploaded_file($_FILES['banner_image']['tmp_name'], $upload_path."/".$file_name);
			if($default_image != ""){
				unlink($upload_path."/".$default_image);
			}

			if($success){
				$data['image_name'] = $file_name;
			}
		}
	} else {
		$data['image_name'] = $default_image;
	}


	if($banner_id == ""){
		$act = "add";
		$last_insert = $banner->addBanner($data);
	} else  {
		$act = "updat";
		$last_insert = $banner->updateBanner($data, $banner_id);
	}

	if($last_insert){
		$_SESSION['success'] = "Banner ".$act."ed successfully";
	} else {
		$_SESSION['error'] = "Sorry! There was problem while ".$act."ing banner.";
	}
	@header('location: ../banner');
	exit;
} else if(isset($_GET['id']) && isset($_GET['act'])){
	$id = sanitize($_GET['id']);
	if($_GET['act'] == substr(md5('del-banner-'.$id), 3, 15)){
		$banner_info = $banner->getBannerById($id);

		if($banner_info){
			$banner_image = $banner_info[0]->image_name;
			$del = $banner->deleteBanner($banner_info[0]->id);

			if($del){
				if($banner_image != "" &&file_exists("../../uploads/banner/".$banner_image)){
					unlink("../../uploads/banner/".$banner_image);
				}
				$_SESSION['success'] = "Banner deleted successfully.";
				@header('location: ../banner');
				exit;
			} else {
				$_SESSION['error'] = "Sorry! There was problem while deleting banner";
				@header('location: ../banner');
				exit;
			}
		} else {
			$_SESSION['error'] = "Banner already deleted or not found.";
			@header('location: ../banner');
			exit;	
		}
	} else {
		$_SESSION['error'] = "Undefined Action or Banner already deleted.";
		@header('location: ../banner');
		exit;	
	}
}else {
	$_SESSION['error'] = "Fill the form first.";
	@header('location: ../banner-add');
	exit;
}
