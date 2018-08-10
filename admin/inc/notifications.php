<?php
	if(isset($_SESSION['success']) && $_SESSION['success'] != ""){
	?>
		<div class="alert alert-success"><?php echo $_SESSION['success'];?></div>
	<?php
	} 
	unset($_SESSION['success']);

	if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
	?>
		<div class="alert alert-danger"><?php echo $_SESSION['error'];?></div>
	<?php
	} 
	unset($_SESSION['error']);

	if(isset($_SESSION['warning']) && $_SESSION['warning'] != ""){
	?>
		<div class="alert alert-warning"><?php echo $_SESSION['warning'];?></div>
	<?php
	} 
	unset($_SESSION['warning']);
