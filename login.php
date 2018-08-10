<?php include 'inc/header.php';?>
<?php include 'inc/top-menu.php';?>
<?php 
	if(isset($_SESSION['customer_id']))
	{
		$_SESSION['warning'] = "You are already logged in.";
		//echo "here";
		include INC_PATH.'inc/notifications.php';
		?>
		<h3 style="text-align: center;"><a href="user">Go to dashboard</a></h3>
		<?php 
	exit; 
	}

	
 ?>
	<div class="banner">
		<?php include 'inc/sidebar.php';?>
		<div class="w3l_banner_nav_right">
			<?php include INC_PATH.'inc/notifications.php';?>
			<div class="col-md-6" style="border-right: 1px solid">
				<h4>Register</h4>
				<hr>
				<div class="col-md-12">
					<form action="register" method="post" class="form form-horizontal">
						<div class="form-group">
							<label for="">Full Name:</label>
							<input type="text" name="full_name" required id="full_name" class="form-control" />
						</div>
						<div class="form-group">
							<label for="">Username(Email Address):</label>
							<input type="email" name="username" required id="username" class="form-control" />
						</div>

						<div class="form-group">
							<label for="">Password:</label>
							<input type="password" name="password" required id="password" class="form-control" />
						</div>
						<div class="form-group">
							<label for="">Confirm Password:</label>
							<input type="password" name="re_password" required id="confirm_password" class="form-control" />
							<span class="btn-danger hidden" id="password_error"></span>
						</div>
						<div class="form-group">
							<label for="">Address:</label>
							<input type="text" name="address" required id="address" class="form-control" />
						</div>
						<div class="form-group">
							<label for="">Contact Number:</label>
							<input type="text" name="phone_number" required id="phone_number" class="form-control" />
						</div>
						<div class="form-group">
							<button class="btn btn-success" id="submit" name="submit">
								<i class="fa fa-send"></i> Register
							</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-6">
				<h4>Login</h4>
				<hr>
				<div class="col-md-12">
					<form action="process" method="post" class="form form-horizontal">
						<div class="form-group">
							<label for="">Username: </label>
							<input type="email" name="username" required id="username" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Password: </label>
							<input type="password" name="password" required id="password" class="form-control">
						</div>
						<div class="form-group">
							<button class="btn btn-success" id="login" name="login" type="submit">
								<i class="fa fa-send"></i> Login
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
<?php include 'inc/footer.php';?>

<script type="text/javascript">
	$('#confirm_password').keyup(function(res){
		var password = $('#password').val();
		var re_password = $('#confirm_password').val();
		if(password == "" || password != re_password){
			$('#password_error').html('Password is either null or does not match.');
			$('#password_error').removeClass('hidden');
			$('#submit').attr('disabled','disabled');
		} else {
			$('#password_error').html('');
			$('#password_error').addClass('hidden');
			$('#submit').removeAttr('disabled','disabled');
		} 
	});
</script>