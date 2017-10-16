<?php
include 'dbconnect.php';
$username = $_SESSION['username'];

$retrieve_mychat_names = "SELECT * FROM `chat_relationship` WHERE `user` = '$username'";
$sql_result_name = mysqli_query($conn,$retrieve_mychat_names);
$number_mychat = mysqli_num_rows($sql_result_name);
$chat = "";
if($number_mychat == 0){
$chat = "<p>No chats yet</p>";

}else{



$mychat_names_row = mysqli_fetch_assoc($sql_result_name);

$chat_index = $mychat_names_row['chat'];

$chat_query = "SELECT * FROM `chats` WHERE `index` = '$chat_index'";
$chat_query_q = mysqli_query($conn,$chat_query);
$chat_row = mysqli_fetch_assoc($chat_query_q);

$chat_title = $chat_row['title'];
$mychat = "<div class='mychat' id='test_mychat' onclick='chat_generate($chat_index)'><h2>$chat_title</h2></div>";

while($mychat_names_row = mysqli_fetch_assoc($sql_result_name)) {

        $chat_index = $mychat_names_row['chat'];

        $chat_query = "SELECT * FROM `chats` WHERE `index` = '$chat_index'";
        $chat_query_q = mysqli_query($conn,$chat_query);
        $chat_row = mysqli_fetch_assoc($chat_query_q);

        $chat_title = $chat_row['title'];
        $mychat = "<div class='mychat' id='test_mychat' onclick='chat_generate($chat_index)'><h2>$chat_title</h2></div>".$mychat;



}//end while

}//if at least 1 chat





 ?>
