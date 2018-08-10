<?php 
require 'inc/session.php';
include 'inc/header.php'; 
include 'class/database.php';
include 'class/category.php';

$category = new Category();
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
                    <a href="category-add" class="btn btn-success pull-right"> <i class="fa fa-plus"></i> Add Category</a>
                </h1>
            </div>
            <div class="col-lg-12">
                <table class="table table-bordered table-stripped" id="category_table">
                    <thead>
                        <th>S.N.</th>
                        <th>Category Title</th>
                        <th>Show in Menu</th>
                        <th>Is parent</th>
                        <th>Parent Category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            $all_categories = $category->getAllCategory();
                            if($all_categories){
                                foreach($all_categories as $key => $cat_info){
                                ?>
                                    <tr>
                                        <td><?php echo $key+1;?></td>
                                        <td><?php echo $cat_info->title;?></td>
                                        <td><?php echo ($cat_info->show_in_menu == 1) ? 'Yes' : 'No';?></td>
                                        <td><?php echo ($cat_info->is_parent == 1) ? 'Yes' : 'No';?></td>
                                        <td>
                                            <?php 
                                                $title = $category->getCategoryInfo('title',$cat_info->parent_cat_id);
                                                if($title){
                                                    echo $title[0]->title;
                                                } else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo getStatus($cat_info->status);?></td>
                                        <td>
                                            <?php 
                                                $url = "category-add?id=".$cat_info->id."&act=".substr(md5('edit-cat-'.$cat_info->id), 5,13);
                                            ?>
                                            <a href="<?php echo $url;?>" class="btn btn-success" style="border-radius: 50%">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <?php 
                                                $del = "Controller/category?id=".$cat_info->id."&act=".substr(md5('del-cat-'.$cat_info->id), 5,13);
                                            ?>
                                            <a href="<?php echo $del;?>" class="btn btn-danger" style="border-radius: 50%" onclick="return confirm('Are you sure you want to delete this category?')">
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