<?php 

include 'dbconnect.php';
session_start();

$username = $_SESSION['username'];
$target = $_SESSION['targetcom'];


if(isset($_POST['msg']) ? $_POST['msg'] : null && isset($_POST['targ']) ? $_POST['targ'] : null && isset($_POST['comdel']) ? $_POST['comdel'] : null){

$commenter = $_POST['comdel'];
$commenter = mysqli_real_escape_string($conn, $commenter);

$message = $_POST['msg'];
$message = mysqli_real_escape_string($conn, $message);

$target = $_POST['targ'];
$target = mysqli_real_escape_string($conn, $target);


$comupdate = "DELETE FROM `id1251041_udata`.`comments` WHERE `user` = '$target' AND `commenter` = '$commenter' AND `msg` = '$message'";

$results = mysqli_query($conn,$comupdate);

}
//end

?>