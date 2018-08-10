<?php 
require 'inc/session.php';

include 'inc/header.php'; 
//include 'inc/functions.php'; 
include 'class/database.php';
include 'class/banner.php';
$banner = new Banner();
$act = "add";

if(isset($_GET['id']) && isset($_GET['act'])){
    $id = sanitize($_GET['id']);
    $act = "edit";
    if($_GET['act'] == substr(md5('edit-banner-'.$id), 4, 17)){
        $banner_info = $banner->getBannerById($id);

        if(!$banner_info){
            $_SESSION['info'] = "Banner not found or already deleted.";
            @header('location: banner');
            exit;            
        }
    } else {
        $_SESSION['warning'] = "Invalid action";
        @header('location: banner');
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
                   	Banner <?php echo ucfirst($act); ?>
                   	<a href="banner" class="btn btn-link " ><i class="fa fa-fw fa-undo"></i> Go Back</a>
                </h1>
            </div>

            <div class="col-lg-12">
            <form action="controller/banner" method="post" enctype="multipart/form-data" class="form form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3">Banner Title: </label>
                        <div class="col-sm-9">
                            <input type="text" name="banner_title"  placeholder="Banner Title" class="form-control" value="<?php echo (isset($banner_info[0]->title)) ? $banner_info[0]->title : '';?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3">Banner Link: </label>
                        <div class="col-sm-9">
                            <input type="text" name="banner_link" required placeholder="Link" class="form-control"  value="<?php echo (isset($banner_info[0]->link)) ? $banner_info[0]->link : '';?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3">Banner Status: </label>
                        <div class="col-sm-9">
                            <select name="status" id="status" class="form-control">
                                <option value="">--Select One Option--</option>
                                <option value="1" <?php echo (isset($banner_info[0]->status) && $banner_info[0]->status == 1) ? 'selected' : '';?>>Active</option>
                                <option value="0" <?php echo (isset($banner_info[0]->status) && $banner_info[0]->status == 0) ? 'selected' : '';?>>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3">Banner Image: </label>
                        <div class="col-sm-9">
                            <input type="file" name="banner_image" <?php echo ($act == "add") ? 'required' : '';?> accept="image/*" id="banner_image" />

                            <input type="hidden" name="default_image" value="<?php echo (isset($banner_info[0]->image_name) && $banner_info[0]->image_name != '') ? $banner_info[0]->image_name : '';?>">

                            <p id='upload_error' class="hidden alert-danger"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="banner_id" value="<?php echo (isset($banner_info[0]->id)) ? $banner_info[0]->id : '';?>">
                        <input type="submit" name="submit" value="<?php echo ucfirst($act);?> Banner" id="banner_add" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include 'inc/footer.php';
    // in_array($search, $collection); // true or false

 ?> 
<script type="text/javascript">
    var allowed_ext = ["jpg",'jpeg','png','gif'];

    $('#banner_image').change(function(e){
        var filename = $(this).val();
        var ext = /[^.]+$/.exec(filename);
        var exists = allowed_ext.indexOf(ext[0]);
        if(exists >= 0){
            $('#upload_error').html(' ').addClass('hidden');
            $('#banner_add').removeAttr('disabled','disabled');
        } else {
            $('#upload_error').html('File Format not supported').removeClass('hidden');
            $('#banner_add').attr('disabled','disabled');
        }
    });

</script>