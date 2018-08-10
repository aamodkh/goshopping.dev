<?php 
require 'inc/session.php';

//include 'inc/functions.php'; 
include 'inc/header.php'; 
include 'class/database.php';
include 'class/category.php';
$category = new Category();

$act = "Add";
if(isset($_GET['id']) && isset($_GET['act'])){
$act = "Edit";

    $id = sanitize($_GET['id']);
    if($_GET['act'] == substr(md5('edit-cat-'.$id), 5,13)){
        $category_info = $category->getCategoryInfo('*', $id);
        if(!$category_info){
            $_SESSION['error'] = "Category already deleted or not found.";
            @header('location: categroy-list');
            exit;    
        }
    } else {
        $_SESSION['warning'] = "Invalid Action";
        @header('location: categroy-list');
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
                    Category <?php echo $act;?>
                </h1>
            </div>
            <div class="col-lg-12">
                <form action="controller/category" class="form form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="col-sm-3">Cateogry Title:</label>
                        <div class="col-sm-8">
                            <input type="text" name="title" required class="form-control" value="<?php echo (isset($category_info[0]->title)) ? $category_info[0]->title : '';?>" />
                        </div>
                    </div>
                        <div class="form-group">
                        <label for="" class="col-sm-3">Summary:</label>
                        <div class="col-sm-8">
                            <textarea name="summary" id="summary" rows="6" class="form-control" style="resize: vertical;" required><?php echo (isset($category_info[0]->summary)) ? $category_info[0]->summary : '';?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3">Status:</label>
                        <div class="col-sm-8">
                            <select name="status" id="status" class="form-control" required>
                                <option value="" selected disabled>--Select Any One--</option>
                                <option value="1" <?php echo (isset($category_info[0]->status) && $category_info[0]->status == 1) ? 'selected'  : '';?>>Active</option>
                                <option value="0" <?php echo (isset($category_info[0]->status) && $category_info[0]->status == 0) ? 'selected'  : '';?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3">Show in Menu:</label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="show_in_menu" value="1"  <?php echo (isset($category_info[0]->show_in_menu) && $category_info[0]->show_in_menu == 1) ? 'checked'  : '';?> /> Yes
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3">Is Parent:</label>
                        <div class="col-sm-8">
                            <?php 

                                if(strtolower($act) == "add"){
                                    $checked = "checked";
                                } else {
                                    if(isset($category_info[0]->is_parent) && $category_info[0]->is_parent == 1){
                                        $checked = 'checked';
                                    } else {
                                        $checked = '';
                                    }
                                }
                            ?>
                            <input type="checkbox" name="is_parent" id="is_parent" value="1" <?php echo $checked;?>  /> Yes
                        </div>
                    </div>
                    <?php 
                    if(strtolower($act) == "add"){
                    ?>
                    <div class="form-group hidden" id="child_category">
                        <label class="col-sm-3">Parent Category: </label>
                        <div class="col-sm-8">
                            <?php 
                                $all_parent = $category->getParentCategory();
                            ?>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="" selected>--Select Parent Category--</option>
                                <?php 
                                    if($all_parent){
                                        foreach($all_parent as $parent_category){
                                ?>
                                        <option value="<?php echo $parent_category->id;?>"><?php echo $parent_category->title;?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php } else {
                        $hidden = 'hidden';
                        if(isset($category_info[0]->is_parent) && $category_info[0]->is_parent == 0){
                            $hidden = '';
                        }
                    ?>
                    <div class="form-group <?php echo $hidden;?>" id="child_category">
                        <label class="col-sm-3">Parent Category: </label>
                        <div class="col-sm-8">
                            <?php 
                                $all_parent = $category->getParentCategory();
                            ?>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="" selected>--Select Parent Category--</option>
                                <?php 
                                    if($all_parent){
                                        foreach($all_parent as $parent_category){
                                ?>
                                        <option value="<?php echo $parent_category->id;?>" <?php echo ($parent_category->id == $category_info[0]->parent_cat_id) ? 'selected' : '';?>><?php echo $parent_category->title;?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?Php
                    } ?>
                    <div class="form-group">
                        <label class="col-sm-3">Category Image: </label>
                        <div class="col-sm-8">
                            <input type="file" name="category_image" id="category_image" accept="image/*" />
                            <?php
                                if(strtolower($act) != "add"){
                                    if(file_exists("../uploads/category/".$category_info[0]->cat_image)){
                                    ?>
                                        <div class="thumbnail" style=" float: right; margin-top: -76px;">
                                            <img src="<?php echo UPLOAD_URL.'category/'.$category_info[0]->cat_image;?>" class="img-responsive" style="max-width: 200px">
                                        </div>
                                    <?php
                                    }
                                }
                            ?>
                            <span class="alert-danger hidden" id="category_image_error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="category_id" value="<?php echo (isset($category_info[0]->id)) ? $category_info[0]->id : '';?>">
                        <input type="submit" name="category_add" id="category_add" value="Category <?php echo $act;?>" class="btn btn-success">
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
<script type="text/javascript">
    $('#is_parent').on('change',function(e){
        var value = $('#is_parent').prop('checked');
        if(value == false){
            $('#child_category').removeClass('hidden');
        } else {
            $('#child_category').addClass('hidden');
        }
    });
</script>

<script type="text/javascript">
    var allowed_ext = ["jpg",'jpeg','png','gif'];

    $('#category_image').change(function(e){
        var filename = $(this).val();
        var ext = /[^.]+$/.exec(filename);
        var exists = allowed_ext.indexOf(ext[0]);
        if(exists >= 0){
            $('#category_image_error').html(' ').addClass('hidden');
            $('#category_add').removeAttr('disabled','disabled');
        } else {
            $('#category_image_error').html('File Format not supported').removeClass('hidden');
            $('#category_add').attr('disabled','disabled');
        }
    });

    

</script>