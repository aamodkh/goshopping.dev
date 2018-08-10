<?php 
require 'inc/session.php';

include 'inc/header.php'; 
//include 'inc/functions.php'; 
include 'class/database.php';
include 'class/banner.php';
$banner = new Banner();
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
                   	Banner List
                   	<a href="banner-add" class="btn btn-success pull-right" ><i class="fa fa-fw fa-plus"></i> Add Banner</a>
                </h1>
            </div>
            <div class="col-lg-12">
                <table class="table table-bordered table-stripped" id="list-banner">
                    <thead>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Thumbnail</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                            $all_banner = $banner->getAllBanner();
                            if($all_banner){
                                foreach($all_banner as $key => $banner_info){
                                ?>
                                    <tr>
                                        <td><?php echo $key+1;?></td>
                                        <td><?php echo $banner_info->title;?></td>
                                        <td style="max-width: 200px; overflow: hidden;">
                                            <img src="<?php echo UPLOAD_URL;?>banner/<?php echo $banner_info->image_name;?>" style="width: 100%;">
                                        </td>
                                        <td>
                                            <?php echo $banner_info->link;?>
                                        </td>
                                        <td>
                                            <?php echo getStatus($banner_info->status); ?>
                                        </td>
                                        <td>
                                            <?php
                                                $edit_url = "banner-add?id=".$banner_info->id."&act=".substr(md5('edit-banner-'.$banner_info->id), 4, 17);
                                            ?>
                                            <a href="<?php echo $edit_url;?>" class="btn btn-success" style="border-radius: 50%">
                                                <i class="fa fa-fw fa-pencil"></i>
                                            </a>
                                            <?php 
                                                $del_url = "controller/banner?id=".$banner_info->id."&act=".substr(md5('del-banner-'.$banner_info->id),3,15);
                                            ?>
                                            <a href="<?php echo $del_url;?>" class="btn btn-danger" onclick="return confirm('Are you sure?');" style="border-radius: 50%">
                                                <i class="fa fa-fw fa-trash"></i>
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
<!-- /#page-wrapper -->

<?php include 'inc/footer.php'; ?> 
<script type="text/javascript" src='<?php echo PLUGINS_URL;?>datatable/js/jquery.dataTables.js'></script>
<script type="text/javascript">
    $(document).ready(function(e){
        $('#list-banner').DataTable();
    });
</script>