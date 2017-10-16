<?php
include 'dbconnect.php';
$chat_index = $_GET['id'];


$sql = "SELECT * FROM `chats` WHERE `index` = '$chat_index'";
$query = mysqli_query($conn,$sql);

$json_array = mysqli_fetch_array($query);
$authr = $json_array[6];
$authr_sql = "SELECT * FROM `profiles` WHERE `name` = '$authr'";
$authr_query = mysqli_query($conn,$authr_sql);
$authr_info = mysqli_fetch_assoc($authr_query);
$authr_img = $authr_info['pimg'];



array_push($json_array,$authr_img);
//$myArr = array("John", "Mary", $chat_index, "Sally");

$json = json_encode($json_array);



?>
