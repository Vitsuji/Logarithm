<?php

session_start();
include 'dbconnect.php';
if($_SESSION['chat_index'] === Null){

//
}else{
  $username = $_SESSION['username'];
$chat_index = $_SESSION['chat_index'];
$chatq = "SELECT * FROM   `chats` WHERE `index` = '$chat_index'";
$chatqsuc = mysqli_query($conn,$chatq);
$chat_rows = mysqli_fetch_assoc($chatqsuc);
if($chat_rows){
$chat_title = $chat_rows['title'];
$chat_description = $chat_rows['description'];
$chat_img = $chat_rows['img'];
$chat_wall = $chat_rows['wall'];
$chat_date = $chat_rows['date'];
$chat_authr = $chat_rows['authr'];
$chat_wall = "wimages/".$chat_rows['wall'];

$chat_userq = "SELECT * FROM `profiles` WHERE `name` ='$chat_authr'";
$chatus = mysqli_query($conn,$chat_userq);
$urow = mysqli_fetch_assoc($chatus);
if($urow){
$a_img = $urow['pimg'];
  $a_img = "pimages/".$a_img;

}//if urow

$nusers = "SELECT * FROM `chat_relationship` WHERE `chat` = '$chat_index'";
$nuserss = mysqli_query($conn,$nusers);
if($nuserss){
$num_users = mysqli_num_rows($nuserss);

}//if nusers

$username = $_SESSION['username'];
$user_in = "SELECT * FROM `chat_relationship` WHERE  `chat` = '$chat_index' AND `user` = '$username'";
$check_user_in = mysqli_query($conn,$user_in);
$uchecknum = mysqli_num_rows($check_user_in);
if($uchecknum == 1){

}else{
  $user_conceal = true;
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
}//if user not in chat



}else{
echo "no such chat exists";

}//if chat rows

if(isset($_POST['chat_join']) ? $_POST['chat_join'] : null){
$user_join_c = "INSERT INTO `chat_relationship`  (
`chat` ,
`user`
)
VALUES (
'$chat_index' ,  '$username'
)";

$user_join_cs = mysqli_query($conn,$user_join_c);
if($user_join_cs){

  if(isset($user_conceal) ? $user_conceal : null){
unset($user_conceal);
  }
}

}


if(isset($_POST['chat_leave']) ? $_POST['chat_leave'] : null){
$chatToLeave = $_POST['chat_leave'];
$leavequery = "DELETE FROM `chat_relationship` WHERE `chat_relationship`.`chat` = '$chatToLeave'";
if(mysqli_query($conn,$leavequery)){
$_SESSION['chat_index'] = "None";
header("location: http://localhost/Logarithm/home/");

}//if leave chat


}//leave chat iis_get_service_state



}//chat index not null
 ?>



<!DOCTYPE html>
<html>
<head>
<title>Public Chat - <?php echo $chat_title; ?></title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="description" content="The developers' corner"/>
<meta name="author" content="Vitsuji Aura"/>
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<style>
body{margin:0;padding:0;font-family:'Raleway',sans-serif;overflow-x:hidden;}

@media screen and (min-width:680px){
.wcom input[type=text]{width:50%;height:50%;}
.comstandin{margin:0 auto;margin:2%;}

}

@media screen and (max-width:680px){
.wcom input[type=text]){width:70%;height:60%;}
.comstandin{margin:0 auto;margin:2%;margin-top:22%;}
.chat_leave{width:75%;margin_left:12.5%;}
}

.mnav{padding:0;margin:0;border:1px solid #d7d7d7;text-align:center;height:10%;}

.mnav h1{display:inline-block;margin:0;font-family:'Josefin Slab',sans-serif;padding:5.5% 0px 5.5% 5.5%;color:#069E2D;}
.mnav span{font-size:30px;cursor:pointer;float:right;padding:5%;padding-left:0;margin-right: 1.2%;width: auto;}
#chat_un_small{font-size:30px;cursor:pointer;float:right;padding:5%;padding-left:0;margin-right: 1.2%;display: none;}

.side {
    height: 75%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    border:1px solid #d7d7d7;
    background-color: #fff;
    overflow-x: hidden;
  //  transition: 0.5s;
   // padding-top: 60px;
    font-family:'Josefin Slab',sans-serif;
    display: none;
    width:25%;
    top:24%;

}
.mdiv{
width:100%;
margin-bottom:5%;
}
.middle{

margin:1%;
//background:#F26419;
background:#069E2D;
height:100%;
text-align:center;
color:#fff;
border-radius:4px;
}
.middle p{padding:10%;}
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
height:150px;

}

.side a#naive{    border:1px solid #d7d7d7;}
.side a:first-child{padding-bottom:0;}
.side a:nth-child(2){margin:0;}
.side a:nth-child(2) p{
margin:0;
paddding:0;
margin-bottom:5%;
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

h1, h2, h3, h4{
font-weight:100;
}
p{text-align:center;}
.mnav{padding:0;margin:0;border-right:none;border-left:none;}



.side h2{font-size:1.8em;text-align:center;-webkit-margin-before:1.66em;}
.authr{
  width:78%;
  margin:0 auto;
  background-image: url(<?php $g = '"'; echo $g.$chat_img.$g; ?>);
  -webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
  background-repeat: no-repeat;
  background-position: 50% 50%;


.
}

.authr img{border-radius:50%;
width:40px;
height:40px;
border:1px solid #d3d3d3;
}

.wcom{
z-index:2;
border:1px solid #d7d7d7;
//position:absolute;
//bottom:0;
width:25%;
height:10.5%;
  display: flex;
display: -webkit-flex;
   justify-content: center;
   //align-items:center;
-webkit-align-items: center;
  -webkit-flex-direction: row ;
-webkit-justify-content: space-around;
position:fixed;
bottom:0;
background:#fff;
border-right: none;
border-left:none;
}

.wcom input[type=text]{
border-radius:15px;
outline:none;
border:none;
border:1px solid #d7d7d7;
padding-left:15px;
}
.wcom input[type=text]:focus{
border-color: #66CC75;
}

.msgs{
position:fixed;
width:25%;
height:84%;
overflow-y: auto;
overflow-x:hidden;
height: 60.8%;
<?php
if(isset($chat_wall) ? $chat_wall : null){

  echo "background-image: url($chat_wall);";
}else{

  echo "background:#fff;";
}

 ?>

 background-size: cover;
 background-repeat: no-repeat;
 background-position: 50% 50%;
}

.msgs::-webkit-scrollbar {
    width: 0.5em;
}

.msgs::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}

.msgs::-webkit-scrollbar-thumb {
/*  background-color: darkgrey;*/
  outline: 1px solid slategrey;
  background-color: #d3d3d3;
}


.com{
height:40px;
text-align:left;
margin-left:5%;
}
.com img, .com_p img{
border-radius:50%;
width:40px;
height:40px;
border:1px solid #d3d3d3;
}
.com_p img{float:right}


.comname{
background:none;
color:blue;
padding:5px;
text-align:left;
     border:none;
     padding:0!important;
     font: inherit;
     /*border is optional*/
     /*border-bottom:1px solid blue; */
     text-shadow: 0px 0px 3px #fff;

}
.contcomv{
display:inline-block;
height:40px;
}
.comcon{padding:8px;border-radius:25px;border:1px solid #d7d7d7;background: #fff;}
.comcon p{margin:0;}

.comcon_p{padding:8px;border-radius:25px;border:1px solid #fff;color:#fff;background:#069E2D;}
.comcon_p p{margin:0;}

.comname:hover, .com img:hover{
cursor:pointer;
}
.cominpar{display:none;}
.noircom{z-index:-1;}


//.comdel{background:none;border:none;}
#melcom{display:inline-block;margin:0;}
#melcom input{display:none;}
#getcom{display:inline-block;}
#nocoml{
font-weight:100;
margin-top:10%;
font-size:20px;
}

#lg{
-webkit-appearance:none;
-webkit-border-radius:6px;
}
#delcom{display:none;}
.authr_img{

    width: 125px;
    height: 125px;
    background-image: url(<?php $g = '"'; echo $g.$a_img.$g; ?>);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: 50% 50%;
border-radius:50%;
margin:0 auto;
border:4px solid #fff;
}

.authr_name {
color:#fff;
font-size:28px;
text-align:center;
text-shadow: 0px 0px 3px black;

}

.chat_descy{text-align:center}
.descc{text-align:center;width:78%;margin:0 auto;}

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
.chat_back{text-align:center;}

.chat_leave{
    background-color: #069E2D;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
width:70%;
margin-left:15%;

margin-top:5%;
margin-bottom:2%;
}

.chat_leave:hover{
background:#d3d3d3;
}

.com_p{text-align:right;float:right;}



.chat_wall_subm{
display: none;
background: #069E2D;
color:#fff;
border: none;
outline: none;
}

.subm_as_text{

       background:none!important;
       color:inherit;
       border:none;
       padding:0!important;
       font: inherit;
       /*border is optional*/
       border-bottom:1px solid #444;
       cursor: pointer;
text-shadow:0px 0px 4px black;

}
.chat_date{padding:9px; margin-left: 4%;width:100%;}

.user_join{

  position:fixed;
  width:31%;
border:1px solid #d7d7d7;
margin-left:34.5%;
margin-top:15%;
}
.user_join_img{
margin:0 auto;
width:81%;
text-align: center;
  background-image: url(<?php $g = '"'; echo $g.$chat_img.$g; ?>);
background-size: cover;
background-repeat: no-repeat;
background-position: 50% 50%;

}

.user_join_img h3{
  margin:0;
margin-top:20px;
padding:20px;
font-weight:600;
color:#fff;
text-shadow: 1px 1px 3px black;
}
  .user_join_desc{
    padding:20px;
width:71%;
overflow-x: hidden;
text-align: center;
margin:0 auto;
line-height:24px;
  }

  .btn-style{
          border:none;
  	border-radius : 6px;
  	font-size : 20px;
  	padding : 10px 20px;
          color:white;
          width:60%;
          transition: border 0.5s;
          outline:none;
          font-family:'Raleway', sans-serif;
display: inline-block;
margin:20px;
  }
  .btn-style:hover{
  cursor:pointer;
  }

#late_btn{float:right;margin-right:10%;background-color :#069E2D;}
#fir_btn{margin-left:10%;background:#d7d7d7;float:left;}
#daform{display: inline-block;width:48%;text-align:center;}

.conceal_wrapper{
  <?php
  if(isset($user_conceal)){
echo "opacity:0.05;";
}
?>
}
.full_wrap{
position:fixed;
width:25%;
height:100%;
border:1px solid #d7d7d7;
resize:both;
bottom:0;
height:75.6%;
}


.chat_enlarge{
height:17%;
width:4%;
position:fixed;
display: flex;
flex-direction: column;


}

.chat_enlarge_full{
    transition: all 0.5s;
flex-grow: 1;
  //width:0;
  //height: 5%;
  background: #fff;
border: 1px solid;
margin:1%;
background: url("styles/full.png");
-webkit-background-size: contain;
    -moz-background-size: contain;
    -o-background-size: contain;
background-size: contain;
    background-repeat: no-repeat;
    background-position: 50% 50%;
    background-position: center;
    width:0;
    height:5%;
}

.chat_enlarge_standard{
    transition: all 0.5s;
flex-grow: 1;
  width:0;
  height: 5%;
background: #fff;
border: 1px solid;
margin:1%;
background: url("styles/standard.png");
-webkit-background-size: contain;
    -moz-background-size: contain;
    -o-background-size: contain;
background-size: contain;
    background-repeat: no-repeat;
    background-position: 50% 50%;
    background-position: center;
}

.chat_enlarge_small{
  margin:1%;
  transition: all 0.5s;
flex-grow: 1;
  width:0;
  height: 5%;
  background: #fff;
border: 1px solid;
background: url("styles/small.png");
-webkit-background-size: contain;
    -moz-background-size: contain;
    -o-background-size: contain;
background-size: contain;
    background-repeat: no-repeat;
    background-position: 50% 50%;
    background-position: center;
}

.chat_enlarge_small:hover{cursor:pointer;}
.chat_enlarge_standard:hover{cursor:pointer;}
.chat_enlarge_full:hover{cursor:pointer;}

.comstandin{
  margin-top:15%;
width:90%;
padding:1%;
height:5%;
float:left;
}


#comstandin_p{float: right;margin-right: 5%;}
</style>
</head>
<body>

<div class="full_wrap">
   <div class="force-overflow"></div>
<div id="Sidenav" class="side">

  <h2>Chat Settings & Info</h2>

    <a id="closebtn" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

	<div class="authr">

	<a>
<div class="authr_img"></div>​
   </a>
<form action="mypage.php" method="post">


<div class="authr_name"><button value="<?php echo $chat_authr ?>" name="userlink" class="subm_as_text"><?php echo $chat_authr;  ?></button></div>
</form>

	</div>

<div class="chat_info">

<div class="chat_descy">

<h2>Chat Description</h2>
<div class="descc">
<h3><?php echo $chat_description; ?></h3>
</div>

</div>

<div class="chat_fol"><h2>Chat users: <?php echo $num_users; ?></h2></div>

<div class="chat_back">
<h2> Change Chat Wallpaper</h2>

<form method="post" action="picture.php" enctype="multipart/form-data">
<input type="file" id="upload" class="custom-file-input" name="chat_wall">
<input type="submit" class="chat_wall_subm" value="Change"/>
</form>

</div>

</div>

<form method="post" action="chat.php" >
<!--<input type="submit" class="chat_leave" name="" value="Leave Chat">-->

<button class="chat_leave" name="chat_leave" value="<?php echo $chat_index; ?>" >Leave Chat</button>
</form>
</div>


<div class="mnav">
<span onclick="openNav()">&#9776;</span>
<i class="material-icons" id="chat_un_small" onclick="chat_un_small()">arrow_upward</i>
<h1><?php echo $chat_title ?></h1>

</div>


<!--one ting-->
<div class="conceal_wrapper">
<div class="msgs" id="5e2dbe2be3b5927c588509edb1c46f7d">


</div>



<form method="post" id="comform">
<div class="wcom" >
<input maxlength="140" type = "text" id="5e2dbe2be3b5927c588509edb1c46f7d" class="comin" placeholder="My message..." name="sendmsg" autocapitalize="off" autocorrect="off"/>
</div>
</form>
</div>

<div class="chat_enlarge">
<div class="chat_enlarge_full" onmouseover="chat_action(this)" onmouseout="chat_action_negative(this)" onclick="chat_enlarge_full()"></div>
<div class="chat_enlarge_standard"  onmouseover="chat_action(this)" onmouseout="chat_action_negative(this)" onclick="chat_enlarge_standard()"></div>
<div class="chat_enlarge_small"  onmouseover="chat_action(this)" onmouseout="chat_action_negative(this)" onclick="chat_enlarge_small()"></div>
</div>

</div>






<?php
if(isset($user_conceal) ? $user_conceal : null){
echo $user_join;
}


 ?>




<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$( document ).ready(function() {
//  receivecom();
  chat_enlarge_standard();
  chat_receivemsgs();
});

function openNav() {
  //  document.getElementById("Sidenav").style.width = "25%";
  $( "#Sidenav" ).slideToggle( "slow", function() {
    // Animation complete.
  });
    $(".wcom").css("display","none");

}

function closeNav() {
//    document.getElementById("Sidenav").style.width = "0";
$( "#Sidenav" ).slideToggle( "slow", function() {
  // Animation complete.
});
$(".wcom").css("display","-webkit-flex");
$(".wcom").css("display","flex");
}
</script>
<script>
 function news(){
  document.getElementById("Sidenav").style.width = "0px";
 }

$(".custom-file-input").focus(function(){
$(".chat_wall_subm").css("display","inline-block");


});

// NEW TEST

/*var cusid_ele = document.getElementsByClassName('.msgs');
if(cusid_ele.length == 0){
  console.log("hi");

}else{
for (var i = 0; i < cusid_ele.length; ++i) {
    var item = cusid_ele[i];
    var item_id = item.id;

    $.ajax({
   type:"GET",
   cache:false,
   url:"receivemsg.php",
   data:item_id,    // multiple data sent using ajax
   success: function (html) {

     $('#add').val('data sent sent');
     $('#msg').html(html);
   }
 });
 return false;
});

    item.innerHTML = 'this is value '+i;
}
*/

function chat_receivemsgs(){

var cusid_ele = document.getElementsByClassName('msgs');
if(cusid_ele.length == 0){
  console.log("hi");

}else{
  for (var i = 0; i < cusid_ele.length; ++i) {
      var item = cusid_ele[i];
      var item_id = item.id;

      var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
           document.getElementById(item_id).innerHTML = this.responseText;
         }
       }
      xmlhttp.open("GET","receivemsg.php?q="+item_id,true);
      xmlhttp.send();


    }
  }
}






/*
function receivecom(){
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               document.getElementById("msgs").innerHTML = this.responseText;

            }
        };
        xmlhttp.open("POST","receivemsg.php",true);
 //xmlhttp.open("POST","receivemsg.php",true);
 //xmlhttp.open("POST","receivemsg.php",true);
        xmlhttp.send();
receivecom2();


}
function receivecom2(){
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               document.getElementById("msgs").innerHTML = this.responseText;





            }
        };
        xmlhttp.open("POST","receivemsg.php",true);
 xmlhttp.open("POST","receivemsg.php",true);
 xmlhttp.open("POST","receivemsg.php",true);
        xmlhttp.send();


}*/

//send
$(".comin").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
    var item_id = this.id;
    alert(item_id);
if($.get('sendcom.php?q='+item_id, $('#comform').serialize())){
  var a = $(".comin").val();
  alert(a);
document.getElementById(item_id).value = "";
//sent and cleared




}

}
});

//take
//setInterval(function(){ receivecom(); }, 250);


$(function() {
    $(".full_wrap").draggable({
  axis: "x",
   containment: "window"
});

});


function chat_enlarge_full(){
$(".full_wrap").css({"width":"100%","height":"100%","left":"0"});
$(".msgs").css("width","100%");
$(".msgs").css("height","82.3%");
$(".comstandin").css("margin-top","0.8%");
$(".wcom").css("width","100%");
$("#Sidenav").css("width","100%");
$(".chat_leave").css("width","30%");
$(".chat_leave").css("margin-left","35%");
$(".mnav span").css("padding","1.2%");
$(".side a:nth-child(2)").css("padding","0.83em");
$(".mnav").css("height","8%");
$(".mnav h1").css("padding","1%");
$(".mnav span").css({"padding":"0.8%","margin-right":"1.5%","width":"auto"});
$(".comstandin").css({"margin-top":"2%","padding":"0"});
$(".side").css({"width":"100%","height":"100%","top":"0"});
$(".mnav h1").css("width","90%");

  }

function chat_enlarge_standard(){
$(".full_wrap").css({"width":"25%","height":"75.6%","right":"auto"});
$(".msgs").css("width","25%");
$(".comstandin").css("margin-top","13%");
$(".wcom").css("width","25%");
$("#Sidenav").css("width",".25%");
$(".chat_leave").css("width","70%");
$(".chat_leave").css("margin-left","15%");
$(".mnav span").css("padding","0");
$(".side a:nth-child(2)").css({"padding":"15px"});
$(".mnav").css("height","10%");
$(".mnav h1").css("padding","5% 0px 5% 5%");

    $(".mnav span").css({
          "padding": "5%",
              "padding-left": "0",
              "padding-top":"3%",
              "width":"5%"
        });
$(".side").css({"width":"25%","height":"75.7%"});

$(".mnav h1").css("width","75%");
  }

function chat_enlarge_small(){
  $(".full_wrap").css({"width":"25%","height":"75.6%","right":"auto"});
  $(".msgs").css("width","25%");
  $(".comstandin").css("margin-top","13%");
  $(".wcom").css("width","25%");
  $("#Sidenav").css("width",".25%");
  $(".chat_leave").css("width","70%");
  $(".chat_leave").css("margin-left","15%");
  $(".mnav span").css("padding","0");
  $(".side a:nth-child(2)").css({"padding":"15px"});
  $(".mnav").css("height","10%");
  $(".mnav h1").css("padding","5% 0px 5% 5%");

      $(".mnav span").css({
            "padding": "5%",
                "padding-left": "0",
                "padding-top":"3%",
                "width":"5%"
          });
  $(".side").css({"width":"25%","height":"75.7%"});
$(".mnav h1").css("width","75%");

$(".msgs").css("display","none");
$(".wcom").css("display","none");
$(".chat_enlarge").css("display","none");
$(".full_wrap").css("top","92%");
$(".mnav span").css("display","none");
$("#chat_un_small").css("display","inline-block");
}
function chat_un_small(){
  $(".msgs").css("display","block");
  $(".wcom").css({"display":"flex","display":"-webkit-flex"});
  $(".chat_enlarge").css({"display":"flex","display":"-webkit-flex"});
  $(".full_wrap").css({"top": "auto"," bottom":"0"});
$("#chat_un_small").css("display","none");
$(".mnav span").css("display","inline-block");
}

function chat_action(obj){
$(obj).css("width","100%");

}

function chat_action_negative(obj){
$(obj).css("width","0");

}

</script>


</body>
</html>
