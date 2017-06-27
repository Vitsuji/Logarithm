<?php
include 'dbconnect.php';
session_start();

$username = $_SESSION['username'];
$target = $_SESSION['targetcom'];
if(isset($_POST['sendcom']) ? $_POST['sendcom'] : null){
$comment = $_POST['sendcom'];
$comment = mysqli_real_escape_string($conn, $comment);

$comupdate = "INSERT INTO  `id1251041_udata`.`comments` (
`id` ,
`user` ,
`commenter` ,
`msg` 
)
VALUES (
NULL ,  '$target',  '$username',  '$comment'
)";

$cmupdateres = mysqli_query($conn, $comupdate);
if($cmupdateres){
echo "success";
}else{
echo "fail";
}
}
//end