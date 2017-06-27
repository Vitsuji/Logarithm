<?php


session_start();
include 'dbconnect.php';

$username = $_SESSION['username'];

//if(isset($_POST['chat_title']) ? $_POST['chat_title'] : null){
$chat_title = $_POST['chat_title'];
$chat_desc = $_POST['chat_desc'];
$chat_date = date("Y/m/d h:i:sa");

$chat_index = $chat_title.$username.$chat_date;
$chat_index = md5($chat_index);
$chat_index = $chat_index.".html";

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = $chat_title." /";
fwrite($myfile, $txt);
$txt = $chat_desc." /";
fwrite($myfile, $txt);
$txt = $chat_index." /";
fwrite($myfile, $txt);


    

      $txt = "harm /";
fwrite($myfile, $txt);
fclose($myfile);

//}