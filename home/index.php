<?php
date_default_timezone_set('UTC');
session_start();
include 'dbconnect.php';
if($_SESSION['username'] === Null || $_SESSION['email'] === Null ){
header('Location: http://beta002.site88.net/signin.php');
die();


}else{
$username = $_SESSION['username'];
$email = $_SESSION['email'];

$sql ="SELECT * FROM `id1251041_udata`.`profiles` WHERE `name` LIKE '$username' AND `email` LIKE '$email'";

$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if($row){
$pimg = $row['pimg'];
$pimg = "pimages/".$pimg;

}else{
echo "Failed"."</br>";
echo $username." "; 
echo $email;
}

if(isset($_POST['tidsubm']) ? $_POST['tidsubm'] : null){
$_SESSION['target'] = $_POST['target'];
header("location: target.php");
}

if(isset($_POST['logout']) ? $_POST['logout'] : null){
session_destroy();
header("location: http://beta002.site88.net");
}

$notesql = "SELECT * FROM `id1251041_udata`.`notification` WHERE `user` = '$username'";

$nnote = mysqli_query($conn,$notesql);
if($nnote){
$notesnum = mysqli_num_rows($nnote);
if($notesnum > 0){
$asdff = 1;
}else{
$asdff = 0;
}
}


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
$chat_img = "cimages".$file_name;
$sql_chat = "INSERT INTO  `id1251041_udata`.`chats` (
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

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Homepage - Logarithm</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="description" content="The developers' corner"/>
<meta name="author" content="Vitsuji Aura"/>
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
 <!--<link rel="stylesheet" href="/home/styles/jquery-ui.css">-->

<style>
body{margin:0;padding:0;font-family:'Raleway',sans-serif;}
body{font-family:'Raleway',sans-serif}





@media screen and (max-width:680px){
#dacform label{margin-top:5%;}
#dacform input[type=text]{width:70%;}
.btn-style{margin:0 auto;margin-top:15%;}
#dacform textarea{width:80%;}
.crechatform{top:0;width:100%;height:100%;overflow-y:auto;}
.iri{width:20%;}
.crechat2{width:100%;}
.crename{width:100%;}
.chatback{width:100%;height:200px;}
.chaty{width:100%;}
.chatb{width:94%;padding:3%;}
#snackbar{
margin-left:10%;
padding:32px;
}
#two{width:100%}
#two input[type=text]{height:20px;width:55%}
#two input[type=submit]{padding:3%;}
#two input[type=text]:focus{width:55%;}
#three{width:100%;margin-top:5%;padding-bottom:5%;}
#three input[type=text]{margin-left:15%;width:55%}
#three input[type=submit]{padding:3%;}
#three input[type=text]:focus{width:55%;}
.result{margin-left:10%;}
}

@media screen and (min-width:1023px){
@media screen and (max-width:1500px){
.crechatform{width:50%;}

}
}




@media screen and (min-width:680px){
#crepull{margin:1px;}
.btn-style{margin:0 auto;width:35%;margin-top:5%;}
#dacform input[type=text]{width:50%;}
#dacform textarea{width:70%;}
.iri{width:25%;}
.tcent{width:50%;}
.crechatform{top:3.5%;margin-left:30%;}
.crechat2:not(#jin){margin-left:60%;}
.crechat2{width:40%;}
.crename:not(#jin){margin-left:60%;}
.crename{width:40%;}
.chaty{width:31%;height:350px;}
.chatback{width:100%;height:60%;background:#fff;}
.chatcontainer{flex-direction:row;display:flex;flex-wrap:wrap;}
.chatb{width:8%;margin-left:90%;padding:1%;}
#snackbar{left:20%;padding: 16px;}
#two{width:50%}
#two input[type=submit]{width:15.2%;padding-top:1%;padding-bottom:1%;}
#two input[type=text]:focus{width:130px;}
#two input[type=text]{width: 130px;}

#three{width:50%;margin-left:25%;height:65px;}
#three input[type=submit]{width:15.2%;padding-top:1%;padding-bottom:1%;}
#three input[type=text]:focus{width:50%;}
#three input[type=text]{width: 50%;margin-left:25%;height:50%;}
.result{margin-left:2.5%;}
}



#snackbar {
    visibility: hidden;
    min-width:  60%;
    background-color: #333;
    color: #fff;
    text-align: center;
    position:fixed;
    border-radius: 2px;
    z-index: 1;
    bottom: 30px;
    font-size: 17px;
}

#snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;} 
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}
.side {
    width: 0;
    position: absolute;
    z-index: 1;
    border:1px solid #d7d7d7;
    background-color: #fff;
    overflow-x: hidden;
    transition: 0.5s;
 -webkit-transition: 0.5s;
    padding-top: 60px;
    font-family:'Josefin Slab',sans-serif;
    height:100%;
    
}
.mdiv{
width:100%;
margin-bottom:5%;
}
.middle{

margin:1%;
//background:#F26419;
background:#069E2D;
text-align:center;
color:#fff;
width:90%;
margin:0 auto;
}
.middle p{padding:5%;}
.middle p:nth-child(2){5%;}
.middle:hover{
cursor:pointer;
}
.side a {
    padding: 16px 16px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #d7d7d7;
    display: block;
    transition: 0.3s;

}
.side input{
border:none;
margin:0;
padding:0;
background:#fff;
text-decoration:none;
color:#d7d7d7;
display:block;
transition:0.3s;
text-align:left;
font-size:25px;
font-weight:100;
font-family:'Josefin Slab';
}
.side a#naive{    border:1px solid #d7d7d7;}
.side a:first-child{padding-bottom:0;}
.side a:nth-child(2){padding:0;margin:0;}
.side a:nth-child(2) p:not(.re){
margin:0;
paddding:0;
margin-bottom:5%;
width:60%;
margin-right:0;
display:inline-block;
margin-left:20%;

}


.side a:hover, .offcanvas a:focus{
    color:#069E2D;
}

.side .closebtn {
    position: absolute;
    top: 0;
    right: 0;
    font-size: 36px;
    margin-left: 50px;
}
.side img{width:50%;margin-left:25%;border-radius:50%;}

@media screen and (max-height: 450px) {
  .side {padding-top: 15px;}
  .side a {font-size: 18px;}
}

.side input:hover{
cursor:pointer;
color:green;
}

h1, h2, h3, h4{
font-weight:100;
}
p{text-align:center;}
.mnav{padding:0;margin:0;border:1px solid #d7d7d7;}
.mnav h1{display:inline-block;margin:0;padding:1.2%;color:#069E2D;font-family:'Josefin Slab',sans-serif;}
.mnav span{font-size:30px;cursor:pointer;padding:1.2%;float:right;}
input {
	outline: none;
}
input[type=text] {
	-webkit-appearance: textfield;
	-webkit-box-sizing: content-box;
	font-family: inherit;
	font-size: 20px;
}
input::-webkit-search-decoration,
input::-webkit-search-cancel-button {
	display: none; 
}

#two input[type=text] {
	background: #ededed url(http://static.tumblr.com/ftv85bp/MIXmud4tx/search-icon.png) no-repeat 9px center;
	border: solid 1px #ccc;
	padding: 9px 10px 9px 32px;

	
	-webkit-border-radius: 10em;
	-moz-border-radius: 10em;
	border-radius: 10em;
	
	-webkit-transition: all .5s;
	-moz-transition: all .5s;
	transition: all .5s;
}
#three input[type=text] {
	border: solid 1px #ccc;
	padding: 9px 10px 9px 32px;

	
	-webkit-border-radius: 10em;
	-moz-border-radius: 10em;
	border-radius: 10em;
	
	-webkit-transition: all .5s;
	-moz-transition: all .5s;
	transition: all .5s;
}
#two input[type=text]:focus {
	background-color: #fff;
	border-color: #66CC75;
	
	-webkit-box-shadow: 0 0 5px rgba(109,207,246,.5);
	-moz-box-shadow: 0 0 5px rgba(109,207,246,.5);
	box-shadow: 0 0 5px rgba(109,207,246,.5);
}

#three input[type=text]:focus {
//	background-color: #fff;
	border-color: #66CC75;
	
	-webkit-box-shadow: 0 0 5px rgba(109,207,246,.5);
	-moz-box-shadow: 0 0 5px rgba(109,207,246,.5);
	box-shadow: 0 0 5px rgba(109,207,246,.5);
}

input:-moz-placeholder {
	color: #999;
}
input::-webkit-input-placeholder {
	color: #999;
}
#two{display:inline-block;}
#three{display:inline-block;border-bottom:1px solid #d7d7d7;}
/*#two input[type=text] {
	width: 15px;
	padding-left: 10px;
	color: transparent;
	cursor: pointer;
}*/

#two input[type=text]:hover {
	background-color: #fff;
}
#two input[type=text]{
	padding-left: 32px;
	color: #000;
	background-color: #DFE0E2;
	cursor: auto;
        margin:3%;
        margin-bottom:0;
}
#three input[type=text]:hover {
	background-color: #fff;
}
#three input[type=text]{
	padding-left: 32px;
	color: #000;
	background-color: #fff;
	cursor: auto;
        margin-bottom:0;
}
#two input:-moz-placeholder {
	color: transparent;
}
#two input::-webkit-input-placeholder {
	color: transparent;
}

#thre input:-moz-placeholder {
	color: transparent;
}
#three input::-webkit-input-placeholder {
	color: transparent;
}
.result{
position:fixed;
width:150px;
background:#fff;
}
.result p:hover{cursor:pointer;background:#d3d3d3;}
.result p{border:1px solid #d7d7d7;padding:10%;margin:0;}

.container button {
    background-color: #4CAF50;
    color: white;
    padding: 2% 3.5%;
    margin: 8px 0;
    margin-left:25%;
    border: none;
    cursor: pointer;
    width: 50%;
}

.container textarea{
width:75%;
margin-left:12.5%;
height:200px;
resize:none;
font-size:20px;
}
.scontainer {
    text-align: center;
    margin:0;
    position: relative;
}

.container {
    padding: 16px;
}

.scontainer h1{
display:inline-block;
letter-spacing:10px;
}
.modal {
    display: none;
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4); 
    padding-top: 60px;
}


.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto;
    border: 1px solid #888;
    width: 75%; 
}

.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 45px;
    font-weight: bold;
    display:inline-block;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}


.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}

#two input[type=submit]{
-webkit-appearance: none;
  -webkit-border-radius: 0;
  border:1px solid green;
  background:#fff;
  transition:0.3s;
}
#three input[type=submit]{
-webkit-appearance: none;
  -webkit-border-radius: 0;
  border:1px solid green;
  background:#fff;
  transition:0.3s;
}

#two input[type=text]:focus +#two input[type=submit]{
background:green;
}
#three input[type=text]:focus +#two input[type=submit]{
background:green;
}
.notif{
width:10%;
height:25px;
border-radius:50%;
background:red;
color:#fff;
display:inline-block;
}

#lg{
-webkit-appearance:none;
-webkit-border-radius:6px;
}
.chatb{
background:#069E2D;
color:#fff;
right:0;
text-align:center;
}
.chatb  h3, h2{display:inline;}
.chatb:hover{cursor:pointer;}
.crechat{text-align:center;width:49%;display:inline-block;}
.crepost{width:49%; display:inline-block;}

.crechat2{
background:#069E2D;
color:#fff;
text-align:center;
}
.crechat2 i{padding:15%;font-size:64px;}
.chat{
overflow-x:auto;
width:100%;
height:100%;
background:#fff;
position:fixed;
top:0;
display:none;
}
.chathead{
color:green;
border:1px solid #d7d7d7;
text-align:center;
padding:1%;
}
.chathead h1{
margin:0;
}

.chatcontainer{
width:100%;
height:100%;
}
.chaty{


margin:1%;
border:1px solid #d7d7d7;
}
.chatname{
width:100%;
text-align:center;
}
.chatback{
background:rebeccapurple;

}
.underlie{

}
.create{
overflow-y:hidden;
display:none;
background:#fff;
position:fixed;
width:100%;
height:100%;
top:0;
}
.create:hover{cursor:pointer;}
.crename{

text-align:center;
}
.crename:hover{cursor:pointer;}
.crepost:hover{cursor:pointer;}
.crename h3{margin:0;font-size:25px;}
.creone{margin-left:60%;}
#crepull{margin-top:15%;}

.crechatform{
position:fixed;
background:#fff;
border:1px solid #d7d7d7;
display:none;
}
.crechatform:hover{cursor:pointer;box-shadow:0px 0px 25px #d7d7d7;}
.delc i{
font-size:34px;
padding:10%;
}
.delc h2{
color:#069E2D;
font-size:30px;
}
.opos{text-align:right;}
.delc i:hover{color:#d7d7d7;cursor:pointer;}
.tcent{text-align:center;margin-left:25%;display:inline-block;}
.iri{text-align:right;display:inline-block;}

#dacform label{display:block;padding:3%;}
#dacform input[type=text]{margin:3%;border:none;outline:none;border-bottom:1px solid #d7d7d7;transition:0.5s;-webkit-transition: 0.5s;}
#dacform textarea:focus{border:1px solid #069E2D;}
#dacform textarea{height:150px;border:1px solid #d7d7d7;margin:3%; outline: none;resize: none;padding:2%;padding-left:4%;padding-top:4%;transition:0.5s;webkit-transition: 0.5s;font-size:1.3em;}
#dacform input[type=text]:focus{border-bottom:1px solid #069E2D; }
.datpad{padding:5%;padding-top:0;}
.custom-file-input {
  color: #999;
  vertical-align: middle;
}
.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: 'Browse';
  color: #666;
  display: inline-block;
  background: #fff;
  border: 1px solid #999;
  border-radius: 3px;
  margin: -3px 0 -3px -3px;
  padding: 5px 20px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  text-align: center;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  font-size: 10pt;
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active {
  outline: 0;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}

.btn-style{
        border:none;
	font-size : 20px;
	padding : 10px 20px;
        background-color :#069E2D;
        color:white;
        transition: border 0.5s;
        outline:none;
        font-family:'Raleway', sans-serif;
display:block;
text-align:center;
-webkit-appearance:none;
	border-radius : 6px;
}
.btn-style:hover{
cursor:pointer;
}
#errortxt{
display:inline-block;
color:red;
width:50%;
text-align:left;
margib:0;
margin-left:5%;
}
</style>
</head>
<body>
<div id="Sidenav" class="side">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="http://beta002.site88.net/home/mypage.php"><img src="<?php echo $pimg; ?>" height="115px">
  <p><?php echo $username;  ?></p>
<?php 
if($asdff == 1){
echo "<div class='notif'></div>";
}
?>
</a>
  <div class="mdiv">
  <div class="middle" onclick="news()"><p>News</p></div>
  <div class="middle" id="cremcre" onclick="openNav();openCre();"><p>Create</p></div>
  <div class="middle"><p>Chats</p></div>
  </div>
  <a id="naive" href="#">Settings</a>

    <form method="post" action="mypage.php" style="padding:16px 16px 8px 32px;border:1px solid #d7d7d7;">
  <input id="lg" name="logout" type= "submit" value="Log Out">
</form>

</div>

<div class="mnav">
<span onclick="openNav()">&#9776;</span>
<h1>Logarithm</h1>
<form id="two" method="post" action="index.php">
	<input type="text" placeholder="Search" name="target" autocomplete="off" onfocus="greener()" onblur="blacker()">
        <input name="tidsubm" id="nau" value="Search" type="submit" />
        <div class="result"></div>
</form>
</div>



<div class="create" id="crecre">
<div class="crechat"  id="crepull"><div class="crename"> <h3> Public Chat</h3></div> <div class="crechat2" ><i class="material-icons">chat</i></div></div>

<div class="crepost"  id="crepull"><div class="crename" id="jin"> <h3> Post</h3></div> <div class="crechat2" id="jin"><i class="material-icons">view_quilt</i></div></div>
</div>

<div class="crechatform" id="chatcre">
<div class="delc"><div class="tcent"><h2>Create Chat</h2></div><div class="iri"><i class="material-icons">close</i></div></div>

<div class="inp">
<form id="dacform" name="chatf" method="post" enctype="multipart/form-data">
<div class="datpad">

<label id="txtcht"><h2>Title</h2></label>
<input onfocus="inputchf(this)" onblur="inputchb(this)" type="text" name="chat_title" />


<label><h2>Description </h2><p  style="display:inline-block;">(Max 140 characters)</p></label>
<!--<input onfocus="inputchf(this)" onblur="inputchb(this)" type="text" name="chat_title" />-->
<!--<input type="textarea" name="chat_desc"/>-->
<textarea name="chat_desc" onfocus="textfoc(this)" onblur="textblur(this)"></textarea>


<label><h2>Background Image</h2></label>
<input type="file" id="upload" class="custom-file-input" name="chat_back">

<!--<input type="submit" name="subm_chat" class="btn-style" value="Create Chat">-->
<div class="btn-style">Create Chat</div>
</form>
</div>
</div>
</div>


<div class="chatb"><h3>Chats</h3> <i class="material-icons">chat</i></div>
<div class="chat">
<div class="chathead"><h1>Public Chats</h1></div>
<div class="chatb"><h3>Posts</h3> <h2>></h2></div>
<form id="three" method="post" action="index.php">
<input type="text" name="target" autocomplete="off" onfocus="greener()" onblur="blacker()">

</form>

<div class="chatcontainer">

<div class="chaty">
<div class="chatname"><h3>Vitsuji Corps</h3></div>
<div class="chatback"></div>
<div class="underlie"><p>Users: 5</p><p> Created: 2017/6/20</p></div>
</div>


<div class="chaty">
<div class="chatname"><h3>Vitsuji Corps</h3></div>
<div class="chatback"></div>
<div class="underlie"><p>Users: 5</p><p> Created: 2017/6/20</p></div>
</div>

<div class="chaty">
<div class="chatname"><h3>Vitsuji Corps</h3></div>
<div class="chatback"></div>
<div class="underlie"><p>Users: 5</p><p> Created: 2017/6/20</p></div>
</div>

<div class="chaty">
<div class="chatname"><h3>Vitsuji Corps</h3></div>
<div class="chatback"></div>
<div class="underlie"><p>Users: 5</p><p> Created: 2017/6/20</p></div>
</div>

<div class="chaty">
<div class="chatname"><h3>Vitsuji Corps</h3></div>
<div class="chatback"></div>
<div class="underlie"><p>Users: 5</p><p> Created: 2017/6/20</p></div>
</div>

<div class="chaty">
<div class="chatname"><h3>Vitsuji Corps</h3></div>
<div class="chatback"></div>
<div class="underlie"><p>Users: 5</p><p> Created: 2017/6/20</p></div>
</div>

<div class="chaty">
<div class="chatname"><h3>Vitsuji Corps</h3></div>
<div class="chatback"></div>
<div class="underlie"><p>Users: 5</p><p> Created: 2017/6/20</p></div>
</div>

</div>
</div>

<div id="snackbar">Welcome <?php echo $username; ?></div>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
</script>
<script>

$jjo = "zero";
$jjj = "orez";


function openNav() {
    if($jjj == "acd"){
document.getElementById("Sidenav").style.width= "0";
$jjj = "orez";
}else{
    if ($(".chatname").css("color") == "#fff"){
       document.getElementById("Sidenav").style.width = "100%";
    
    }else{

 document.getElementById("Sidenav").style.width= "250px";
    }
    $jjj = "acd";
}
}



function closeNav() {
    document.getElementById("Sidenav").style.width = "0";
}
</script>


<script type="text/javascript">
$(document).ready(function(){
    $('#two input[type="text"]').on("keyup input", function(){
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
     $(".result").css("display","block");  
    });
    
    $(document).on("click", ".result p", function(){
        $(this).parents("#two").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
        
    });
});

</script>
<script>
 function news(){
  document.getElementById("Sidenav").style.width = "0px";
 }

</script>
<script>
$(document).ready(function() {
    $("body").on("click",function() {
        $(".result").css("display","none");
       
    });
var wed = 0;

 $(".chatb").click(function(){
if(wed == 0){
        $(".chat").fadeIn(400);
  $("body").css("overflow","hidden");

wed+=1;
}else{
        $(".chat").fadeOut(400);
  $("body").css("overflow","inherit");
wed-=1;
}
    });


});




</script>
<script>
var modal = document.getElementById('crecre');


window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }

}

function greener(){
$("#two input[type=submit]").css("background","#399E5A");
$("#two input[type=submit]").css("color","#fff");
}


function blacker(){
$("#two input[type=submit]").css("background","#fff");
$("#two input[type=submit]").css("color","black");
}

function openCre(){
$(".create").fadeIn(400);
}

    $(".crechat2").on("click",function() {
        $(".create").fadeOut();
$(".crechatform").fadeIn(500);
    });

   $(".delc i").on("click",function() {
$(".crechatform").fadeOut();
});

function inputchf(obj){
  $(obj).css("margin-top","0");
}
function inputchb(obj){
  $(obj).css("margin-top","3%");
}

function textfoc(obj){
$(obj).css("padding-right","0");
$(obj).css("padding-bottom","0");
}

function textblur(obj){
$(obj).css("padding-right","2%");
$(obj).css("padding-bottom","2%");
}

$(function() {
    $(".crechatform").draggable();
});



    $(".btn-style").on("click",function() {
    var x = document.forms["chatf"]["chat_title"].value;
    if (x == "") {
        $("#txtcht").append("<p id='errortxt'>*Must be filled in</p>");
        return false;
    }else{

$.ajax({
    url: 'chatcre.php',
    data: $('#dacform').serialize(),
    cache: false,
    contentType: 'multipart/form-data',
    processData: false,
    type: 'POST',
    success: function(data){
        alert("ji");
    }
});



//if($.post('chatcre.php', $('#dacform').serialize())){alert(";;");}
    
//$('#dacform').submit();

}
});
</script>
</body>
</html>