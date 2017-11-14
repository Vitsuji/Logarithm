<?php
include 'dbconnect.php';
session_start();


$chat_index = $_GET['id'];
$username = $_SESSION['username'];

$sql = "SELECT * FROM `chats` WHERE `index` = '$chat_index'";
$query = mysqli_query($conn,$sql);

$json_array = mysqli_fetch_array($query);
$authr = $json_array[6];
$authr_sql = "SELECT * FROM `profiles` WHERE `name` = '$authr'";
$authr_query = mysqli_query($conn,$authr_sql);
$authr_info = mysqli_fetch_assoc($authr_query);
$authr_img = $authr_info['pimg'];




array_push($json_array,$authr_img);


$check_join = "SELECT * FROM `chat_relationship` WHERE `chat` = '$chat_index' AND `user` = '$username'";
$cj = mysqli_query($conn, $check_join);
$num_true = mysqli_num_rows($cj);
if($num_true < 1){
        $herro = "not joined";
        array_push($json_array,$herro);
}else {
        array_push($json_array, "joined");
}

$json = json_encode($json_array);

echo $json;

?>
