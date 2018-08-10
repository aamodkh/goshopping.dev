$(function() 
   {
	// body...
	$('#InvalidUsername').hide();
   	$('#signInButton').click(function(){
   		$('#username').focus();
   	});
   	$('#userSignIn').click(function(){
   		var username = $('#username').val();
   		if(username ==''){
   			$('#InvalidUsername').show();
   			return false;
		 	}
   		else
   		{
   			$.ajax({
 	 			data:{username:username},
   				type :"GET",
   				url: "insert_username.php",
   				success: function()
   				{
   					$('#signInButton').hide();
   					$('#signInArea').html('<span class= "welcome">Welcome <span id="loggedInUser">'+ username + '</span></span>');
  					
   				}
   			});
  			  				
   			$('#chatEnabled').show();
  			

   		}


 	 });
  });