<?php 

require '../inc/session.php';
include INC_PATH.'inc/functions.php';
include INC_PATH.'class/database.php';
include INC_PATH.'class/category.php';

$category = new Category();

/*debugger($_POST);
debugger($_FILES, true);*/

if(isset($_POST) && !empty($_POST)){
	$data = array();
	$data['title'] = sanitize($_POST['title']);
	$data['status'] = sanitize($_POST['status']);
	$data['summary'] = sanitize($_POST['summary']);
	$data['show_in_menu'] = (isset($_POST['show_in_menu'])) ? sanitize($_POST['show_in_menu']) : 0;
	
	$data['is_parent'] = (isset($_POST['is_parent'])) ? sanitize($_POST['is_parent']) : 0;
	
	$data['parent_cat_id'] = (isset($_POST['parent_id'])) ? sanitize($_POST['parent_id']) : 0;
	
	if($data['parent_cat_id'] == '' || $data['parent_cat_id'] == 0 ){
		$data['is_parent'] = 1;
	}

	$data['cat_image'] = '';
	$default_image = '';

	$category_id = (isset($_POST['category_id'])) ? sanitize($_POST['category_id']) : '';

	if(isset($_FILES['category_image']) && $_FILES['category_image']['error'] ==0 ){
		$ext = pathinfo($_FILES['category_image']['name'], PATHINFO_EXTENSION);
		if(in_array($ext, $allowed_exts)){
			$file_name = "category-".date('Ymdhis').rand(0,999).".".$ext;

			$upload_dir = "../../uploads";
			if(!is_dir($upload_dir)){
				mkdir($upload_dir);
			}

			$upload_path = $upload_dir."/category";
			if(!is_dir($upload_path)){
				mkdir($upload_path);
			}

			

			$success = move_uploaded_file($_FILES['category_image']['tmp_name'], $upload_path."/".$file_name);
			if($default_image != ""){
				unlink($upload_path."/".$default_image);
			}

			if($success){
				$data['cat_image'] = $file_name;
			}
		}
	} else {
		$data['cat_image'] = $default_image;
	}


	if($category_id == ""){
		$act = "add";
		$cat_success = $category->addCategory($data);
	} else {
		$act = "updat";
		if($data['cat_image'] == ''){
			unset($data['cat_image']);
		}
		$cat_success = $category->updateCategory($data, $category_id);
	}
	if($cat_success){
		$_SESSION['success'] = "Category ".$act."ed successfully";
	} else {
		$_SESSION['error'] = "Sorry! There was problem while ".$act."ing category.";
	} 
	@header('location: ../category-list');
	exit;
} else if(isset($_GET['id']) && isset($_GET['act']) && $_GET['act'] != "" && $_GET['id'] != ""){
	$id = sanitize($_GET['id']);
	if($_GET['act'] == substr(md5('del-cat-'.$id), 5, 13)){
		$data = $category->getCategoryInfo('*',$id);
		if($data){
			$del = $category->deleteCategory($id);
			if($del){
				if($data[0]->is_parent == 1){
					$category->shiftChild($id);
				}

				if($data[0]->cat_image != "" && file_exists("../../uploads/category/".$data['0']->cat_image)){
					unlink("../../uploads/category/".$data['0']->cat_image);
				}

				$_SESSION['success'] = "Category Deleted successfully.";
			} else {
				$_SESSION['error'] = "Sorry! There was problem while deleting category.";
			}
			@header('location: ../category-list');
			exit;
		} else {
			$_SESSION['info'] = "Sorry! The data has already been deleted.";
			@header('location: ../category-list');
			exit;
		}
	} else {
		$_SESSION['warning'] = "Invalid action";
		@header('location: ../category-list');
		exit;
	}
}

else {
	$_SESSION['warning'] = "Fill the form correctly.";
	@header('location: ../category-add');
	exit;
}
