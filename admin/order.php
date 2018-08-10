<?php 
require 'inc/session.php';
include 'inc/header.php'; 
include 'class/database.php';
include 'class/category.php';
include 'class/user.php';
include 'class/order.php';
include 'class/product.php';
$order = new Orders();
$user = new User();
$products = new Product();
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
                    Order List
                </h1>
            </div>
            <div class="col-lg-12">
                <table class="table table-bordered table-stripped" id="category_table">
                    <thead>
                        <th>S.N.</th>
                        <th>cart id</th>
                        <th>Customer name</th> 
                        <th>Shipping Address</th>
                        <th>Phone No.</th>
                        <th>products</th>
                        <th>Quantity</th>
                        <th>Order Time</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            $carts = $order->getAllOrders();
                           //debugger($carts,true);
                            $i = 0;
                           
                            //debugger($all_user,true);
                            //debugger($all_categories,true);
                            if($carts){
                                
                                foreach ($carts as $key1 => $value1) {
                                    # code...
                                 $all_user = $user->getUserById($carts[$key1]->user_id);
                            $productname = $products->getProductById($carts[$key1]->product_id); 
                                
                                //debugger($carts[$key1]->cart_id);
                                ?>
                                    <tr>
                                        <?php //debugger($key1); ?>
                                        <td><?php echo ++$key1;?></td>
                                        <td><?php echo $carts[$key1]->cart_id; ?></td>
                                        <td><?php echo $all_user[0]->first_name." ".$all_user[0]->last_name;?></td>
                                        <td><?php echo $all_user[0]->address; ?></td>
                                        <td><?php echo $all_user[0]->phone_number; ?></td>
                                        <?php  
                                        //debugger($key1['product_id']);
                                        //debugger($productname,true);
                                        //debugger($productname[0]->product_name,true);
                                         ?>
                                        <td><?php echo $productname[0]->product_title; ?></td>
                                        
                                        <td><?php echo $carts[$key1]->quantity; ?></td>
                                        <td><?php echo ($carts[$key1]->buying_time);?></td>
                                        <td><?php echo ($carts[$key1]->price); ?></td>
                                        <td><?php echo $carts[$key1]->status; ?></td>
                                        <td> 
                                            <form action="controller/order.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                         <select   name="status" id="status" class="form-control" required>
                                <option value="" selected disabled>--Select Any One--</option>
                                <option value="0" onchange ="deleteImage(value, 0 ?>);" <?php echo (isset($carts[$key1]->status) && $carts[$key1]->status == 0) ? 'selected'  : '';?>>Not verified</option>
                                <option value="1"  onclick ="deleteImage(value, 1 ?>);" <?php echo (isset($carts[$key1]->status) && $carts[$key1]->status == 1) ? 'selected'  : '';?>>Verified</option>
                                <option value="2" onclick ="deleteImage(value, <?php echo $carts[$key1]->cart_id; ?>);" <?php echo (isset($carts[$key1]->status) && $carts[$key1]->status == 2) ? 'selected'  : '';?>>On route</option>
                                <option value="3" onclick ="deleteImage(value, <?php echo $carts[$key1]->cart_id; ?>);" <?php echo (isset($carts[$key1]->status) && $carts[$key1]->status == 3) ? 'selected'  : '';?>>Delivered and received</option>
                                
                            </select>
                            <div class="form-group hidden">
                                <input type="text" name="cart_id" value="<?php echo($carts[$key1]->id); ?>"/>

                            </div>
                        </div>
                            <div class="form-group">
                              <input onclick ="deleteImage(value,1);" type="submit"  name="submit" id="status_submit">  

                            </div>
                        </form>
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
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<a href="javascript:;" id="anchor">Open</a>


<div class="modal fade" tabindex="-1" role="dialog" id="popupModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- /#page-wrapper -->

<?php include 'inc/footer.php'; ?> 
<script type="text/javascript" src='<?php echo PLUGINS_URL;?>datatable/js/jquery.dataTables.js'></script>
<script type="text/javascript">
    $(document).ready(function(e){
        $('#category_table').DataTable();
    });

    $('#anchor').on('click',function(e){
        e.preventDefault();
        $('#popupModal').modal('show');
    });


function deleteImage(status,id){
        //alert(status,id);
        var confirm_val = confirm('Are you sure you want to update the status?');
            if(confirm_val == true){
                $.post('inc/ajax.php', {id: id, status: status, act: substr(md5(statusupdate),4,6)}, function(res){
                    if(res == 1){
                        alert("successfully changed the status");
                    } else {
                        alert('Sorry! Status could not be changed at this moment.');
                    }
                });
            } else {

            }
    }


</script>