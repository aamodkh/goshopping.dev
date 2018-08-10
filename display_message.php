<?php
session_start();
include "inc/config.php";
include "inc/functions.php";
//include ADMIN_URL."inc/functions.php";
include ('lib/sentiment_analyser.class.php');
$sa = new SentimentAnalysis();
$sa->initialize();

 $cn = mysqli_connect('localhost','root','');
    if (!$cn) 
    {
	  echo "unable to connect to server";
    }
    if (!mysqli_select_db($cn,'chatbox'))
    {
   	echo "Database not selected";
    }
   $tenMinuteAgo = time('+5:45') - 600;
//SELECT username,message,messageTime FROM chathistory WHERE username = "pradip" AND messageTime > 1111111111 ORDER BY messageTime

   $sql = "SELECT username,message,messageTime FROM chathistory
   WHERE username = '".$_SESSION['first_name']."' AND messageTime > ".$tenMinuteAgo." ORDER BY messageTime LIMIT 20";
  
     $result =mysqli_query($cn,$sql) or 
       die(mysqli_error($cn));


        while( $row = mysqli_fetch_assoc($result))
        {
        $messageTime = date('g:ia',$row['messageTime']);
        ?>
        <p style="padding-top:10px; color:red;"><label style="font-style: bold;">
        <?php  
         echo $row['username']." (".$messageTime.") : ";?>
         </label> <span style="color: black;">
         <?php echo ($row['message']);?></span></p> <?php
          //usleep(10000);
          ?>
          <!-- <div class='wrapper hidden'>
<form action='sentiment.php' method='POST' name='sent_data_form'>
      <textarea name='sent_data' id='sent_data'><?php// echo $row['message']; ?></textarea>
      <input type='submit' name='submit_data' value='Analyse' />
    </form>
  </div> -->



          <?php
          $sent_data = explode("\n",$row['message']);
            $min_submit_lev_score = $sa->return_levenshtein_min_submit_distance();
            $analysed_array = array();
            $i = 0;
            foreach ($sent_data as $dataset) {
              $original_data = $dataset;
              
              $check = $sa->analyse($dataset);
              $rating = $sa->return_sentiment_rating();
              $ratings_data = $sa->return_sentiment_calculations();
              //echo $ratings_data;
              $analysed_array[$i]['dataset'] = implode(' ',$sa->return_tokenized_mention());
              $analysed_array[$i]['original_dataset'] = $original_data;
              $analysed_array[$i]['rating'] = $rating;
              $analysed_array[$i]['preferred_match_type'] = $sa->return_preferred_match_type();
              $analysed_array[$i]['sentiment_analysis'] = $sa->return_sentiment_analysis();
              $analysed_array[$i]['proximity_analysis'] = $sa->return_phrase_proximity();
              $i++;
            }
            


            $rating = $analysed_array[0] ['rating']-2.5;
            
          //header("location: sentiment.php?sent_data=".$row['message']);  
          //debugger($_GET);
          //$rating = sanitize($_GET['rating']);
          //debugger($rating);
        
          //debugger($row['message']);
          //debugger($_SESSION,true);
            chatmessage($row,$rating);
            //exec("C:/xampp/htdocs/goshopping.dev/new.py");
        }    //sleep(1);
            //echo $_SESSION['item_name']."<br>";
             // echo '<p style="float: right; color:blue;" > Hello '.$row['username'] ." Sir. How can I help you?";
            //exit;
          // $b =array();
          // $b = explode(" ",$row['message']);
          // foreach ($b as $key => $value) 
          // {
          //   # code...
          //   if($value == "book")
          //   {
          //     echo(" <p style='float: right;' >well here are some books you can look for!<br>");
          //  <!-- <a style="float: right;"  target="_blank" href=" --><?php
          //   }
          // }

   // }



?>

