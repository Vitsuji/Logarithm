<?php
include 'dbconnect.php';

$username = $_POST['username'];
$email = $_POST['email'];
$error_log = 0;

//check for user_check
$user_check = "SELECT * FROM `userd` WHERE `username` = '$username'";
$user_cq = mysqli_query($conn,$user_check);
$user_num = mysqli_num_rows($user_cq);
if($user_num > 0){
        $error_log +=1;
}

$user_check = "SELECT * FROM `userd` WHERE `email` = '$email'";
$user_cq = mysqli_query($conn,$user_check);
$user_num = mysqli_num_rows($user_cq);
if($user_num > 0){
        $error_log +=2;
}


echo $error_log;

 ?>
