<?php
include 'dbconnect.php';
session_start();

$username = $_SESSION['username'];
$chat_date = substr(date("l"), 0,3);
$chat_date .=", ".date("h:i");



if(isset($_POST['sendcom']) ? $_POST['sendcom'] : null){
$comment = $_POST['sendcom'];
$comment = mysqli_real_escape_string($conn, $comment);
$post_index = $_POST['post_index'];

$comupdate = "INSERT INTO  `pcomment` (
`id` ,
`post` ,
`commenter` ,
`msg`
)
VALUES (
NULL ,  '$post_index',  '$username',  '$comment'
)";

$cmupdateres = mysqli_query($conn, $comupdate);
if($cmupdateres){
echo "success";
}else{
echo "fail";
}
}


if(isset($_POST['sendmsg']) ? $_POST['sendmsg'] : null){
$chat_index = $_POST['chat_index'];
$comment = $_POST['sendmsg'];
$comment = mysqli_real_escape_string($conn, $comment);

$comupdate = "INSERT INTO  `messages` (
`chat` ,
`sender` ,
`msg` ,
`date`
)
VALUES (
'$chat_index' ,  '$username',  '$comment',  '$chat_date'
)";

$cmupdateres = mysqli_query($conn, $comupdate);
if($cmupdateres){
echo "success";
}else{
echo "fail";
}
}
//end
