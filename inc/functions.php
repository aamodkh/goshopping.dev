<?php 
         //include_once "header.php";   
function chatmessage($row,$ratings)
{     //echo "string";
      $GLOBALS['ratinng'] = $ratings;
	$temp = array();
            $temp = ["greetings ".$_SESSION['first_name']."! Did you liked ".$_SESSION['item_name']."?","yoyo","hi there","namaskar","nice to meet you" ,"Feeling blessed"];
	//print_r($_SESSION);
	//exit;
	$b = array();
	$b = explode(" ", $row['message']);
	//print_r($b);
	//exit;
	foreach ($b as $key => $value) 
	{
		
            if($value == 'book' || $value == 'novel')
            {
            	$msg = "Well books? If I were you I would have gone for one of these.";
            	$address = SITE_URL."category?pid=11";
            	replyback($msg,$address);
            	$x = 1+1;
                  $GLOBAL['done'] = 1;
            	break;
            }

            if(($value == "hi") || ($value == "I dont like you bad person") ||  ($value == 'hello') || ($value == "namaskar") || ($value == "hy") || ($value == "greetings") || ($value == "cheers"))
            {
            	// $time = mktime();
                  //echo "string";
            	$time = '21:30:10';
				$seconds = strtotime("1970-01-01 $time UTC");
				//echo $seconds;
            	//debugger($time,true);
            	if($seconds % 10 >0)
            	{
            	$y = rand(1,5);
            	$temp1 = $y;
            	}
            	else
            	{
            	$temp1 = 0;
            	}
            	$msg = $temp[$temp1];
            	$address = " ";
                  $GLOBAL['done'] = 1;
            	replyback($msg,$address);
                  break;
            	
            }

            if(($value == 'automobiles') || ($value == 'auto') || ($value == 'auto mobile'))
            {
            	$msg = "Here are some branded vehicles.";
            	$address = SITE_URL.'category?pid=4';
                  $GLOBAL['done'] = 1;
            	replyback($msg,$address);
            	break;
            }


            if((is_numeric($value)) && (($value)<$_SESSION['amount']) && (($value)>= $_SESSION['negotiation_border']))
            {	
            	
	          // $ran = rand(0,5);
                  if($_SESSION['message_number']<0)
                  {
                        $msg = "It is still hard to decide. But fine , We are ready to sell it for Rs. ".$value; 
	                 $act = substr(md5("negotiationborder".$_SESSION['product_id']),5,10);
            	     $address = SITE_URL."checkout?price=".$value."&act=".$act."&pid=".$_SESSION['product_id'];
                       $GLOBAL['done'] = 1;
                  }else
                  {
                        $margin = (int)(($_SESSION['negotiation_border'] + (0.005*$_SESSION['negotiation_border'])));
                        $msg = " Sorry sir, My master will not be please , ok i am ready to come down to ".$margin." Are you ready? :) "; 
                        $address = SITE_URL;
                        $_SESSION['updated_price'] = $margin;
                  $act = substr(md5("negotiationborder".$_SESSION['product_id']),5,10);
                  $address = SITE_URL."checkout?price=".$_SESSION['updated_price']."&act=".$act."&pid=".$_SESSION['product_id'];
                  $GLOBAL['done'] = 1;
                  }
                  
            	replyback($msg,$address);
            	//exit();
            }

            if((is_numeric($value)) && (($value)< $_SESSION['negotiation_border']) || (isset($_POST['negotiation_border']) && (($value)<$_POST['negotiation_border'])))
            {
                  $x = $_SESSION['x'];
	           if($_SESSION['message_number'] <0)
                  {
                        $msg = "Sorry , we are unable to sell such a qualitative thing for".$value. ". Its too few ! We will meet soon thank u :) "; 
	                 $address = SITE_URL;
                  }else
                  {
                        //debugger($_SESSION['message_number']);
                        $margin = (int)($_SESSION['negotiation_border'] + $_SESSION['amount'] - $_SESSION['updated_price']);
                        if($margin<$_SESSION['negotiation_border'])
                        {
                              $margin = $_SESSION['negotiation_border'];
                        }
                        $msg = "Sorry sir, its  not possible , my last margin will be Rs. ".$margin." Are you ready? :) "; 
                        $_SESSION['updated_price'] = $_SESSION['negotiation_border']+0.05*$_SESSION['negotiation_border'];
                        $act = substr(md5("negotiationborder".$_SESSION['product_id']),5,10);
                        $address = SITE_URL."checkout?price=".$_SESSION['updated_price']."&act=".$act."&pid=".$_SESSION['product_id'];
                  }
                  $GLOBAL['done'] = 1;
            	replyback($msg,$address);
            	break;
            }
            if((is_numeric($value) && ($value) > $_SESSION['amount']) || (isset($_POST['amount']) && ($value)>$_POST['amount']))
            {
	           $msg = "Haha we are here for service as well sir. We need costumers for ever.".$value." is over the par , please tell how much will you pay :) ";
                  replyback($msg);
            	break;
            }	
            if(($value == 'expensive') || ($value == 'no') || ($value == 'mahango') || ($value =='decrease') || ($value == 'discount'))
            {
            	
            	$updated_price = intval(($_SESSION['amount'])-(($_SESSION['discount_amount'] *0.1)));

            	//debugger($updated_price);
            	//debugger($_SESSION['your_data']['negotiation_border'],true);
            	if($updated_price>= $_SESSION['negotiation_border'])
            	{
            		$msg = "  No problem ".$row['username']." if you really liked it, We can negotiate it. I could sell it to you for NRs.".$updated_price."Buy it?  or tell me your price.";
            	$_SESSION['updated_price'] = $updated_price;
            	$act = substr(md5("negotiationborder".$_SESSION['product_id']),5,10);
            	$address = SITE_URL."checkout?price=".$_SESSION['updated_price']."&act=".$act."&pid=".$_SESSION['product_id'];
                  $GLOBAL['done'] = 1;
            	replyback($msg,$address);
            	break;
            	}else
            	{
            		$msg = "Sorry that was my last border , I cannot do any more. Thank you :) Please try more products of this category ";
            		$address = SITE_URL;
                        $GLOBAL['done'] = 1;
            		replyback($msg,$address);
                        break;
            	}
            	
            }
            if((strtolower($value) == "where") || (strtolower($value) == "how") || (strtolower($value) == "who") || (strtolower(($value) == "what")) || (strtolower(($value) == "your name")))
            {
            	$msg = "We would talk about it later. Now, Lets talk about this product : ".$_SESSION['item_name'];
            	
            	$address = SITE_URL.'category?pid=11';
            	//@header("location: ../send_message.php?username=Minny&message=".$msg."<br>".$address);
            	//exit;
                  $GLOBAL['done'] = 1;
            	replyback($msg,$address);
            	
            } 
            $good =array();
            $good = ['good', 'nice', 'wow', 'enjoying' , 'not bad' , 'awesome' , 'worthy' ,'well','ya', 'yes'];

            for($c=0; $c<10; $c++)
            {
                  //echo "string";
                  //echo $good[$c];
            if ($value == $good[$c])
            {     //echo "s";
                  $msg = "Happy to know this. Ok the price for ".$_SESSION['item_name']." is ".$_SESSION['updated_price']." Buy it fine?";
                  $act = substr(md5("negotiationborder".$_SESSION['product_id']),5,10);
                  $address = SITE_URL."checkout?price=".$_SESSION['updated_price']."&act=".$act."&pid=".$_SESSION['product_id'];
                  //$address = SITE_URL;
                  $GLOBAL['done'] = 1;
                  $ok = 1000;
                  replyback($msg,$address);
                  break;
            }
           // replyback("buy for".$updated_price , $address );
      }
      
	}
}
function replyback($reply , $link =" ")
{
	?>
      <h4 style="float: right; color:green; padding-bottom: 10px;">  <?php echo $GLOBALS['ratinng']; ?></h4><br>
	<p style="float: right; color:green; padding-bottom: 10px;"><?php echo $reply; ?></p><br> 
      <?php if($link != " ")
	{
		?>
		<a style="float: right; padding-right: 0px; color: red;" href="<?php echo $link;?>">Go for it</a><br>
	<?php 
	}
}

function debugger($var, $is_die = false){
	echo "<pre>";
	print_r($var);
	echo "</pre>";
	if($is_die){
		exit;
	}
}

//include_once "footer.php";
?>
