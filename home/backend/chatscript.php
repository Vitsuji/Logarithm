<?php
include 'dbconnect.php';
include 'general.php';

function slugify_native($text)
{
$text = str_replace(' ', '_', $text);
$text = trim($text, '_');



  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

if(isset($_POST['chat_title']) ? $_POST['chat_title'] : null){
$username = $_SESSION['username'];
$chat_title = $_POST['chat_title'];
$chat_titleEnc = md5($chat_title);
$chat_desc = $_POST['chat_desc'];
$chat_date = date("Y/m/d h:i:sa");

$chat_index = $username.$chat_date;
$chat_index = md5($chat_index);


$errors= array();
      $file_name = $_FILES['chat_back']['name'];
      $file_size = $_FILES['chat_back']['size'];
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
      $file_name = slugify_native($file_name);
}else if(in_array($file_ext,$expensions) == "jpeg"){
      $file_name = "1";
      $file_name .=$username;
 $file_name .= $chat_titleEnc;
      $file_name=$file_name.time().".jpeg";
      $file_name = slugify_native($file_name);
}else{
       $file_name = "1";
      $file_name .=$username;
 $file_name .= $chat_titleEnc;
      $file_name=$file_name.time().".png";
      $file_name = slugify_native($file_name);
 }
      if($file_size > 2097152) {
         $errors[]='File size must be less than 2 MB';
      }

      if(empty($errors)==true) {

    if(move_uploaded_file($file_tmp,"cimages/".$file_name)){
$chat_img = "cimages/".$file_name;
$sql_chat = "INSERT INTO  `chats` (
`id` ,
`title` ,
`description` ,
`img` ,
`wall`,
`date` ,
`authr`,
`index`,
`privated`
)
VALUES (
NULL ,  '$chat_title',  '$chat_desc',  '$chat_img',  'None' , '$chat_date','$username','$chat_index','No'
)";

$chat_create = mysqli_query($conn,$sql_chat);
if($chat_create){
$chat_bool = $chat_index;


$joincq = "INSERT INTO  `chat_relationship` (
`chat` ,
`user`

)
VALUES (
'$chat_index' ,  '$username'
)";

$joinqs = mysqli_query($conn,$joincq);
if($joinqs){
$_SESSION['chat_index'] = $chat_index;


}


}

}//file upload yes

}else{
$chat_bool =  "Something went wrong ";
}
//end img


}
//end ifset chat
