<?php

session_start();
include 'dbconnect.php';
$chat_date = substr(date("l"), 0,3);
$chat_date .=", ".date("h:i");

$username = $_SESSION['username'];
$chat_id = $_POST['id'];

$chat_join_qs = "INSERT INTO `chat_relationship`(`chat`, `user`) VALUES ('$chat_id','$username')";
$chat_join_q = mysqli_query($conn, $chat_join_qs);

if($chat_join_q){
        $message_import = "INSERT INTO `messages` (`chat`,`sender`,`msg`,`date`,`type`) VALUES ('$chat_id','$username','join','$chat_date','info')";
        $message_iq = mysqli_query($conn,$message_import);
        
}
 ?>
