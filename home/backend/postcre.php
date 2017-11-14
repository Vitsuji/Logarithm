<?php

function text_proceessor($text_num)
{

$start = 0;
$text_value = array();

while($text_num > $start){
       $current_text = $_POST['post_cont'][$start];
       $current_text = "<!--//-->".$current_text;
       array_push($text_value,$current_text);





        $start++;
}

$text_value = implode(" ",$text_value);
return $text_value;

}

function image_processor($image_name,$chat_title,$username,$chat_titleEnc,$additional_img_num)
{

        if($image_name == 'post_back'){

                if ($_FILES['post_back']['size'] == 0 && $_FILES['post_back']['error'] > 0)
                {

                 $names = "None";

                }else{


        # if image is cover
        $errors= array();
              $file_size = $_FILES[$image_name]['size'];


              $file_tmp = $_FILES[$image_name]['tmp_name'];
              $file_type = $_FILES[$image_name]['type'];
              $file_ext= explode('.',$_FILES[$image_name]['name']);
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

            if(move_uploaded_file($file_tmp,"postimg/cover/".$file_name)){
                     $names = "postimg/cover/".$file_name;

                    }//file upload yes
            }


}

}else{

                $names = array();

                //if image is content
                //$number_in = count($_FILES["post_img"]);

                        $op = 0;
if($additional_img_num == 0){
array_push($names,"None");
array_push($names,"None");
array_push($names,"None");



}else{
                while ($additional_img_num > $op ){





                        $errors= array();
                        $file_name = $_FILES[$image_name]['name'][$op];
                        $_FILES["post_img"]["name"][$op];


                        $file_size = $_FILES[$image_name]['size'][$op];



                              $file_tmp = $_FILES[$image_name]['tmp_name'][$op];
                              $file_type = $_FILES[$image_name]['type'][$op];
                              $file_ext= explode('.',$_FILES[$image_name]['name'][$op]);
                              $file_ext = end($file_ext);
                              $file_ext= strtolower($file_ext);
                              $expensions= array("jpeg","jpg","png");

                              if(in_array($file_ext,$expensions)=== false){
                                 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                              }
                              if(in_array($file_ext,$expensions) == ".jpg"){
                              $file_name = $op;
                              $file_name .=$username;
                              $file_name .= $chat_titleEnc;
                              $file_name=$file_name.time().".jpg";
                              $file_name = slugify($file_name);
                        }else if(in_array($file_ext,$expensions) == "jpeg"){
                              $file_name = $op;
                              $file_name .=$username;
                         $file_name .= $chat_titleEnc;
                              $file_name=$file_name.time().".jpeg";
                              $file_name = slugify($file_name);
                        }else{
                               $file_name = $op;
                              $file_name .=$username;
                         $file_name .= $chat_titleEnc;
                              $file_name=$file_name.time().".png";
                              $file_name = slugify($file_name);
                         }
                              if($file_size > 2097152) {
                                 $errors[]='File size must be less than 2 MB';
                              }


                             if(empty($errors)==true) {

                            if(move_uploaded_file($file_tmp,"postimg/content/".$file_name)){
                                     $name = "postimg/content/".$file_name;

                                     array_push($names,$name);

                                    }//file upload yes
                            }








                $op++;
                }//end loop



}





}  //end img

return $names;
}//end image_processor






//start chat

if(isset($_POST['post_title']) ? $_POST['post_title'] : null){

        //$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");



$username = $_SESSION['username'];

$post_title = $_POST['post_title'];
$chat_titleEnc = md5($chat_title);
$post_date = date("Y/m/d h:i:sa");
$tags = $_POST['post_tag'];
$index = trim("1".$post_title.$post_date.$username);
$chat_index = base_convert($index, 26, 10);
$chat_index = substr($chat_index, 0, 10);
//$chat_index = rand(1,100);


$post_order = $_POST['content_order'];


$file_name = $_FILES['post_back']['name'];
$back_name = image_processor('post_back',$post_title,$username,$chat_titleEnc,0);
$img_name = image_processor('post_img',$post_title,$username,$chat_titleEnc,$_POST['file_number']);

$text_value = text_proceessor($_POST['text_number']);

$img_names = implode(",",$img_name);

$sql_chat = "INSERT INTO  `posts` (
`id` ,
`post_title` ,
`post_content` ,
`post_cover` ,
`img_names`,
`tags`,
`post_order`,
`post_date` ,
`post_authr`,
`post_index`
)
VALUES (
NULL ,  '$post_title',  '$text_value',  '$back_name',  '$img_names','$tags','$post_order','$post_date','$username','$chat_index'
)";

$chat_create = mysqli_query($conn,$sql_chat);

if($chat_create){
        $sql_rel = "INSERT INTO `post_relationship`(`post`,`user`) VALUES ('$chat_index','$username')";
        $rel = mysqli_query($conn,$sql_rel);

}








}
//end ifset chat
