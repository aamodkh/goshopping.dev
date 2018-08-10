<?php
session_start();
    $cn = mysqli_connect('localhost','root','');
      if (!$cn) {
	  echo "unable to connect to server";
    }
    if (!mysqli_select_db($cn,'chatbox')){
   	echo "Database not selected";
   }
     $username = $_GET['username'];
     $message = $_GET['message'];
     //date_timezone_set('Asia/Kathmandu');
     date_default_timezone_set('Asia/Kathmandu');
     $messageTime = time();
     //echo $messageTime;
     //exit;
      //$x = suffle(rand(1,4));
          //$_SESSION['x'] = $x;
          //echo $x;
    //echo "string";
     $_SESSION['message_number'] = ($_SESSION['message_number'])*-1;
     $sql = "INSERT INTO chathistory(username,message,messageTime) VALUES
             ('".$username."','".$message."','".$messageTime."')";
//debugger($sql);
             
     $result =mysqli_query($cn,$sql) or 
       die(mysqli_error($cn));
//        $x = array();
//        $x = explode(" ", $message);
//         foreach ($x as $key) 
//         {
//           if is_numeric($x[$key]){
//               
// //       //debugger($_SESSION['message_number']);
// //       break;
//  }





?>

