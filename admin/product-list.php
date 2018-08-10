<?php 
require 'inc/session.php';

include 'inc/header.php'; 
//include 'inc/functions.php'; 
include 'class/database.php';
include 'class/product.php';

$product = new Product();

?>
<link rel="stylesheet" type="text/css" href="<?php echo PLUGINS_URL;?>datatable/css/dataTables.bootstrap.css" />

<div id="page-wrapper">
    
    <?php include 'inc/navigation.php'; ?>
    
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
            <?php include 'inc/notifications.php';?>
                <h1 class="page-header">
                    Product Lists
                    <a href="product-add" class="btn btn-success pull-right">
                    	<i class="fa fa-plus"></i> Add Product
                    </a>
                </h1>
            </div>
        </div>
        <!-- /.row -->
		<div class="row">
			<table class="table table-bordered" id="product-list">
				<thead>
					<th>S.N</th>
					<th>Product title</th>
					<th>Product Category</th>
					<th>Product Image</th>
					<th>Status</th>
					<th>Price</th>
					<th>Discount</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php 
					$products = $product->getAllProduct();
					if($products){
						foreach($products as $key=>$value){

						?>
						<tr>
							<td><?php echo $key+1;?></td>
							<td><?php echo $value->product_title;?></td>
							<td><?php echo $value->category;?></td>
							<td style="background: url(<?php echo PRODUCT_URL.$value->image_name;?>); background-size: cover; width: 200px;"></td>
							<td><?php echo ($value->status == 1) ? 'Active' : 'Inactive';?></td>
							<td><?php echo "NPR.".$value->price;?></td>
							<td><?php echo "NPR.".($value->price*$value->discount)/100;?></td>
							<td>
								<?php 
									$url = "?id=".$value->id."&act=".substr(md5('edit-product-'.$value->id), 4,15);
								?>

								<a href="product-add<?php echo $url;?>" class="btn btn-success" style="border-radius: 50%">
									<i class="fa fa-pencil"></i>
								</a>
								<?php 
									$url = "?id=".$value->id."&act=".substr(md5('delete-product-'.$value->id), 4,15);
								?>
								<a href="controller/product<?php echo $url;?>" class="btn btn-danger" style="border-radius: 50%" onclick="return confirm('Are you sure you want to delete this Product?')">
									<i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
						<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include 'inc/footer.php'; ?> 
<script type="text/javascript" src='<?php echo PLUGINS_URL;?>datatable/js/jquery.dataTables.js'></script>
<script type="text/javascript">
    $(document).ready(function(e){
        $('#product-list').DataTable();
    });
</script>