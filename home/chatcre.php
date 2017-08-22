<?php


session_start();
include 'dbconnect.php';

$username = $_SESSION['username'];

//start chat
function slugify($text)
{
$text = str_replace(' ', '_', $text);
$text = trim($text, '_');



  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

if(isset($_POST['chat_title']) ? $_POST['chat_title'] : null){
$chat_title = $_POST['chat_title'];
$chat_titleEnc = md5($chat_title);
$chat_desc = $_POST['chat_desc'];
$chat_date = date("Y/m/d h:i:sa");

$chat_index = $chat_title.$username.$chat_date;
$chat_index = md5($chat_index);
$chat_index = $chat_index.".html";



$errors= array();
      $file_name = $_FILES['chat_back']['name'];
      $file_size = $_FILES['chat_back']['size'];


     $myfile = fopen("newfiles.txt", "w") or die("Unable to open file!");
 $txt = $file_name."/ ".$file_size."/ ".$chat_title;
fwrite($myfile, $txt);

      $file_tmp = $_FILES['chat_back']['tmp_name'];
      $file_type = $_FILES['chat_back']['type'];
      $file_ext= explode('.',$_FILES['chat_back']['name']);
      $file_ext = end($file_ext);
      $file_ext= strtolower($file_ext);
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      if(in_array($file_ext,$expensions) == ".jpg"){
      $file_name = "1";
      $file_name .=$username;
      $file_name .= $chat_titleEnc;
      $file_name=$file_name.time().".jpg";
      $file_name = slugify($file_name);
}else if(in_array($file_ext,$expensions) == "jpeg"){
      $file_name = "1";
      $file_name .=$username;
 $file_name .= $chat_titleEnc;
      $file_name=$file_name.time().".jpeg";
      $file_name = slugify($file_name);
}else{
       $file_name = "1";
      $file_name .=$username;
 $file_name .= $chat_titleEnc;
      $file_name=$file_name.time().".png";
      $file_name = slugify($file_name);
 }
      if($file_size > 2097152) {
         $errors[]='File size must be less than 2 MB';
      }


      if(empty($errors)==true) {

    if(move_uploaded_file($file_tmp,"cimages/".$file_name)){
$chat_img = "cimages/".$file_name;
$sql_chat = "INSERT INTO  `chats` (
`id` ,
`chat_title` ,
`chat_desc` ,
`chat_img` ,
`chat_wall`,
`chat_date` ,
`chat_authr`,
`chat_index`
)
VALUES (
NULL ,  '$chat_title',  '$chat_desc',  '$chat_img',  'None' , '$chat_date','$username','$chat_index'
)";

$chat_create = mysqli_query($conn,$sql_chat);
if($chat_create){echo "si"." ".$chat_date;}else{echo "nien".mysqli_error($chat_create);}

}//file upload yes

}
//end img


}
//end ifset chat