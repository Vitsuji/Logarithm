<?php
date_default_timezone_set('UTC');
session_start();
include 'backend/dbconnect.php';
include 'backend/chatscript.php';
include 'backend/loadmychat.php';
include 'backend/postcre.php';

if($_SESSION['username'] === Null || $_SESSION['email'] === Null ){
header('location: http://localhost/Logarithm/signin.php');
die();




}else{
$username = $_SESSION['username'];
$email = $_SESSION['email'];

$sql ="SELECT * FROM `profiles` WHERE `name` LIKE '$username' AND `email` LIKE '$email'";

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
header("location: http://localhost/Logarithm/ ");
}

$notesql = "SELECT * FROM `notification` WHERE `user` = '$username'";

$nnote = mysqli_query($conn,$notesql);
if($nnote){
$notesnum = mysqli_num_rows($nnote);
if($notesnum > 0){
$asdff = 1;
}else{
$asdff = 0;
}
}




//start echo chats
$comp = "SELECT * FROM `chats` WHERE `privated` = 'No'";
$compres = mysqli_query($conn,$comp);

$commentprint = "";
$commentnum = mysqli_num_rows($compres);
if($commentnum == 0){
$commentprint .= "<p id='nocoml'>No chats yet.</p>";
}else{
if($compres){
/*
$comrow = mysqli_fetch_array($compres);
$chat_title = $comrow['title'];
$chat_description = $comrow['description'];
$chat_img = $comrow['img'];
$chat_date = $comrow['date'];
$chat_authr = $comrow['authr'];
$chat_index = $comrow['index'];
$chat_rand = (rand(1,99999999));
$chat_rand = $chat_rand +(rand(1,878668)+rand(1,100))-rand(1,10);
$err = "SELECT * FROM `chat_relationship` WHERE `chat` = '$chat_index'";
$erre = mysqli_query($conn,$err);
$num_users = mysqli_num_rows($erre);

$commentprint .= "<div class='chaty' >
<form method='post' action='index.php' onclick='chat_generate($chat_index)' class='chat_loc'>
<input id='disspell' type='text' name = 'chat_locy' value='$chat_index'/>
</form>
  <div class='chatDesc' id='$chat_rand'>
<div class='tit'>Creator: </div>
  <div class='iriss'><i id='close_chatn' onclick='closeChat($chat_rand)' class='material-icons'>close</i></div>

  <form action='mypage.php' method='post'>


  <div class='authr_name'><button value='$chat_authr' name='userlink' class='subm_as_text'>$chat_authr</button></div>
</form>
<div class='titd'><h3>Description</h3></div>
<div class='description_chat'>$chat_description</div>
</div>


<span onclick='openChat($chat_rand)'>&#9776;</span>
<div class='chatname'><h3>$chat_title</h3></div>";
if($chat_img == "None"){
        $commentprint .= "<div class='chatback'style='background:#663399;background-size: cover;

          background-repeat: no-repeat;
          background-position: 50% 50%;'></div>";
}else{

$commentprint .= "<div class='chatback'style='background:url($chat_img); background-size: cover;

  background-repeat: no-repeat;
  background-position: 50% 50%;'></div>";
  }


$commentprint .= "<div class='underlie'><p>Users: $num_users</p><p> Created: $chat_date</p></div>

</div>";
*/

//comsres #1

while($comrow = mysqli_fetch_array($compres)) {
  $chat_title = $comrow['title'];
  $chat_description = $comrow['description'];
  $chat_img = $comrow['img'];
  $chat_date = $comrow['date'];
  $chat_authr = $comrow['authr'];
  $chat_index = $comrow['index'];
  $chat_rand = (rand(1,99999999));
  $chat_rand = $chat_rand +(rand(1,878668)+rand(1,100))-rand(1,10);
  $err = "SELECT * FROM `chat_relationship` WHERE `chat` = '$chat_index'";
  $erre = mysqli_query($conn,$err);
  $num_users = mysqli_num_rows($erre);

  $commentprint  .=  "<div class='chaty'>
  <form method='post' action='index.php' onclick='chat_generate($chat_index)' class='chat_loc'>
  <input id='disspell' type='text' name = 'chat_locy' value='$chat_index'/>
  </form>
    <div class='chatDesc' id='$chat_rand'>
  <div class='tit'>Creator: </div>
    <div class='iriss'><i id='close_chatn' onclick='closeChat($chat_rand)' class='material-icons'>close</i></div>

    <form action='mypage.php' method='post'>


    <div class='authr_name'><button value='John Brown' name='userlink' class='subm_as_text'>$chat_authr</button></div>
  </form>
  <div class='titd'><h3>Description</h3></div>
  <div class='description_chat'>$chat_description</div>
  </div>


  <span onclick='openChat($chat_rand)'>&#9776;</span>
  <div class='chatname'><h3>$chat_title</h3></div>";

  if($chat_img == "None"){
          $commentprint .= "<div class='chatback'style='background:#663399;background-size: cover;

            background-repeat: no-repeat;
            background-position: 50% 50%;'></div>";
  }else{

  $commentprint .= "<div class='chatback'style='background:url($chat_img); background-size: cover;

    background-repeat: no-repeat;
    background-position: 50% 50%;'></div>";
    }


 $commentprint .= "<div class='underlie'><p>Users: $num_users</p><p> Created: $chat_date</p></div>

  </div>";

}
//end while



//Add to commetn print
}else{
header("location:mypage.php");
}
}
//end echo chat

//start echo post
$sql_post = "SELECT * FROM `posts` WHERE 1";


//end echo post

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
<link rel="stylesheet" type="text/css" href="/Logarithm/home/styles/chat.css">
<link rel="stylesheet" type="text/css" href="/Logarithm/home/styles/nav.css">
<link rel="stylesheet" type="text/css" href="/Logarithm/home/styles/post.css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
 <!--<link rel="stylesheet" href="/home/styles/jquery-ui.css">-->

<style>
body{margin:0;padding:0;font-family:'Raleway',sans-serif;}
body{font-family:'Raleway',sans-serif;}





@media screen and (max-width:680px){

.chat_loc{width:100%;}
#dacform label{margin-top:5%;}
#dacform input[type=text]{width:70%;}
.btn-style{margin:0 auto;margin-top:15%;}
#dacform textarea{width:80%;}

.iri{width:20%;}
.crename{width:100%;}
.chatback{width:100%;height:200px;}
.chaty{width:100%;}
.chatb{width:94%;padding:3%;}
#snackbar{
margin-left:10%;
padding:32px;
}
#two input[type=text]{height:20px;width:55%}
#two input[type=submit]{padding:3%;}
#two input[type=text]:focus{width:55%;}
#three{width:100%;margin-top:5%;padding-bottom:5%;}
#three input[type=text]{margin-left:15%;width:55%}
#three input[type=submit]{padding:3%;}
#three input[type=text]:focus{width:55%;}
.result{margin-left:10%;}
}






@media screen and (min-width:681px){

.chat_loc{width:31%;}
#crepull{margin:1px;}
.btn-style{margin:0 auto;width:35%;margin-top:5%;}
#dacform input[type=text]{width:50%;}
#dacform textarea{width:70%;}
.iri:not(:nth-child(2)){width:25%;}
.iri{width:25%;}
.tcent{width:50%;}


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





/*#three input::-webkit-input-placeholder {
	color: transparent;
}*/

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

.chat{
overflow-x:auto;
width:100%;
height:100%;
background:#fff;
position:fixed;
top:0;
display:none;
z-index:2;
}
.chatb{
background:#069E2D;
color:#fff;
right:0;
text-align:center;
}
.chatb  h3, h2{display:inline;}
.chatb:hover{cursor:pointer;}

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
width:50%;
text-align:center;
margin:0 auto;
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
z-index:2;
}
.create:hover{cursor:pointer;}
.crename{

text-align:center;
}
.crename:hover{cursor:pointer;}
.crepost:hover{cursor:pointer;}
.crename h3{margin:0;font-size:25px;font-family: 'Josefin Slab',sans-serif;}
.creone{margin-left:60%;}
#crepull{margin-top:15%;}


.chatbool i{font-size:34px;padding:3%;}
.delc h2{
color:#069E2D;
font-size:30px;
font-family: 'Josefin Slab',sans-serif;
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
.chatbool{
position:fixed;
width:40%;
height:28%;
top:40%;
border:1px solid #d7d7d7;
background:#fff;
margin-left:30%;
text-align:center;
}
.iris{width:100%;text-align:right;}
.iris i:hover{color:#d7d7d7;cursor:pointer;}

#pstchcr{
width:20%;
display:inline-block;

}

#pstchcr button {
     background:none!important;
     color:inherit;
     border:none;
     padding:0!important;
     font: inherit;
     /*border is optional*/
     border-bottom:1px solid #444;
     cursor: pointer;
}
.chatDesc{width:0;height:350px;background:#fff;position:absolute;    transition: 0.5s;
 -webkit-transition: 0.5s;display: none;overflow-x:hidden;;overflow-y: auto;}

 .iriss{
width:10%;
text-align:right;
float:right;
padding:3%;


 }

 .iriss:hover{color:#d3d3d3;cursor:pointer;}
 /*.authr_img{

     width: 125px;
     height: 125px;
     background-image: url("pimages/avatar.png");
     background-size: cover;
     background-repeat: no-repeat;
     background-position: 50% 50%;
 border-radius:50%;
 margin:0 auto;
 border:1px solid #d7d7d7;
 margin-top:4%;
 }*/

 .authr_name {
 color:black;
 font-size:20px;
 text-align:center;
margin-top:0;

 }
 .subm_as_text:hover{cursor:pointer;border-bottom:2px solid black;}

 .subm_as_text{

        background:none!important;
        color:inherit;
        border:none;
        padding:0!important;
        font: inherit;
        /*border is optional*/

        cursor: pointer;


 }
 .tit{display: inline-block;text-align:right;width:52%;padding:4%;}
 .titd{width:100%;text-align:center;}
 .description_chat{text-align: center;width:68%;margin:0 auto;overflow-x: auto;font-size:18px;}
 .chat_loc{height:290px;position:absolute;margin-top:60px;}
 #news{text-decoration: none;}
 label{font-family:'Josefin Slab',sans-serif;}
 .chat_refresh{
display: inline-block;
//width:50px;
//height:50px;
border:1px solid #d7d7d7;
vertical-align: sub;
margin-left:15px;

}
 .chat_refresh i{
padding:13px;

 }
 .chat_refresh i:hover{cursor:pointer;background:#d7d7d7;}

/*  OPTIONA TAG */

.post_comments{display: none;background: #fff;}
.imperative_additions{
        width: 100%;
        position: absolute;
        bottom: 0;
}
/* OPTIOANL TAG END*/
</style>
</head>
<body>
<div id="Sidenav" class="side">
  <a href="javascript:void(0)" class="closebtn" onclick="openNav()">&times;</a>
  <a href="mypage.php"><img src="<?php echo $pimg; ?>" height="115px">
  <p><?php echo $username;  ?></p>
<?php
if($asdff == 1){
echo "<div class='notif'></div>";
}
?>
</a>
  <div class="mdiv">
  <a id="news" href="index.php"><div class="middle"><p>News</p></div></a>
  <div class="middle" id="cremcre" onclick="openNav();openCre();"><p>Create</p></div>
  <div class="middle" onclick="open_mychat()"><p>Chats</p></div>
  </div>
  <a id="naive" href="#">Settings</a>

    <form method="post" action="index.php" style="padding:16px 16px 8px 32px;border:1px solid #d7d7d7;">
  <input id="lg" name="logout" type= "submit" value="Log Out">
</form>




<div class="mychat_nav">
<?php
if(isset($mychat)){
echo $mychat;

}else{
echo "<p>No chats yet.</p>";

}


?>

</div>

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

<div class="crepost"  id="crepull"><div class="crename" id="jin"> <h3> Post</h3></div> <div class="crepost2" id="jin"><i class="material-icons">view_quilt</i></div></div>
</div>





<div class="crechatform" id="chatcre">
<div class="delc"><div class="tcent"><h2>Create Chat</h2></div><div class="iri"><i class="material-icons">close</i></div></div>

<div class="inp">
<form id="dacform" name="chatf" method="post" enctype="multipart/form-data">
<div class="datpad">

<label id="txtcht"><h2>Title</h2></label>
<input onfocus="inputchf(this)" onblur="inputchb(this)" type="text" name="chat_title" maxlength="50" />


<label><h2>Description </h2><p  style="display:inline-block;">(Max 140 characters)</p></label>
<!--<input onfocus="inputchf(this)" onblur="inputchb(this)" type="text" name="chat_title" />-->
<!--<input type="textarea" name="chat_desc"/>-->
<textarea name="chat_desc" onfocus="textfoc(this)" onblur="textblur(this)" maxlength="140"></textarea>


<label><h2>Background Image</h2></label>
<input type="file" id="upload" class="custom-file-input" name="chat_back">

<!--<input type="submit" name="subm_chat" class="btn-style" value="Create Chat">-->
<div class="btn-style" onclick="chat_create()">Create Chat</div>
</form>
</div>
</div>
</div>



<div class="crepostform" id="chatcre">
<div class="delc"><div class="tcent"><h2>Create Post</h2></div><div class="iri"><i class="material-icons">close</i></div></div>

<div class="inp">
<form id="dacform" name="chatf" method="post" enctype="multipart/form-data">
<div class="datpad">

<label id="txtpst"><h2>Title</h2></label>
<input onfocus="inputchf(this)" onblur="inputchb(this)" type="text" name="post_title" maxlength="50" />


<label><h2>Content </h2><p  style="display:inline-block;">(Max 240 characters)</p></label>
<!--<input onfocus="inputchf(this)" onblur="inputchb(this)" type="text" name="chat_title" />-->
<!--<input type="textarea" name="chat_desc"/>-->
<textarea class="post_cont" name="post_cont[]" onfocus="textfoc(this)" onblur="textblur(this)" maxlength="240"></textarea>

<!--<div class='craze'><input type='file' id='upload' class='custom-file-input' name='post_img[]'><i class='material-icons' onclick='delFile(this)'>&#xE872;</i></div>
<div class='craze'><input type='file' id='upload' class='custom-file-input' name='post_img[]'><i class='material-icons' onclick='delFile(this)'>&#xE872;</i></div>
<div class='craze'><input type='file' id='upload' class='custom-file-input' name='post_img[]'><i class='material-icons' onclick='delFile(this)'>&#xE872;</i></div>-->

<!--  <p><input class="post_file_add" type="button" value="Add File" onclick="addFile();" /></p>-->

<div class="post_file_add" onclick="addFile()"><i id='item1' class="material-icons">&#xE145;</i></div>
<div class="post_text_add" onclick="addText()"><i id='item1' class="material-icons">&#xE3BF;</i></div>

<input class="hidden_post_values" value="post_text_0" name="content_order"/>
<input class="hidden_post_values" value="0" name="file_number"/>
<input class="hidden_post_values" value="1" name="text_number"/>

<label><h2>Add tags</h2></label>
<div id="posttag_master_div">
 <div id="categories">
 </div>
 <div class="tag_input">
     <input type="text" name="post_tag" value="" />
 </div>
</div>

<label><h2>Cover Image</h2></label>
<input type="file" id="upload" class="custom-file-input" name="post_back">

<!--<input type="submit" name="subm_chat" class="btn-style" value="Create Chat">-->
<div class="btn-style" onclick="post_create()">Create Post</div>
</form>
</div>
</div>
</div>

<div class="chatb"><h3>Chats</h3> <i class="material-icons">chat</i></div>
<div class="chat">
<div class="chathead"><h1>Public Chats</h1></div>
<div class="chatb"><h3>Posts</h3> <h2>></h2></div>
<form id="three" method="post" action="index.php">
<input type="text" name="target" autocomplete="off" onfocus="greener()" onblur="blacker()" onkeyup="showHint(this.value)">
<div class="chat_refresh" onclick="showHints()">

<i class="material-icons">refresh</i>
</div>
</form>

<div class="chatcontainer" id="chatcon">

<?php
echo $commentprint;
 ?>
<!--the one-->





</div>
</div>



        <div id="post_res_tag"></div>


<div class="post_search"><span>>></span><input type="text" autocorrect="off" autocomplete="off"></div>


<div class="main_body">

<div class="loader"></div>
<!--<div class="post_body" id="3" onclick="post_active(3)">

        <div class="post_back"></div>
        <h3>Title</h3>
        <div class="post_halfcont">This is the greatest blog in the history of mankind</div>
        <div class="post_tabs">
                <div class="tab">tech</div>
                <div class="tab">life</div>
                <div class="tab">tech</div>
                <div class="tab">life</div>
                <div class="tab">life</div>
        </div>

        <div class="other_controller">

        <div class="post_other"><form action="mypage.php" method="post"><button value="Hitsuji" name="userlink" class="subm_as_text">Hitsuji</button></form></div>

        <div class="post_other"><h5>10/8/2017</h5></div>
        <div class="post_other"><div class="post_likes">12</div></div>
        </div>

</div>-->






</div>


<div class="override_post">







</div>
<?php

if(!isset($chat_bool)){

}elseif($chat_bool == "Something went wrong"){
echo "<div class='chatbool'>";
echo "<div class='iris'><i id='close_chatn' onclick='close_chatn()' class='material-icons'>close</i></div>";
echo "<p>$errors</p>";
echo "</div>";

}else{

echo "<div class='chatbool'>";
echo "<div class='iris'><i id='close_chatn' onclick='close_chatn()' class='material-icons'>close</i></div>";
echo "<p>Your chat has been created</p>";
echo "<p>To visit click </p>";
echo "
      <div class='chat_locb' onclick='chat_generate($chat_index)'>here</div>
  ";

echo "</div>";

}
?>

<div class='open_chat'></div>
<div class='open_chat'></div>
<div class='open_chat'></div>

<div id="snackbar">Welcome <?php echo $username; ?></div>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="scripts/chat.js"></script>
<script src="scripts/nav.js"></script>
<script src="scripts/post.js"></script>
<script src="scripts/general.js"></script>
<script>



$( document ).ready(function() {

post_load();

});



    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

    $(document).ready(function() {
        $("body").on("click",function() {
            $(".result").css("display","none");

        });
});
</script>
<script>



function openChat(onion) {
    //   document.getElementById(onion).style.width = "31%";
    var onion = "#"+onion;
    $(onion).css("display","block");
    setTimeout(function(){ $(onion).css("width","31%"); }, 100);


}
function closeChat(onion){
var onion = "#"+onion;
$(onion).css("width","0");

setTimeout(function(){$(onion).css("display","none");  }, 400);


}


function closeNav() {
    document.getElementById("Sidenav").style.width = "0";
}

 /* $(document).on("click",".chat_loc",function() {
    $(this).submit();
    alert("submitted");
  });
  $(".loc").on("click",function() {
    $(this).submit();
    alert("submitted");

  });*/


</script>


<script type="text/javascript">
$(document).ready(function(){
    $('#two input[type="text"]').on("keyup input", function(){
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend/backend-search.php", {term: inputVal}).done(function(data){
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




$("#close_chatn").on("click",function(){

$(".chatbool").fadeOut(500);

});


</script>

</body>
</html>
