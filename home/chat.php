<?php

session_start();
include 'dbconnect.php';
if($_SESSION['chat_index'] === Null){

//
}else {

/*

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


*/


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

@media screen and (min-width:980px){
/*.wcom input[type=text]{width:50%;height:50%;}*/

}

@media screen and (max-width:980px){
/*.wcom input[type=text]){width:70%;height:60%;}
.chat_leave{width:75%;margin-left:12.5%;}*/



}

/*Tablet to Min-Desktop*/
@media screen and (max-width: 780px) and (min-width: 320px) {
.comstandin{ margin-top:6%;padding-top:0;}
.wcom input[type=text]{width:50%;padding:15px;font-size:20px;}


}

/* Mobile to Tablet */
@media screen and (max-width: 980px) and (min-width: 720px) {
.comstandin{ margin-top:3%;padding-top:0;}
.wcom input[type=text]{width:50%;padding:15px;font-size:20px;}
}

/*Small Desktop*/
@media screen and (max-width: 1024px) and (min-width: 981px) {
.full_wrap{width:37%;}
.msgs{width:37%;}
.wcom{width:37%;}
.mnav{width:100%;}
.wcom input[type=text]{width:50%;padding:3%;}
.comstandin{margin-top:13%;}
}
/* Big Desktop*/
@media screen and (max-width: 1640px) and (min-width: 1025px) {
.full_wrap{width:25%;}
.msgs{width:25%;}
.wcom{width:25%;}
.mnav{width:100%;}
.wcom input[type=text]{padding:3.5%;}
.comstandin{margin-top:13%;}
}


.mnav{padding:0;margin:0;border:1px solid #d7d7d7;text-align:center;height:10%;}

.mnav h1{display:inline-block;margin:0;font-family:'Josefin Slab',sans-serif;color:#069E2D;}
.mnav span{font-size:30px;cursor:pointer;float:right;padding:5%;padding-left:0;margin-right: 1.2%;width: auto;}
#chat_un_small{font-size:30px;cursor:pointer;float:right;padding:5%;padding-left:0;margin-right: 1.2%;display: none;}

.side {
    height: 100%;
    width: 100%;
  /*  position: fixed;*/
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
  background:#fff;
position:fixed;
height:84%;
overflow-y: auto;
overflow-x:hidden;
height: 58%;


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
  width:20%;
border:1px solid #d7d7d7;
margin-left:2.5%;
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

}
.full_wrap{
  background: #fff;
position:fixed;
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
background: url("styles/images-icons/full.png");
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
background: url("styles/images-icons/standard.png");
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
background: url("styles/images-icons/small.png");
-webkit-background-size: contain;
    -moz-background-size: contain;
    -o-background-size: contain;
background-size: contain;
    background-repeat: no-repeat;
    background-position: 50% 50%;
    background-position: center;
}

.chat_enlarge_close{
display: none;
margin:1%;
transition: all 0.5s;
flex-grow: 1;
width:0;
height: 5%;
background: #fff;
border: 1px solid;
background: url("styles/images-icons/close.png");
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
.chat_enlarge_close:hover{cursor:pointer;}

.comstandin{

width:90%;
padding:1%;
height:5%;
float:left;
}


#comstandin_p{float: right;margin-right: 5%;}
 .hidden_index{display: none;}

.chat_close{
position: fixed;
display: inline-block;
border:1px solid #d7d7d7;
border-left:none;
margin-left: 4%;


}

.chat_close:hover{
color:#d7d7d7;
cursor: pointer;

}
.chat_close i{
padding: 20px;
font-size: 30px
}


.chat_test_start_button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}



</style>
</head>
<body >
<button class="chat_test_start_button" onclick="chat_generate(1)">Button</button>
<button class="chat_test_start_button" onclick="chat_generate(2)">Button</button>




<div class='open_chat'></div>
<div class='open_chat'></div>
<div class='open_chat'></div>





<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$( document ).ready(function() {
startf();



});


function startf(){
  //chat_enlarge_standard_general();
  //setInterval(function(){ chat_receivemsgs(); }, 250);
  chat_receivemsgs_general();

}



/*function chat_generate(chat_id){

          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
               document.getElementById("chat_cont").innerHTML = this.responseText;



              }
          }
          xmlhttp.open("GET", "chat_generator.php?q=" + chat_id, true);
          xmlhttp.send();

}/*/

function chat_generate(chat_id) {

var id = chat_id.toString();
var check_user_in = "#chat_"+id;
if($(check_user_in).length == 0) {
        var open ="";
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var myObj = JSON.parse(this.responseText);
                        /*var text = "Welcome to chat: "+myObj[1];*/
                        open = [
                          "<div class='full_wrap' id='chat_"+chat_id+"'>   <div class='force-overflow'></div>    <div id='nav_"+chat_id+"' class='side'>      <h2>Chat Settings & Info</h2>  <a id='closebtn' href='javascript:void(0)'",
                          "class='closebtn' onclick='closeNav("+chat_id+")'>&times;</a>    	<div class='authr' style='background-image:url("+myObj[3]+");'>    	<a>    <div class='authr_img' style='background-image:url(pimages/"+myObj[8]+");'></div>​       </a>    <form action='mypage.php' method='post'>    <div ",
                          "class='authr_name'><button value='"+myObj[6]+"' name='userlink' class='subm_as_text'> "+myObj[6]+"</button></div>    </form>    	</div>    <div class='chat_info'>    <div ",
                          "class='chat_descy'>    <h2>Chat Description</h2>    <div class='descc'>    <h3>"+myObj[2]+"</h3>    </div>    </div>    <div class='chat_fol'><h2>Chat users: 2</h2></div>    <div class='chat_back'>    <h2> ",
                          "Change Chat Wallpaper</h2>    <form method='post' action='picture.php' enctype='multipart/form-data'>    <input type='file' id='upload' class='custom-file-input' name='chat_wall'>    <input type='submit' ",
                        "class='chat_wall_subm' value='Change'/>    </form>    </div>    </div>    <form method='post' action='chat.php' >    <button class='chat_leave' name='chat_leave' value='$chat_index' >Leave Chat</button>    </form>    </div>    <div class='mnav'>    ",
                        "<span onclick='openNav("+chat_id+")'>&#9776;</span>    <i class='material-icons' id='chat_un_small' onclick='chat_un_small("+chat_id+")'>arrow_upward</i>    <h1>"+myObj[1]+"</h1>    <div class='chat_close' onclick='chat_close("+chat_id+")'><i ",
                        "class='material-icons' style='alert(1)'>&#xE5CD;</i></div>    </div>    <div class='conceal_wrapper'>    <div class='msgs' style='background-image:url("+myObj[4]+")' id='"+chat_id+"'>    </div>    <form method='post' id='form_"+chat_id+"' class='comform'>    <div class='wcom' >    <input maxlength='140' type = 'text' id='input_"+chat_id+"'  class='comin' placeholder='My message...' name='sendmsg' onkeypress='g(event,"+chat_id+")' ",
                        "autocapitalize='off' autocorrect='off'  />    <input class='hidden_index' type='text' value='"+chat_id+"' name='chat_index'/>    </div>    </form>    </div>    <div class='chat_enlarge'>    <div class='chat_enlarge_full' onmouseover='chat_action(this)' onmouseout='chat_action_negative(this)' ",
                        "onclick='chat_enlarge_full("+chat_id+")'></div>    <div class='chat_enlarge_standard'  onmouseover='chat_action(this)' onmouseout='chat_action_negative(this)' onclick='chat_enlarge_standard("+chat_id+")'></div>    <div ",
                        "class='chat_enlarge_small'  onmouseover='chat_action(this)' onmouseout='chat_action_negative(this)' onclick='chat_enlarge_small("+chat_id+")'></div><div class='chat_enlarge_close'  onmouseover='chat_action(this)' onmouseout='chat_action_negative(this)' onclick='chat_close("+chat_id+")'></div>    </div></div>"
                        ].join("\n");

                        var cusid_ele = document.getElementsByClassName('open_chat');
                        if(cusid_ele.length == 0){
                          alert("No more chat space");

                        }else{

                                $(cusid_ele[0]).replaceWith(open);
                                draggables();
                                chat_enlarge_standard_general();
                                startf();
                    }
            }




                };

                xmlhttp.open("GET", "receivechatinfo.php?id="+id, true);
                xmlhttp.send();



}else{

        alert("The chat is already open");
}





}



  function chat_close(chat_id){
          chat_id = chat_id.toString();
        $("#chat_"+chat_id).replaceWith("<div class='open_chat'></div>");
        //$('#mydiv').replaceWith('Aloha World');

    }

function g(e, chat_id){
        if (e.keyCode == 13) {
               e.preventDefault();

              var item_id = chat_id;
               alert(item_id);
        if($.post('sendcom.php', $('#form_'+item_id).serialize())){
         var a = $(".comin").val();
         alert(a);
        // var up = '"'+item_id+'"';
         document.getElementById("input_"+item_id).value = "";
        //this.value = " ";
//        chat_receivemsgs_specific(item_id);
        //sent and cleared
}
}
}

function sendmsg(e){
alert(e);
        //send
         /*   if (e.keyCode == 13) {
                e.preventDefault();
                var item_id = this.id;
                alert(item_id);
        if($.post('sendcom.php', $('#form_'+item_id).serialize())){
          var a = $(".comin").val();
          alert(a);
          var up = '"'+item_id+'"';
          alert(up);
        this.value = " ";
        chat_receivemsgs_specific(item_id);
        //sent and cleared




        }

}*/

}



function openNav(id) {
  //  document.getElementById("Sidenav").style.width = "25%";
  //var left = $(".full_wrap").css("left");
  var side_id = "nav_"+id.toString();;
  var form_id = "form_"+id.toString();;

  $( "#"+side_id ).slideToggle( "slow", function() {
    // Animation complete.
    //$(this).css("left",'"'+left+'"');
  });

  if($("#"+form_id+" .wcom" ).css('display') == "flex"){
    $("#"+form_id+" .wcom" ).css("display","none");
}else{
  $("#"+form_id+" .wcom" ).css("display","flex");

}
}

function closeNav(id) {
//    document.getElementById("Sidenav").style.width = "0";
  var side_id = "nav_"+id;
    var form_id = "form_"+id;

$( "#"+side_id ).slideToggle( "slow", function() {
  // Animation complete.
});


$("#"+form_id+" .wcom").css("display","-webkit-flex");
$("#"+form_id+" .wcom").css("display","flex");
}
</script>
<script>


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

function chat_receivemsgs_general(){

var cusid_ele = document.getElementsByClassName('msgs');
if(cusid_ele.length == 0){
  console.log("hi");

}else{
  for (var i = 0; i < cusid_ele.length; ++i) {
    var item = cusid_ele[i];
    var item_id = item.id;




  var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = function(this_item_id) {
        if (this.readyState == 4 && this.status == 200) {
          console.log("yes");
          console.log(this_item_id);
          //  document.getElementById(this_item_id).innerHTML = this.responseText;
          $("#"+this_item_id).html(this.responseText);
        }else{
          console.log("no");
          console.log(this_item_id);
        }
      }.bind(xmlhttp, item_id);

      xmlhttp.open("GET","receivemsg.php?q="+item_id,true);
      xmlhttp.send();

  }


  }

}

function chat_receivemsgs_specific(chat_id){

  var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = function(this_item_id) {
        if (this.readyState == 4 && this.status == 200) {
          console.log("yes");
          console.log(this_item_id);
          //  document.getElementById(this_item_id).innerHTML = this.responseText;
          $("#"+this_item_id).html(this.responseText);
        }else{
          console.log("no");
          console.log(this_item_id);
        }
      }.bind(xmlhttp, chat_id);

      xmlhttp.open("GET","receivemsg.php?q="+chat_id,true);
      xmlhttp.send();

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




//take
//setInterval(function(){ receivecom(); }, 250);

function draggables(){
alert("drag");
    $(".full_wrap").draggable({
  axis: "x",
   containment: "window"
});
}

/*$(".side").draggable({
axis: "x",
containment: "window"
});*/




function chat_enlarge_full(chat_id){
  var item_id = "chat_"+chat_id.toString();

$("#"+item_id+" .chat_close").css("display","none");
$("#"+item_id+" .msgs").css("width","100%");
$("#"+item_id).css({"width":"100%","height":"100%","left":"0"});
$("#"+item_id+" .msgs").css("width","100%");
$("#"+item_id+" .msgs").css("height","82.3%");
$("#"+item_id+" .comstandin").css("margin-top","0.8%");
$("#"+item_id+" .wcom").css("width","100%");
//$("#"+item_id+" .side").css("width","100%");
$("#"+item_id+" .chat_leave").css("width","30%");
$("#"+item_id+" .chat_leave").css("margin-left","35%");
$("#"+item_id+" .mnav span").css("padding","1.2%");
$("#"+item_id+" .side a:nth-child(2)").css("padding","0.83em");
$("#"+item_id+" .mnav").css("height","8%");
$("#"+item_id+" .mnav h1").css("padding","1%");
$("#"+item_id+" .mnav span").css({"padding":"0.8%","margin-right":"1.5%","width":"auto"});
$("#"+item_id+" .comstandin").css({"margin-top":"3.5%","padding":"0"});
$("#"+item_id+" .side").css({"width":"100%","height":"100%","top":"0"});
$("#"+item_id+" .mnav h1").css("width","90%");
$("#"+item_id+" .chat_enlarge_close").css("display","block");
$("#"+item_id+" .chat_enlarge_small").css("display","none");
$("#"+item_id+" .wcom input[type=text]").css({"padding":"15px","width":"24%"});
  }





  function chat_enlarge_standard_general(){
const mq = window.matchMedia( "(min-width: 981px)" );

if (mq.matches) {
  // window width is at least


 //   if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
     // some code..
     alert("greater than 981px");
     $(".full_wrap").css({"height":"75.6%","right":"auto"});
     $(".comstandin").css("margin-top","13%");
     $(".side").css("width","100%");
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
     $(".side").css({"width":"100%","height":"90%"});

     $(".mnav h1").css("width","75%");

    }else{

   alert("smaller than 981px");
    $(".full_wrap").css({"width":"100%","height":"100%","left":"0"});
    $(".msgs").css("width","100%");
    $(".msgs").css("height","82.3%");
    $(".wcom").css("width","100%");
     // $(".wcom input[type=text]").css({"padding":"3.2%","width":"40%","font-size":"20px","padding":"10px"});
    //$("#"+item_id+" .side").css("width","100%");
    $(".chat_leave").css("width","40%");
    $(".chat_leave").css("margin-left","30%");
    $(".mnav span").css("padding","1.2%");
    $(" .mnav").css("height","8%");
      $(" .chat_close").css("display","none");
    $(".mnav span").css({"margin-right":"1.5%","width":"auto","padding":"3%","padding-left":"0"});
    // $(".comstandin").css({"margin-top":"3%","padding":"0"});
    $(".side").css({"width":"100%","height":"100%","top":"0"});
            $(".mnav h1").css({"padding-top":"3%", "margin-left":"3%"});

              $(".chat_enlarge").css({"height":"6%","width":"6%"});
              $(".chat_enlarge_standard").css({"display":"none"});
              $(".chat_enlarge_small").css({"display":"none"});
              $(".chat_enlarge_full").css({"display":"none"});
              $(".chat_enlarge_close").css({"display":"block","width":"100%"});



    }
    }




  function chat_enlarge_standard(chat_id){
var item_id = "chat_"+chat_id.toString();
    $("#"+item_id+" .chat_close").css("display","inline-block");
  $("#"+item_id+" .comstandin").css("margin-top","20%");
  $("#"+item_id+" .side").css("width","100%");
  $("#"+item_id+" .chat_leave").css("width","70%");
  $("#"+item_id+" .chat_leave").css("margin-left","15%");
  $("#"+item_id+" .mnav span").css("padding","0");
  $("#"+item_id+" .side a:nth-child(2)").css({"padding":"15px"});
  $("#"+item_id+" .mnav").css("height","10%");
  $("#"+item_id+" .mnav h1").css("padding","5% 0px 5% 5%");

      $("#"+item_id+" .mnav span").css({
            "padding": "5%",
                "padding-left": "0",
                "padding-top":"3%",
                "width":"5%"
          });
  $("#"+item_id+" .side").css({"width":"100%","height":"90%"});

  $("#"+item_id+" .mnav h1").css("width","75%");
  $("#"+item_id+" .chat_enlarge_close").css("display","none");
  $("#"+item_id+" .chat_enlarge_small").css("display","block");
  $("#"+item_id+" .comin").css("width","auto");

  const mq = window.matchMedia( "(min-width: 1025px)" );

  if (mq.matches) {
          alert("1");
   $("#"+item_id).css({"width":"25%","height":"75.6%","right":"auto"});
     $("#"+item_id+" .msgs").css({"width":"25%","height":"58%"});
      $("#"+item_id+" .wcom").css("width","25%");
    }else {
              alert("2");
   $("#"+item_id).css({"width":"37%","height":"75.6%","right":"auto"});
  $("#"+item_id+" .msgs").css({"width":"37%","height":"58%"});
  $("#"+item_id+" .wcom").css("width","37%");
    }
}

function chat_enlarge_small(id){
  var item_id = "chat_"+id.toString();

chat_enlarge_standard(id);


$("#"+item_id+" .chat_close").css("display","inline-block");
  $("#"+item_id).css({"width":"25%","height":"75.6%","right":"auto"});
 /* $("#"+item_id+" .msgs").css("width","25%");*/
  $("#"+item_id+" .comstandin").css("margin-top","13%");
  $("#"+item_id+" .wcom").css("width","25%");
  $("#"+item_id+" .side").css("width","100%");
  $("#"+item_id+" .chat_leave").css("width","70%");
  $("#"+item_id+" .chat_leave").css("margin-left","15%");
  $("#"+item_id+" .mnav span").css("padding","0");
  $("#"+item_id+" .side a:nth-child(2)").css({"padding":"15px"});
  $("#"+item_id+" .mnav").css("height","10%");
  $("#"+item_id+" .mnav h1").css("padding","5% 0px 5% 5%");

      $("#"+item_id+" .mnav span").css({
            "padding": "5%",
                "padding-left": "0",
                "padding-top":"3%",
                "width":"5%"
          });
  $("#"+item_id+" .side").css({"width":"100%%","height":"90%"});
$("#"+item_id+" mnav h1").css("width","75%");

$("#"+item_id+" .msgs").css("display","none");
$("#"+item_id+" .wcom").css("display","none");
$("#"+item_id+" .chat_enlarge").css("display","none");
$("#"+item_id).css("top","92%");
$("#"+item_id+" .mnav span").css("display","none");
$("#"+item_id+" #chat_un_small").css("display","inline-block");
$("#"+item_id+" .chat_enlarge_close").css("display","none");
$("#"+item_id+" .chat_enlarge_small").css("display","block");

const mq = window.matchMedia( "(min-width: 1025px)" );

if (mq.matches) {
 $("#"+item_id).css({"width":"25%","height":"75.6%","right":"auto"});
  }else {
 $("#"+item_id).css({"width":"37%","height":"75.6%","right":"auto"});

  }

}
function chat_un_small(chat_id){
    var item_id = "chat_"+chat_id.toString();
      $("#"+item_id+" .chat_close").css("display","inline-block");
  $("#"+item_id+" .msgs").css("display","block");
  $("#"+item_id+" .wcom").css({"display":"flex","display":"-webkit-flex"});
  $("#"+item_id+" .chat_enlarge").css({"display":"flex","display":"-webkit-flex"});
  $("#"+item_id).css({"top": "auto"," bottom":"0"});
$("#"+item_id+" #chat_un_small").css("display","none");
$("#"+item_id+" .mnav span").css("display","inline-block");
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
