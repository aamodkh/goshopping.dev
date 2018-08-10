<?php 
require 'inc/session.php';

include 'inc/header.php'; 
//include 'inc/functions.php'; 
include 'class/database.php';
include 'class/category.php';
include 'class/user.php';
include 'class/product.php';
include 'class/productImages.php';

$user = new User();
$category = new Category();
$product = new Product();
$images = new ProductImages();


$act = "add";
if(isset($_GET['id']) && isset($_GET['act'])){
	$act = "update";

	$id = (int)sanitize($_GET['id']);
	if($_GET['act'] == substr(md5('edit-product-'.$id), 4,15)) {
		$product_info = $product->getProductById($id);

		if(!$product_info){
			$_SESSION['error'] = "Invalid Id";
			@header('location: product-list');
			exit;
		}

		$product_images = $images->getImagesByProduct($id);

	} else {
		$_SESSION['error'] = "Token Mismatch";
		@header('location: product-list');
		exit;
	}
}
?>

<div id="page-wrapper">
    
    <?php include 'inc/navigation.php'; ?>
    
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
            <?php include 'inc/notifications.php';?>
                <h1 class="page-header">
                    Product <?php echo ucfirst($act);?>
                </h1>
            </div>
            <div class="col-lg-12">
            	<form method="post" action="controller/product" enctype="multipart/form-data" class="form form-horizontal">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Product Title: </label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<input type="text" class="form-control" name="product_title" id="product_title" required value="<?php echo (isset($product_info[0]->product_title))? $product_info[0]->product_title :  '' ; ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Product Summary: </label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<textarea name="summary" id="summary" rows="7" class="form-control" style="resize: none;" required><?php echo (isset($product_info[0]->summary))? $product_info[0]->summary :  '' ; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Product Descripiton: </label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<textarea name="description" id="description" class="form-control" style="resize: none;"><?php echo (isset($product_info[0]->description))? html_entity_decode(stripslashes($product_info[0]->description)) :  '' ; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Category: </label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
						<?php
							$parent_category = $category->getParentCategory();
						?>
							<select name="category_id" id="category_id" class="form-control" required>
								<option value="" disabled selected>-- Select Any One --</option>
								<?php 
									if($parent_category){
										foreach($parent_category as $parents){
										?>
											<option value="<?php echo $parents->id;?>" <?php echo (isset($product_info[0]->category_id) && $product_info[0]->category_id == $parents->id)? 'selected' :  '' ; ?>><?php echo $parents->title;?></option> 
										<?php
										}
									}
								?>
							</select>
						</div>
					</div>
					
					
					<?php 
						$class = "hidden";
						if($act == "update" && isset($product_info[0]->child_cat_id) && $product_info[0]->child_cat_id > 0){
							$class = "";

							$child_cats = $category->getChildCat($product_info[0]->category_id);

						}

					?>




					<div class="form-group <?php echo $class;?>" id="child_cat_div">
						<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Child Category: </label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<select name="child_cat_id" id="child_cat_id" class="form-control">
								<option value="" disabled selected>-- Select Any One --</option>
								<?php 
									if(isset($child_cats) && $child_cats != ""){
									foreach($child_cats as $childs){
									?>
									<option value="<?php echo $childs->id;?>" <?php echo ($product_info[0]->child_cat_id == $childs->id) ? 'selected' : '';?>><?php echo $childs->title;?></option>
									<?php
									}
									}
								?>

							</select>
						</div>
					</div>


					
					<div class="form-group">
						<label for="" class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Price:</label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<input type="number" required name="price" id="price" class="form-control" value="<?php echo (isset($product_info[0]->price))? $product_info[0]->price :  '' ; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Discount:</label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<input type="number" name="discount" id="discount" class="form-control" value="<?php echo (isset($product_info[0]->discount))? $product_info[0]->discount :  '' ; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Status:</label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<select name="status" required id="status" class="form-control">
								<option value="1" <?php echo (isset($product_info[0]->status) && $product_info[0]->status == 1)? 'selected' :  '' ; ?>>Active</option>
								<option value="0" <?php echo (isset($product_info[0]->status) && $product_info[0]->status == 0)? 'selected' :  '' ; ?>>Inactive</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Is trending:</label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<input type="checkbox" value="1" name="trending" id="is_trending"  <?php echo (isset($product_info[0]->is_trending) && $product_info[0]->is_trending == 1)? 'checked' :  '' ; ?>>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Is Negotiable:</label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<input type="checkbox" value="1" name="is_negotiable" id="is_negotiable"  <?php echo (isset($product_info[0]->is_negotiable) && $product_info[0]->is_negotiable == 1)? 'checked' :  '' ; ?>>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Negotiation Border:</label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<input type="number" name="negotiation_border" id="negotiation_border" class="form-control" value="<?php echo (isset($product_info[0]->negotiation_border))? $product_info[0]->negotiation_border :  '' ; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-xs-12 col-sm-3 col-md-2 col-lg-2">From social survey:</label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<input type="checkbox" value="1" name="branded" id="is_branded" <?php echo (isset($product_info[0]->is_branded) && $product_info[0]->is_branded == 1)? 'checked' :  '' ; ?>>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Is Featured:</label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<input type="checkbox" value="1" name="featured" id="is_featured" <?php echo (isset($product_info[0]->is_featured) && $product_info[0]->is_featured == 1)? 'checked' :  '' ; ?>>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Vendor:</label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<select name="vendor_id" id="vendor_id" class="form-control">
								<option value="" selected disabled>Select Any One</option>
								<?php 
									$vendors = $user->getUserByroleId(2);
									if($vendors){
										foreach($vendors as $key=>$value){
										?>
										<option value="<?php echo $value->id;?>" <?php echo (isset($product_info[0]->vendor_id) && $product_info[0]->vendor_id == $value->id)? 'selected' :  '' ; ?>><?php echo $value->first_name." ".$value->last_name;?></option>
										<?php
										}
									}
								?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="" class="col-xs-12 col-sm-3 col-md-2 col-lg-2">Product Images:</label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<input type="file" name="product_images[]" multiple accept="image/*" <?php echo ($act == 'update') ? '' : 'required';?> />
						</div>
						<?php  
							if($act == "update" && isset($product_images) && $product_images != ""){
								foreach($product_images as $image_info){
								?>
								<div class="col-sm-3 thumbnail" id="thumb-<?php echo $image_info->id;?>">
									<img src="<?php echo PRODUCT_URL.$image_info->image_name;?>" style="max-height: 120px;">
									<a href="javascript:0;" class="btn btn-danger" style="border-radius: 50%" onclick="deleteImage(<?php echo $image_info->id;?>);">
										<i class="fa fa-trash"></i>
									</a>
								</div>
								<?php
								}
							}
						?>
					</div>
            	
            		<div class="form-group">
						<label for="" class="col-xs-12 col-sm-3 col-md-2 col-lg-2"></label>
						<div class="col-xs-12 col-sm-7 col-md-10 col-lg-7">
							<input type="hidden" name="product_id" value="<?php echo (isset($id)) ? $id : '';?>">
							<button class="btn btn-danger" type="reset">
								<i class="fa fa-trash"></i> Cancel
							</button>
							<button class="btn btn-success" type="submit">
								<i class="fa fa-send"></i> Submit
							</button>
						</div>
					</div>
            	

            	</form>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include 'inc/footer.php'; ?>
<script type="text/javascript" src="<?php echo PLUGINS_URL;?>tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({
		selector: '#description',
		height: 300,
		theme: 'modern',
		plugins: [
			'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'template paste textcolor colorpicker textpattern imagetools codesample toc help emoticons hr'
		],
		toolbar1: 'formatselect | bold italic  strikethrough  forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
		image_advtab: true,
		templates: [
		{ title: 'Test template 1', content: 'Test 1' },
		{ title: 'Test template 2', content: 'Test 2' }
		],
		content_css: [
			'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
			'//www.tinymce.com/css/codepen.min.css'
		]
	});


	$('#category_id').on('change',function(e){
		var cat_id = $('#category_id').val();
		$.post('inc/ajax.php',{cat_id: cat_id, act: "<?php echo substr(md5('get-sub-cat'), 5,15);?>"}, function (res){
			if(res != 0){
				var html = '';
				var sub_cat = $.parseJSON(res);
				if(sub_cat != ""){
					$.each(sub_cat, function(index, value){
						html += '<option value="'+value.id+'">'+value.title+'</option>';
					});

					$('#child_cat_id').html(html);

					$('#child_cat_div').removeClass('hidden');
				} else {
					$('#child_cat_id').html('');

					$('#child_cat_div').addClass('hidden');
				}
			} else {
				$('#child_cat_id').html('');

					$('#child_cat_div').addClass('hidden');
			}
		});
	});

	function deleteImage(image_id){
		var confirm_val =confirm('Are you sure you want to delete this image?');
			if(confirm_val == true){
				$.post('inc/ajax.php', {data: image_id, act: "<?php echo md5('del-image');?>"}, function(res){
					if(res == 1){
						$('#thumb-'+image_id).remove();
					} else {
						alert('Sorry! Image could not be deleted at this moment.');
					}
				});
			} else {

			}
	}
</script>