<?php
   include 'dbconnect.php';
   session_start();
   if($_SESSION['username'] === Null || $_SESSION['email'] === Null){
echo "no session";
die();
}else{
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$sss = "SELECT * FROM `id1251041_udata`.`userd` WHERE `username` LIKE '$username' AND `email` LIKE '$email'";
$res = mysqli_query($conn,$sss);
if($res){
$resu = mysqli_fetch_assoc($res);
if($resu['name'] === Null){


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
$sql = "INSERT INTO  `id1251041_udata`.`profiles` (
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
header("location:http://beta002.site88.net");
die();
}

}else{header("location:http://beta002.site88.net/signin.php");}


}
}