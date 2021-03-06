<?php
session_start();
include 'backend/dbconnect.php';
include 'backend/chatscript.php';
include 'backend/loadmychat.php';
include 'backend/postcre.php';

$target = $_SESSION['target'];
$requester = $_SESSION['username'];
if($target === null){
header("location:mypage.php");
}else{
$email = $_SESSION['email'];
$sql ="SELECT *
FROM  `profiles`
WHERE  `name` LIKE '$requester'
AND  `email` LIKE  '$email'";

$result = mysqli_query($conn,$sql);
if($result){
$row = mysqli_fetch_assoc($result);

if($row){
$username = $row['name'];
$date = $row['date'];
$pimg = $row['pimg'];
$pimg = "pimages/".$pimg;
$description = $row['description'];

}else{
echo "wrong row";
}
}
if(isset($_POST['tidsubm']) ? $_POST['tidsubm'] : null){
$_SESSION['target'] = $_POST['target'];
header("location: target.php");
}
if(isset($_POST['logout']) ? $_POST['logout'] : null){
session_destroy();
header("location: http://localhost/Logarithm/");
}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" type="text/css" href="/Logarithm/home/styles/chat.css">
<link rel="stylesheet" type="text/css" href="/Logarithm/home/styles/nav.css">
<link rel="stylesheet" type="text/css" href="/Logarithm/home/styles/post.css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<title>Not Found - Logarithm</title>
<style>
body{margin:0;padding:0;font-family:'Raleway',sans-serif;border:1px solid #d7d7d7;outline:none;overflow-x:hidden;}
h1,h2,h3,h4{
font-weight:100;
font-family:'Josefin Slab',sans-serif;
}
/*@media screen and (max-width:680px){
#snackbar{
margin-left:10%;
padding:32px;
}
.comments{width:80%;padding:3%;margin:0 auto;padding-left:0;padding-right:0;display:block;}
}*/

@media screen and (min-width:680px){
  #crepull{margin:1px;}
  .btn-style{margin:0 auto;width:35%;margin-top:5%;}
  #dacform input[type=text]{width:50%;}
  #dacform textarea{width:70%;}
  .iri{width:25%;}
  .tcent{width:50%;}
  .crechatform{top:3.5%;margin-left:30%;}
  .crename:not(#jin){margin-left:60%;}
  .crename{width:40%;}
  .chaty{width:31%;height:350px;}
  .chatback{width:100%;height:60%;background:#fff;}
  .chatcontainer{flex-direction:row;display:flex;flex-wrap:wrap;}
  .chatb{width:8%;margin-left:90%;padding:1%;}


#snackbar{left:20%;padding: 16px;}
.mainp input:not(.updesc){width:15%;padding:1%;}
#secin{margin-left:16px;}
.dsxc{width:40%;}
.mains img{height:170px;}
.mains h2, h3{padding:2%;}
.mnav span{padding:1.2%;}
#two input[type=text]{width: 130px;}
#pad5{padding:1%;}
#two{width:50%;}
#two input[type=submit]{width:12.5%;padding-top:1%;padding-bottom:1%;}
#two input[type=text]{width:130px;}
}
@media screen and (max-width: 680px){
  .crechatform{top:0;width:100%;height:100%;overflow-y:auto;}
#two input[type=text]{width:55%;}
.comments:first-child{margin-top:20px;}
.picc{padding:3%;margin-top:3%;}
.comments{width:80%;}
.mains img{width:55%;}
.mainp input:not(.updesc){width:80%;padding:3%;}
.dsxc{width:80%;}
#padxs{
padding:6%;
}
#pad5{padding:5%;}
.mains h2{padding:8%;}
#two input[type=text]{width:55%;height:20px;}
#two input[type=submit]{padding:3%;}
}
@media screen and (min-width:1250px){
.mains img{height:220px;}
}

@media screen and (min-width:1023px){
@media screen and (max-width:1600px){
.crechatform{width:50%;}

}
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

#create input[type=text] {
    width: 50%;
    padding: 2% 3.5%;
    margin: 8px;
    margin-left:25%;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

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
.crepost{width:49%;display:inline-block;}
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
#two input[type=text]:focus +#two input[type=submit]{
background:green;
}
.main{background:#663399;width:100%;}
.main h1{color:#fff;text-align:center;margin:0;padding:60px 16px;}
.nmain{text-align:center;}
.mnain h2{font-family:'Raleway', sans-serif;}

.options{
width:100%;
height:100%;
}
.options a{display:inline-block;text-decoration:none;padding:2%;}
#lg{
-webkit-appearance:none;
-webkit-border-radius:6px;
}


.crechatform{
position:fixed;
background:#fff;
border:1px solid #d7d7d7;
display:none;
}
.crechatform:hover{cursor:pointer;box-shadow:0px 0px 25px #d7d7d7;}
.chatbool i{font-size:34px;padding:3%;}
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
.chatbool i{font-size:34px;padding:3%;}
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
.chatb h2, h3{display: inline-block;margin:0;}
#pstchcr{
width:20%;
display:inline-block;

}
.datpad label h2{display: inline-block;margin:0;}
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
</style>

</head>
<body>
  <div id="Sidenav" class="side">
    <a href="javascript:void(0)" class="closebtn" onclick="openNav()">&times;</a>
    <a href="mypage.php"><img src="<?php echo $pimg; ?>" height="115px">
    <p><?php echo $username;  ?></p>

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
<?php echo $mychat; ?>
</div>

  </div>

<div class="mnav">
<span onclick="openNav()">&#9776;</span>
<h1>Logarithm</h1>
<form id="two" method="post" action="mypage.php">
	<input type="text" placeholder="Search" name="target" autocomplete="off" onfocus="greener()" onblur="blacker()">
        <input name="tidsubm" id="nau" value="Search" type="submit" />
        <div class="result"></div>

</form>
</div>

<div class="main">

<h1>404 Error - Not Found</h1>
</div>

<div class="nmain">
<h2>You have searched for <?php echo $target;?></h2>
<h2>No such user exists</h2>
<h2>Actions:</h2>
<div class="options">
<a href="mypage.php">My Page</a>
<a href="index.php">Main Feed</a>
<a href="signin.php">Login Page</a>
</div>
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
<div class="btn-style">Create Chat</div>
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

<div class="open_chat"></div>
<div class="open_chat"></div>
<div class="open_chat"></div>

<?php

if(!isset($chat_bool)){

}elseif($chat_bool == "Something went wrong"){
echo "<div class='chatbool'>";
echo "<div class='iris'><i id='close_chatn' onclick='close_chatn()'  class='material-icons'>close</i></div>";
echo "<p>$errors</p>";
echo "</div>";

}else{

echo "<div class='chatbool'>";
echo "<div class='iris'><i id='close_chatn' onclick='close_chatn()'  class='material-icons'>close</i></div>";
echo "<p>Your chat has been created</p>";
echo "<p>To visit click </p>";
echo "
      <div class='chat_locb' onlci='chat_generate($chat_index)'>here</div>
   ";

echo "</div>";

}
?>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="scripts/chat.js"></script>
<script src="scripts/nav.js"></script>
<script src="scripts/general.js"></script>
<script>

function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}

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
$(document).ready(function() {
    $("body").on("click",function() {
        $(".result").css("display","none");
    });

});
</script>
<script>
var modal = document.getElementById('create');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script>
$(document).ready(function(){

$("#ed").click(function(){
$(".changed").fadeIn(1000);
});
});

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

$('#dacform').submit();

}
});

function close_chatn() {
        $(".chatbool").hide();
}
</script>

</body>
</html>
