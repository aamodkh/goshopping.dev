<?php 
require 'inc/session.php';
include 'inc/header.php'; 
include 'class/database.php';
include 'class/category.php';
include 'class/user.php';

$user = new User();
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
                    Category List
                    <a href="category-add" class="btn btn-success pull-right"> <i class="fa fa-plus"></i> Add Users</a>
                </h1>
            </div>
            <div class="col-lg-12">
                <table class="table table-bordered table-stripped" id="category_table">
                    <thead>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Phone No.</th>
                        <th>Address</th>
                        <th>User type</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php
                            $all_user = $user->getAllUser();
                            //debugger($all_categories,true);
                            if($all_user){
                                foreach($all_user as $key => $user_info){
                                ?>
                                    <tr>
                                        <td><?php echo $key+1;?></td>
                                        <td><?php echo $user_info->first_name." ".$user_info->last_name;?></td>
                                        <td><?php echo $user_info->username ?></td>
                                        <td><?php echo $user_info->phone_number; ?></td>
                                        <td><?php echo $user_info->address; ?></td>
                                        <td><?php echo getRole($user_info->role_id);?></td>
                                        <td><?php echo getStatus($user_info->status);?></td>
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
</script>