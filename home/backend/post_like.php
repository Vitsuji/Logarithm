<?php

session_start();
include 'dbconnect.php';

$username = $_SESSION['username'];
$post_index = $_POST['id'];
$check = "SELECT * FROM `post_relationship` WHERE `post` = '$post_index' AND `user` = '$username'";
$checkq = mysqli_query($conn,$check);
$num = mysqli_num_rows($checkq);

if($num == 0){
$sql_q = "INSERT INTO `post_relationship` (`post`,`user`) VALUES ('$post_index','$username')";

$qs = mysqli_query($conn,$sql_q);

}else{
        $sql_q = "DELETE FROM `post_relationship` WHERE `post` = '$post_index' AND `user` = '$username'";

        $qs = mysqli_query($conn,$sql_q);

}

$count = "SELECT * FROM `post_relationship` WHERE `post` = '$post_index'";
$count_q = mysqli_query($conn,$count);
$count_num = mysqli_num_rows($count_q);

echo $count_num;  
 ?>
