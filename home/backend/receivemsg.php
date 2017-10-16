<?php
session_start();
include 'dbconnect.php';
$username = $_SESSION['username'];

$chat_index = $_GET['q'];



//Print my messages
$comp = "SELECT * FROM `messages` WHERE `chat` = '$chat_index'";
$compres = mysqli_query($conn,$comp);

$commentprint = "";
$commentnum = mysqli_num_rows($compres);

if($commentnum == 0){
$commentprint .= "<p id='nocoml'>Be the first to message</p>";
}else{
if($compres){
$comrow = mysqli_fetch_array($compres);


$chat_date = $comrow['date'];
$sender = $comrow['sender'];
$coms = "SELECT * FROM `profiles` WHERE `name` = '$sender'";
$comsres = mysqli_query($conn,$coms);
if($comsres){
$prof = mysqli_fetch_assoc($comsres);
$profpic = "pimages/";
$profpic .= $prof['pimg'];
}
$msg = $comrow['msg'];



if($sender == $username){
  $commentprint .="<div class='chat_comstandin' id='comstandin_p'>
  <div class='com_p'>
  <img src='$profpic'/>
  <div class='contcomv'>
  <form method ='post' action='mypage.php' id='getcom'>
  <input class='comname' id='underline' type='submit' name='userlink' value='$sender' />
  </form>




  <div class='comcon_p'><p>$msg</p></div>

  </div>
  <div class='chat_date'>$chat_date</div>
  </div>
  </div>";


}else{
$commentprint .= "<div class='chat_comstandin'>
<div class='com'>
<img src='$profpic'/>
<div class='contcomv'>
<form method ='post' action='mypage.php' id='getcom'>
<input class='comname' id='underline' type='submit' name='userlink' value='$sender' />
</form>



<div class='comcon'><p>$msg</p></div>

</div><div class='chat_date'>$chat_date</div></div>
</div>";

}//if sender is username
//comsres #1

while($comrow = mysqli_fetch_array($compres)) {

  $chat_date = $comrow['date'];
  $sender = $comrow['sender'];
  $coms = "SELECT * FROM `profiles` WHERE `name` = '$sender'";
  $comsres = mysqli_query($conn,$coms);
  if($comsres){
  $prof = mysqli_fetch_assoc($comsres);
  $profpic = "pimages/";
  $profpic .= $prof['pimg'];
  }
  $msg = $comrow['msg'];

  if($sender == $username){
    $commentprint .="<div class='chat_comstandin' id='comstandin_p'>
    <div class='com_p'>
    <img src='$profpic'/>
    <div class='contcomv'>
    <form method ='post' action='mypage.php' id='getcom'>
    <input class='comname' id='underline' type='submit' name='userlink' value='$sender' />
    </form>




    <div class='comcon_p'><p>$msg</p></div>

    </div>
    <div class='chat_date'>$chat_date</div>
    </div>
    </div>";


  }else{
  $commentprint .= "<div class='chat_comstandin'>
  <div class='com'>
  <img src='$profpic'/>
  <div class='contcomv'>
  <form method ='post' action='mypage.php' id='getcom'>
  <input class='comname' id='underline' type='submit' name='userlink' value='$sender' />
  </form>



  <div class='comcon'><p>$msg</p></div>

  </div><div class='chat_date'>$chat_date</div></div>
  </div>";

  }

}
//end while



//Add to commetn print
}else{
header("location:mypage.php");
}
}
//end comment and if none results

echo $commentprint;

?>
