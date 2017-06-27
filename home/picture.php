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
        $sss = "SELECT * FROM `id1251041_udata`.`profiles` WHERE `name` = '$username'";
   $rs = mysqli_query($conn,$sss);
       $row = mysqli_fetch_assoc($rs);
if($row){
$filedest = $row['pimg'];
$filedest = "pimages/".$filedest;
if (!unlink($filedest)){header("location:beta002.site88.net");}else{
      move_uploaded_file($file_tmp,"pimages/".$file_name);
         $sql = "UPDATE  `id1251041_udata`.`profiles` SET  `pimg` =  '$file_name' WHERE  `profiles`.`name` = '$username'";
         $result = mysqli_query($conn,$sql);
         if($result){



header("location:mypage.php");}else{echo "Failed";}


}
}
         }else{
         print_r($errors);
      }
   }
?>