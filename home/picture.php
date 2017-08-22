<?php
   session_start();
   include 'dbconnect.php';

function slugify($text)
{
$text = str_replace(' ', '_', $text);
$text = trim($text, '_');



  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

   $username = $_SESSION['username'];
   if(isset($_FILES['img'])){
      $errors= array();
      $file_name = $_FILES['img']['name'];
      $file_size = $_FILES['img']['size'];
      $file_tmp = $_FILES['img']['tmp_name'];
      $file_type = $_FILES['img']['type'];
      $file_ext= explode('.',$_FILES['img']['name']);
      $file_ext = end($file_ext);
      $file_ext= strtolower($file_ext);
      $expensions= array("jpeg","jpg","png");

      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      if(in_array($file_ext,$expensions) == ".jpg"){
      $file_name = "1";
      $file_name .=$username;
      $file_name=$file_name.time().".jpg";
      $file_name = slugify($file_name);
}else if(in_array($file_ext,$expensions) == "jpeg"){
      $file_name = "1";
      $file_name .=$username;
      $file_name=$file_name.time().".jpeg";
      $file_name = slugify($file_name);
}else{
       $file_name = "1";
      $file_name .=$username;
      $file_name=$file_name.time().".png";
      $file_name = slugify($file_name);
 }
      if($file_size > 2097152) {
         $errors[]='File size must be less than 2 MB';
      }

      if(empty($errors)==true) {
        $sss = "SELECT * FROM `profiles` WHERE `name` = '$username'";
   $rs = mysqli_query($conn,$sss);
       $row = mysqli_fetch_assoc($rs);
if($row){

$filedest = $row['pimg'];
$filedest = "pimages/".$filedest;

if($filedeltest == "avatar.png"){

  move_uploaded_file($file_tmp,"pimages/".$file_name);
     $sql = "UPDATE  `profiles` SET  `pimg` =  '$file_name' WHERE  `profiles`.`name` = '$username'";
     $result = mysqli_query($conn,$sql);
     if($result){



header("location:mypage.php");}else{echo "Failed";}


}else{


if (!unlink($filedest)){header("location:logarithm");}else{
      move_uploaded_file($file_tmp,"pimages/".$file_name);
         $sql = "UPDATE  `profiles` SET  `pimg` =  '$file_name' WHERE  `profiles`.`name` = '$username'";
         $result = mysqli_query($conn,$sql);
         if($result){



header("location:mypage.php");}else{echo "Failed";}

}
}
}
         }else{
         print_r($errors);
      }
   }


$chat_index = $_SESSION['chat_index'];

   if(isset($_FILES['chat_wall'])){
      $errors= array();
      $file_name = $_FILES['chat_wall']['name'];
      $file_size = $_FILES['chat_wall']['size'];
      $file_tmp = $_FILES['chat_wall']['tmp_name'];
      $file_type = $_FILES['chat_wall']['type'];
      $file_ext= explode('.',$_FILES['chat_wall']['name']);
      $file_ext = end($file_ext);
      $file_ext= strtolower($file_ext);
      $expensions= array("jpeg","jpg","png");

      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      if(in_array($file_ext,$expensions) == ".jpg"){

      $file_name=$chat_index.".jpg";
      $file_name = slugify($file_name);
}else if(in_array($file_ext,$expensions) == "jpeg"){

      $file_name=$chat_index.".jpeg";
      $file_name = slugify($file_name);
}else{

      $file_name=$chat_index.".png";
      $file_name = slugify($file_name);
 }
      if($file_size > 2097152) {
         $errors[]='File size must be less than 2 MB';
      }

      if(empty($errors)==true) {
        $sss = "SELECT * FROM `chats` WHERE `index` = '$chat_index'";
   $rs = mysqli_query($conn,$sss);
       $row = mysqli_fetch_assoc($rs);
if($row){

$filedest = $row['wall'];

if($filedest == "None"){

  move_uploaded_file($file_tmp,"wimages/".$file_name);
     $sql = "UPDATE  `chats` SET  `wall` =  '$file_name' WHERE  `chats`.`index` = '$chat_index'";
     $result = mysqli_query($conn,$sql);
     if($result){



header("location:chat.php");

}else{echo "Failed";}

}else{
$filedest = "wimages/".$filedest;


if (!unlink($filedest)){header("location:http://localhost/Logarithm/home");}else{
      move_uploaded_file($file_tmp,"wimages/".$file_name);
         $sql = "UPDATE  `chats` SET  `wall` =  '$file_name' WHERE  `chats`.`index` = '$chat_index'";
         $result = mysqli_query($conn,$sql);
         if($result){



header("location:chat.php");}else{echo "Failed";}

}

}
}
         }else{
         print_r($errors);
      }
   }
?>
