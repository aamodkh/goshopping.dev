<?php include 'inc/header.php';?>
<?php include 'inc/top-menu.php'; 
	include_once 'admin/class/database.php';
	include 'admin/class/product.php';
	$product = new Product();
?>
<!-- banner -->
<div class="banner">
	<?php include 'inc/sidebar.php';?>
		<?php 
		
		//debugger($_GET,true);
			if((isset($_GET['pid'])) && (isset($_GET['price'])))
			{	
				//echo "here";
				$id = sanitize($_GET['pid']);
				$price = sanitize($_GET['price']);
				$act = substr(md5("negotiationborder".$id),5,10);
				if(($_GET['act']) == $act)
				{
					//echo "here";
					$productt = $product->getProductById($id);
					
					//echo "here";
					$productt[0]->price = $price; 
					//debugger($productt);
				}
			}

		 ?>
	<div class="w3l_banner_nav_right">
		<div class="col-md-12">
			<?php //debugger($productt); ?>
			<form action="checkout.php" method="post" class="form form-horizontal">
				<table class="table table-bordered">
					<thead>
						<th>S.N.</th>
						<th>Product Title</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Discount</th>
						<th>Amount</th>
					</thead>
					<tbody id ="cart-detail">
						<!-- <?php 
							//if($productt)
							{
								//foreach ($productt as $key => $value) 
								{
									?>
									<tr>
										<td><?php //echo $key+1; ?></td>
										<td><?php //echo $key->product_title; ?></td>
										<td><?php //echo $; ?></td>


									</tr>
<?php 

								}
							}


						 ?>
                          
 -->
					</tbody>
					<tfoot>
						<th colspan="5" style="text-align: right">Total: </th>
						<th>
							<input type="text" id="total_sum" readonly value="NPR. 0.0" style="border: none;" />
						</th>
					</tfoot>
				</table>
				<div class="form-group">
					<button class="btn btn-success pull-right" style="color: #000">
						<i class="fa fa-shopping-cart"></i> Checkout
					</button>
				</div>
			</form>	
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<!-- //top-brands -->
<?php include 'inc/footer.php';?>
<script type="text/javascript">
	var data = paypal.minicart.cart._items; //Cart Items
	var html = '';
	if(data.length != 0){
		var total = 0;
		$.each(data, function(index, value){

			html += '<tr>';
			html += '<td>'+(index+1)+'</td>';
			html += '<td>'+value._data.item_name+'</td>';
			html += '<td>'+value._data.quantity+'</td>';
			html += '<td>'+value._data.amount+'</td>';
			html += '<td>'+value._data.discount_amount+'</td>';
			var amount = (value._data.quantity*value._data.amount)-value._data.discount_amount;

			html += '<td>'+amount+'</td>';
			html += '</tr>';
			html += '<input type="hidden" name="product_id[]" value="'+value._data.product_id+'" />';
			html += '<input type="hidden" name="price[]" value="'+value._data.amount+'" />';
			html += '<input type="hidden" name="quantity[]" value="'+value._data.quantity+'" />';
			total = total+amount;
		});
		$('#total_sum').val('NPR. '+total);
	} else {
		html += '<tr><td colspan="6">Sorry! No items in the cart.</td></tr>';
	}
	$('#cart-detail').html(html);
</script>