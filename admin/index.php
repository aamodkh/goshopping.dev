<?php 
session_start();
require 'inc/config.php';

if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == 1 && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "" && isset($_SESSION['role_id']) && ($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2)){
    @header('location: dashboard');
    exit;
}

include 'inc/header.php'; 
include 'class/database.php';

?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                <?php include 'inc/notifications.php'; ?>
                	<form method="post" name="login" action="controller/login">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control" id="username" required />
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" id="password" required />
						</div>
						<div class="form-group">
							<input type="submit" name="submit" class="btn btn-primary" id="submit" required />
						</div>
                	</form>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include 'inc/footer.php'; ?>