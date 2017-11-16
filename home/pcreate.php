<?php


   include 'backend/dbconnect.php';
   session_start();
   if($_SESSION['username'] === Null || $_SESSION['email'] === Null){
echo "no session";
die();
}else{
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$sss = "SELECT * FROM `userd` WHERE `username` = '$username' AND `email` = '$email'";
$res = mysqli_query($conn,$sss);
if($res){
$resu = mysqli_fetch_assoc($res);


   function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');



  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$usernameslug = slugify($username);
$date = date("Y/m/d");
$sql = "INSERT INTO  `profiles` (
`id` ,
`name` ,
`email`,
`pimg`,
`description`,
`date`

)
VALUES (
NULL ,  '$username',  '$email','avatar.png','No description yet.','$date'
)";

$result = mysqli_query($conn,$sql);
if($result){
header("location:index.php");
}else{
session_destroy();
header("location:");
die();
}




}
}else{
        header("location: localhost/Logarithm/signin.php");
}
