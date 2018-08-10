<?php
   $cn = mysqli_connect('localhost','root','');
   if (!$cn) {
	echo "unable to connect to server";
}
   if (!mysqli_select_db($cn,'chatbox')){
   	echo "Database not selected";
   }
   //print_r($_GET);
   //exit;
    $username = $_GET['username'];
    //INSERT INTO users (username) VALUES ('Pradip');
    $sql = "INSERT INTO users(username) VALUES
             ('".$username."')";
             
     $result =mysqli_query($cn,$sql) or 
       die(mysqli_error($cn));




  ?>


     


