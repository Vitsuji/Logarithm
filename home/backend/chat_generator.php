<?php
session_start();
include 'dbconnect.php';
$username = $_SESSION['username'];

$chat_index = $_GET['q'];



//Print my messages
$comp = "SELECT * FROM `chats` WHERE `index` = '$chat_index'";
$compres = mysqli_query($conn,$comp);

$chat = "";


if($compres){
$chat_rows = mysqli_fetch_array($compres);

$chat_title = $chat_rows['title'];
$chat_title = $chat_rows['title'];
$chat_description = $chat_rows['description'];
$chat_img = $chat_rows['img'];
$chat_wall = $chat_rows['wall'];
$chat_date = $chat_rows['date'];
$chat_authr = $chat_rows['authr'];
$chat_wall = "wimages/".$chat_rows['wall'];
$user_join_sql = "SELECT * FROM `chat_relationship` WHERE `chat` = '$chat_index' AND `user` = '$username'";
$join_check = mysqli_query($conn, $user_join_sql);
if($join_check){
$user_conceal = true;
}else{
$user_conceal = false;
$user_join = "<div class='user_join'>
<div class='user_join_img'><h3>$chat_title</h3></div>
<div class='user_join_desc'>$chat_description</div>
<form method='post' action='chat.php' id='daform'>
 <input id='fir_btn' type='submit' name='chat_ex' class='btn-style' value='Close'>
 </form>
 <form method='post' action='chat.php' id='daform'>
    <input id='late_btn' type='submit' name='chat_join' class='btn-style' value='Join'>
    </form>
</div>";

}

$nusers = "SELECT * FROM `chat_relationship` WHERE `chat` = '$chat_index'";
$nuserss = mysqli_query($conn,$nusers);
if($nuserss){
$num_users = mysqli_num_rows($nuserss);
}

$creator_info = "SELECT * FROM `profiles` WHERE `name` = '$chat_authr'";
$creator_query = mysqli_query($conn,$creator_info);
$creator_Thing = mysqli_fetch_assoc($creator_query);
$creator_img = $creator_Thing['pimg'];
$creator_img ="pimages/".$creator_img;

$chat .="<div class='full_wrap' id='chat_$chat_index'>
   <div class='force-overflow'></div>
<div id='nav_$chat_index' class='side'>

  <h2>Chat Settings & Info</h2>

    <a id='closebtn' href='javascript:void(0)'' class='closebtn' onclick='closeNav($chat_index)'>&times;</a>

	<div class='authr' style='background-image: url($chat_img);'>

	<a>
<div class='authr_img' style='background-image:url($creator_img);'></div>​
   </a>
<form action='mypage.php' method='post'>


<div class='authr_name'><button value=' $chat_authr' name='userlink' class='subm_as_text'> $chat_authr</button></div>
</form>

	</div>

<div class='chat_info'>

<div class='chat_descy'>

<h2>Chat Description</h2>
<div class='descc'>
<h3> $chat_description</h3>
</div>

</div>

<div class='chat_fol'><h2>Chat users:  $num_users</h2></div>

<div class='chat_back'>
<h2> Change Chat Wallpaper</h2>

<form method='post' action='picture.php' enctype='multipart/form-data'>
<input type='file' id='upload' class='custom-file-input' name='chat_wall'>
<input type='submit' class='chat_wall_subm' value='Change'/>
</form>

</div>

</div>

<form method='post' action='chat.php' >

<button class='chat_leave' name='chat_leave' value='$chat_index' >Leave Chat</button>
</form>
</div>


<div class='mnav'>
<span onclick='openNav($chat_index)'>&#9776;</span>
<i class='material-icons' id='chat_un_small' onclick='chat_un_small($chat_index)'>arrow_upward</i>
<h1>$chat_title</h1>
<div class='chat_close'><i class='material-icons'>&#xE5CD;</i></div>
</div>



<div class='conceal_wrapper'>
<div class='msgs' id='$chat_index'>


</div>";


if(!$user_conceal){

$chat .= "<form method='post' id='form_$chat_index' class='comform'>
<div class='wcom' >
<input maxlength='140' type = 'text' id='$chat_index'  class='comin' placeholder='My message...' name='sendmsg' autocapitalize='off' autocorrect='off'  readonly />
<input class='hidden_index' type='text' value='$chat_index' name='chat_index'/>
</div>
</form>
</div>

<div class='chat_enlarge'>
<div class='chat_enlarge_full' onmouseover='chat_action(this)'' onmouseout='chat_action_negative(this)'' onclick='chat_enlarge_full($chat_index)'></div>
<div class='chat_enlarge_standard'  onmouseover='chat_action(this)' onmouseout='chat_action_negative(this)' onclick='chat_enlarge_standard($chat_index)'></div>
<div class='chat_enlarge_small'  onmouseover='chat_action(this)' onmouseout='chat_action_negative(this)' onclick='chat_enlarge_small($chat_index)'></div>
</div>";


if($user_conceal){
$chat .= "</div>";

}else{

$chat .= $user_join."</div>";
}




}else{

  $chat .= "<form method='post' id='form_$chat_index' class='comform'>
  <div class='wcom' >
  <input maxlength='140' type = 'text' id='$chat_index'  class='comin' placeholder='My message...' name='sendmsg' autocapitalize='off' autocorrect='off' />
  <input class='hidden_index' type='text' value='$chat_index' name='chat_index'/>
  </div>
  </form>
  </div>

  <div class='chat_enlarge'>
  <div class='chat_enlarge_full' onmouseover='chat_action(this)'' onmouseout='chat_action_negative(this)'' onclick='chat_enlarge_full($chat_index)'></div>
  <div class='chat_enlarge_standard'  onmouseover='chat_action(this)' onmouseout='chat_action_negative(this)' onclick='chat_enlarge_standard($chat_index)'></div>
  <div class='chat_enlarge_small'  onmouseover='chat_action(this)' onmouseout='chat_action_negative(this)' onclick='chat_enlarge_small($chat_index)'></div>
  </div>";

if($user_conceal){
$chat .= "</div>";

}else{

$chat .= $user_join."</div>";
}
}


echo $chat;
}

?>
