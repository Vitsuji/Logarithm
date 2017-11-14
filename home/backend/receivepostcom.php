<?php
session_start();
include 'dbconnect.php';
$username = $_SESSION['username'];

$post_index = $_GET['id'];

//Print my comments
$comp = "SELECT * FROM `pcomment` WHERE `post` = '$post_index'";
$compres = mysqli_query($conn,$comp);

$commentprint = "";
$commentnum = mysqli_num_rows($compres);
if($commentnum == 0){
$commentprint .= "<p id='nocoml'>No comments yet.</p>";
}else{
if($compres){
$comrow = mysqli_fetch_array($compres);



$commenter = $comrow['commenter'];
$coms = "SELECT * FROM `profiles` WHERE `name` = '$commenter'";
$comsres = mysqli_query($conn,$coms);
if($comsres){
$prof = mysqli_fetch_assoc($comsres);
$profpic = "pimages/";
$profpic .= $prof['pimg'];
}
$msg = $comrow['msg'];
$rand = $commenter.$msg.rand(1,1000000);
$rand = preg_replace('/\s+/', '', $rand);

$commentprint .= "<div class='comstandin'>
<div class='com'>
<img src='$profpic'/>
<div class='contcomv'>
<form method ='post' action='mypage.php' id='getcom'>
<input class='comname' type='submit' name='userlink' value='$commenter' />
</form>

<form method='post' id='melcom' class='$rand'>
<input type='text' name='msg' value='$msg' />
<input type='text' name='targ' value='$post_index' />
<input type='text' name='comdel' value='$commenter' />

</form>

  <button class='comdel'type='submit' value='$commenter' id='$rand' onclick='deletecom(this)' name='$commenter'>
    <i id='delcom' class='material-icons'>delete</i>
  </button>


<div class='comcon'>$msg</div>
</div></div>
</div>";
//comsres #1

while($comrow = mysqli_fetch_array($compres)) {
$commenter = $comrow['commenter'];
$coms = "SELECT * FROM `profiles` WHERE `name` = '$commenter'";
$comsres = mysqli_query($conn,$coms);
if($comsres){
$prof = mysqli_fetch_assoc($comsres);
$profpic = "pimages/";
$profpic .= $prof['pimg'];
}
$msg = $comrow['msg'];
$rand = $commenter.$msg.rand(1,1000000);
$rand = preg_replace('/\s+/', '', $rand);

$commentprint = "<div class='comstandin'>
<div class='com'>
<img src='$profpic'/>
<div class='contcomv'>
<form method ='post' action='mypage.php' id='getcom'>
<input class='comname' type='submit' name='userlink' value='$commenter' />
</form>

<form method='post' id='melcom' class='$rand'>
<input type='text' name='msg' value='$msg' />
<input type='text' name='targ' value='$post_index' />
<input type='text' name='comdel' value='$commenter' />

</form>

 <button class='comdel' type='submit'id='$rand' onclick='deletecom(this)' name='$commenter' >
    <i id='delcom' class='material-icons'>delete</i>
  </button>


<div class='comcon'>$msg</div>
</div></div>
</div>".$commentprint;
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
