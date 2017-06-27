<?php
include 'dbconnect.php';
session_start();
if($_SESSION['username'] === Null){
header("http://beta002.site88.net/signin.php");
die();
}else{
$username = $_SESSION['username'];
$sql="
SELECT * 
FROM  `id1251041_udata`.`profiles` WHERE `name` LIKE '$username' LIMIT 0 , 1";



$result = mysqli_query($conn,$sql);

if($result){
$row = mysqli_fetch_assoc($result);
if($row){
$date = $row['date'];
$description = $row['description'];
$pimg = $row['pimg'];
$pimg = "pimages/".$pimg;



}
}else{
echo "wrong".mysqli_error(mysqli_fetch_assoc($result));
}



?>