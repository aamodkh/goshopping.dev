<?php 
//echo "here";
//exit;
require 'inc/session.php';
include 'inc/header.php'; 
//include 'inc/functions.php'; 
include 'class/database.php';
?>

<div id="page-wrapper">
    
    <?php include 'inc/navigation.php'; ?>
    
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
            <?php include 'inc/notifications.php';?>
                <h1 class="page-header">
                    Goshopping Admin Panel
                </h1>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include 'inc/footer.php'; ?> 