
<!-- newsletter -->
	<div class="newsletter" style="background-color: lightblue;" id = "hide_in_negotiation">
		<div class="container" >
			<div class=""  >
				<h5 style="text-align: center; color: black;"><i class="fa fa-copyright"></i>COPYRIGHT 2017 AAMOD SANDEEP PRADIP Goshopping.com All Right Reserved.</h5>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //newsletter -->
<!-- footer -->
	
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo JS_URL;?>bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<script src="<?php echo JS_URL;?>minicart.min.js"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}

	function closeCart(){
		var minicart_ = paypal.minicart;
		minicart_.view.hide();
	}
</script>
</body>
</html>