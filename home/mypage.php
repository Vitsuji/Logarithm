<?php
session_start();
include 'backend/dbconnect.php';
include 'backend/chatscript.php';
include 'backend/loadmychat.php';

$username = $_SESSION['username'];
$email = $_SESSION['email'];
if($username === Null || $email=== Null){
header("location:http://localhost/Logarithm/signup.php");
}else{
$_SESSION['targetcom'] = $_SESSION['username'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$target = $_SESSION['targetcom'];

$sql ="SELECT *
FROM  `profiles`
WHERE  `name` = '$username'
AND  `email` =  '$email'";

$result = mysqli_query($conn,$sql);
if($result){
$row = mysqli_fetch_assoc($result);

if($row){
$date = $row['date'];
$pimg = $row['pimg'];
$pimg = "pimages/".$pimg;
$description = $row['description'];
}else{
echo "wrong row".mysqli_error($row);
}

}else{
echo "wrong result1";
}

if(isset($_POST['descup']) ? $_POST['descup'] : null){
$newdesc = $_POST['ndesc'];
$changedesc = "UPDATE  `profiles` SET  `description` =  '$newdesc' WHERE  `profiles`.`name` = '$username'";

$result = mysqli_query($conn,$changedesc);
if($result){
header("location:mypage.php");
}else{
echo "<div style='position:fixed;background:#fff;border:1px solid #d7d7d7;'><h3>Failed. Try again later.</h3></div>";
}
}

if(isset($_POST['tidsubm']) ? $_POST['tidsubm'] : null){
$_SESSION['target'] = $_POST['target'];
header("location: target.php");
}
if(isset($_POST['logout']) ? $_POST['logout'] : null){
session_destroy();
header("location: http://localhost/Logarithm/ ");
}

if(isset($_POST['userlink']) ? $_POST['userlink'] : null){
$_SESSION['target'] = $_POST['userlink'];
header("location: target.php");
}

//Followers and Following
$sqll = "SELECT * FROM `relationship` WHERE  (`user1` = '$username') OR (`user2` = '$username')";
$sqllres = mysqli_query($conn,$sqll);
if($sqllres){

$rowfol = mysqli_fetch_array($sqllres);
$num_rows = mysqli_num_rows($sqllres);

$following = 0;
$followed = 0;

$us1 = $rowfol['user1'];

if($num_rows == 1){

 if($us1 == $username){

    $feels = $rowfol['user1rel'];

    if($feels == "Following"){$following++;}

    $exfeels = $rowfol['user2rel'];

    if($exfeels == "Following"){$followed++;}

}else{
    $feels = $rowfol['user2rel'];

    if($feels == "Following"){$following++;}

    $exfeels = $rowfol['user1rel'];

    if($exfeels == "Following"){$followed++;}
}
}else{


 if($us1 == $username){

    $feels = $rowfol['user1rel'];

    if($feels == "Following"){$following++;}

    $exfeels = $rowfol['user2rel'];

    if($exfeels == "Following"){$followed++;}

}else{
    $feels = $rowfol['user2rel'];

    if($feels == "Following"){$following++;}

    $exfeels = $rowfol['user1rel'];

    if($exfeels == "Following"){$followed++;}
}


while($collections = mysqli_fetch_array($sqllres)) {
    $u1 = $collections['user1'];
    if($u1 == $username){

    $feel = $collections['user1rel'];

    if($feel == "Following"){$following++;}

    $exfeel = $collections['user2rel'];

    if($exfeel == "Following"){$followed++;}

}else{
    $feel = $collections['user2rel'];

    if($feel == "Following"){$following++;}

    $exfeel = $collections['user1rel'];

    if($exfeel == "Following"){$followed++;}
}

}

}




//Display followers and following

$sqlll = "SELECT * FROM `relationship` WHERE  (`user1` = '$username') OR (`user2` = '$username')";
$sqlllres = mysqli_query($conn,$sqlll);

$rowfoll = mysqli_fetch_array($sqlllres);
$num_rowss = mysqli_num_rows($sqlllres);


$fol_num = 0;
$fold_num = 0;

$followings = "";
$followers = "";

$user1 = $rowfoll['user1'];
 $user2 = $rowfoll['user2'];
if($user1 != $username){
$opfeel = $rowfoll['user1rel'];
$myfeel = $rowfoll['user2rel'];
$user2 = $rowfoll['user2'];
if($opfeel == "Following"){
$sqly ="SELECT *
FROM  `profiles`
WHERE  `name` LIKE '$user1'";

$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);

if($row){
$dates = $row['date'];
$pimgs = $row['pimg'];
$pimgs = "pimages/".$pimgs;

$followers .= "<div style='background-image: url($pimgs)' class='contr'></div>";
}else{
echo "wrong row".mysqli_error($row);
}

}else{
echo "wrong result2";
}



}


if($myfeel == "Following"){
$sqly ="SELECT *
FROM  `profiles`
WHERE  `name` LIKE '$user1'";

$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);

if($row){
$dates = $row['date'];
$pimgs = $row['pimg'];
$pimgs = "pimages/".$pimgs;

$followings .= "<div style='background-image: url($pimgs)' class='contr'></div>";
}else{
echo "wrong row".mysqli_error($row);
}

}else{
echo "wrong result3";

}
}




}else{
$opfeel = $rowfoll['user2rel'];
$myfeel = $rowfoll['user1rel'];
$user2 = $rowfoll['user2'];

if($opfeel == "Following"){
$sqly ="SELECT *
FROM  `profiles`
WHERE  `name` LIKE '$user2'";

$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);

if($row){
$dates = $row['date'];
$pimgs = $row['pimg'];
$pimgs = "pimages/".$pimgs;

$followers .= "<div style='background-image: url($pimgs)' class='contr'></div>";
}else{
echo "wrong row".mysqli_error($row);
}

}else{
echo "wrong result4";

}


}


if($myfeel == "Following"){
$sqly ="SELECT *
FROM  `profiles`
WHERE  `name` = '$user2'";

$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);

if($row){
$dates = $row['date'];
$pimgs = $row['pimg'];

$pimgss = "pimages/".$pimgs;

   if($pimgss == "pimages/1Vitsuji_Aura1496300814.jpg"){
echo "op2";

}
$followings .= "<div style='background-image: url($pimgss)' class='contr'></div>";


}else{
echo "wrong row".mysqli_error($row);
}

}else{
echo "wrong result5";

}
}


}

//Continuous

while($collection = mysqli_fetch_array($sqlllres)) {

    $user1 = $collection['user1'];
    $user2 = $collection['user2'];
if($user1 != $username){
$opfeel = $collection['user1rel'];
$myfeel = $collection['user2rel'];

if($opfeel == "Following"){
$sqly ="SELECT *
FROM  `profiles`
WHERE  `name` = '$username'";

$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);

if($row){
$dates = $row['date'];
$pimgs = $row['pimg'];
$pimgs = "pimages/".$pimgs;

$followers .= "<div style='background-image: url($pimgs)' class='contr'></div>";


}else{
echo "wrong row".mysqli_error($row);
}

}else{
echo "wrong result6";
}



}


if($myfeel == "Following"){
$sqly ="SELECT *
FROM  `profiles`
WHERE  `name` = '$user2'";

$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);

if($row){
$dates = $row['date'];
$pimgs = $row['pimg'];
$pimgs = "pimages/".$pimgs;
  if($pimages = "pimages/1Vitsuji_Aura1496300814.jpg"){
echo "op3";

}
$followings .= "<div style='background-image: url($pimgs)' class='contr'></div>";
$fol_num=+1;

}else{
echo "wrong row";
}

}else{
echo "wrong result7";

}
}




}else{
$opfeel = $collection['user2rel'];
$myfeel = $collection['user1rel'];
$user2 = $collection['user2'];

if($opfeel == "Following"){
$sqly ="SELECT *
FROM  `profiles`
WHERE  `name` = '$user2'";

$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);

if($row){
$dates = $row['date'];
$pimgs = $row['pimg'];
$pimgs = "pimages/".$pimgs;

$followers .= "<div style='background-image: url($pimgs)' class='contr'></div>";

}else{
echo "wrong row";
}

}else{
echo "wrong result8";

}


}


if($myfeel == "Following"){
$sqly ="SELECT *
FROM  `profiles`
WHERE  `name` = '$user2'";

$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);
if($row){
$dates = $row['date'];
$pimgs = $row['pimg'];
$pimgs = "pimages/".$pimgs;

  if($pimgs == "pimages/1Vitsuji_Aura1496300814.jpg"){
echo "op4";
}
$followings .= "<div style='background-image: url($pimgs)' class='contr'></div>";


}else{
echo "wrong row";
}

}else{
echo "wrong result9";

}
}
 }
}






//End continuous






$notesql = "SELECT * FROM `notification` WHERE `user` = '$username'";

$nnote = mysqli_query($conn,$notesql);
if($nnote){
$notesnum = mysqli_num_rows($nnote);
}



//end


}


if(isset($_POST['chat_loc']) ? $_POST['chat_loc'] : null){
//session_start();

header("location: chat.php");

}//isset chat_loc

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

<title>My profile - Logarithm</title>
<style>
body{margin:0;padding:0;font-family:'Raleway',sans-serif;border:1px solid #d7d7d7;outline:none;overflow-x:hidden;}
h1,h2,h3,h4{
font-weight:100;
font-family:'Josefin Slab',sans-serif;
}
@media screen and (max-width:680px){
#snackbar{
margin-left:10%;
padding:32px;
}
.comments{width:80%;padding:3%;margin:0 auto;padding-left:0;padding-right:0;display:block;}
}

@media screen and (min-width:681px){

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
.wcom input[type=text]{width:50%;}
.com img{display:inline-block;}
.amfol{width:20%;}
.notif{display:inline-block;}
.picc{width:20%;padding:1%;}
.comments{padding:1%;width:14%;}
.mainp input:not(.updesc):not(.comin):not(.comname){width:15%;padding:1%;}
#secin{margin-left:16px;}
.dsxc{width:40%;}
.mains img{height:170px;}
.mains h2, h3{padding:2%;}
.mnav span{padding:1.2%;}
#two input[type=text]{width: 130px;}
#pad5{padding:1%;}
#two{width:50%}
#two input[type=submit]{width:15.2%;padding-top:1%;padding-bottom:1%;}
#two input[type=text]:focus{width:130px;}
.result{margin-left:2.5%;}
.followersshow{position:fixed;}
.followedshow{position:fixed;}
.com{padding:10px;}
}
@media screen and (max-width: 680px){
    .chatback{width:100%;height:200px;}
  .crechatform{top:0;width:100%;height:100%;overflow-y:auto;}
.com{padding:10px;padding-bottom:10%;}
.wcom input[type=text]){width:70%;}
.notif{display:none;}
.comments:first-child{margin-top:20px;}
.picc{padding:3%;margin-top:3%;}
.comments{width:80%;}
.mains img{width:55%;}
.mainp input:not(.updesc):not(.comin):not(.comname){width:80%;padding:3%;}
.dsxc{width:80%;}
#padxs{
padding:6%;
}
#pad5{padding:5%;}
.mains h2{padding:8%;}
#two input[type=text]{height:20px;width:55%}
#two input[type=submit]{padding:3%;}
#two input[type=text]:focus{width:55%;}
.result{margin-left:10%;}
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
/*.side {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    border:1px solid #d7d7d7;
    background-color: #fff;
    overflow-x: hidden;
    transition: 0.5s;
 -webkit-transition:0.5s;
    padding-top: 60px;
    font-family:'Josefin Slab',sans-serif;

}
.mdiv{
width:100%;
margin-bottom:5%;
}
.middle{
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
.side a:not(#news){
    padding: 16px 16px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #d7d7d7;
    display: block;
    transition: 0.3s;

}
#news{text-decoration: none;}
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

.side input:hover{
color:green;
cursor:pointer
}

#naive{    border:1px solid #d7d7d7;}
.side a:first-child{padding-bottom:0;}
.side a:nth-child(2){padding:0;margin:0;}
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
.side img{width:50%;margin-left:25%;border-radius:50%;height:115px; border:1px solid #d7d7d7;}

@media screen and (max-height: 450px) {
  .side {padding-top: 15px;}
  .side a {font-size: 18px;}
}


p{text-align:center;}
.mnav{padding:0;margin:0;border:1px solid #d7d7d7;}
.mnav h1{display:inline-block;margin:0;padding:1.2%;color:#069E2D;}
.mnav span{font-size:30px;cursor:pointer;float:right;}
input {
	outline: none;
}
input[type=text] {
	-webkit-appearance: textfield;
	-webkit-box-sizing: content-box;
	font-family: inherit;
	font-size: 100%;
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
#two input[type=text]:focus {
	background-color: #fff;
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

/*#two input[type=text] {
	width: 15px;
	padding-left: 10px;
	color: transparent;
	cursor: pointer;
}*/

#two input[type=text]{
	padding-left: 32px;
	color: #000;
	background-color: #DFE0E2;
	cursor: auto;
        margin:3%;
        margin-bottom:0;
}
#two input:-moz-placeholder {
	color: transparent;
}
#two input::-webkit-input-placeholder {
	color: transparent;
}
.result{
text-align:center;
position:fixed;
width:150px;
background:#fff;
}
.result p:hover{cursor:pointer;background:#d3d3d3;}
.result p{border:1px solid #d7d7d7;padding:10%;margin:0;}*/

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
input#cfile {
    display: none;
}
.custom-file-upload {
    display: inline-block;
    cursor: pointer;
    width:100%;
    height: 100%;
    text-align: center;
}
.custom-file-upload img{
  border-radius: 50%;
}
.mains{
width:100%;
background:#663399;
text-align:center;
}
.mains img{
border-radius:50%;
margin:0 auto;
margin-bottom:1%;
display:block;
}
.mains img:hover{box-shadow: 0px 0px 10px black;}

.mains h2{font-size:30px;}
.mains h2,h4,h5{
color:#fff;
font-family:'Josefin Slab',sans-serif;
margin:0;
display: block;
}
.mainp{
text-align:center;
}
.mainp input:not(.updesc):not(.comin):not(.comname){
font-size:20px;
font-family:'Raleway',sans-serif;
background:#399E5A;
color:#fff;
outline:none;
font-weight:100;
margin-bottom:20px;
border:none;
}
.mainp input:hover{
cursor:pointer;
}
#secf{
margin:2%;
}
.dsxc{
margin:0 auto;
text-align:center;
font-family:'Raleway',sans-serif;
}
.dsxc p{
padding-bottom:3%;
border-bottom:1px solid #d7d7d7;
}

#plscover{
object-fit: cover;
  width: 300px;
  height: 200px;
margin-top:2.5%
}
.pcontent{
width:60%;
margin:0 auto;
margin-top:3%;

}
.am{border:1px solid #d3d3d3;}
.amfol{
display:inline-block;
}
.descchan{
display:block;
outline: none;
  resize: none;
  border:1px solid #d3d3d3;
  overflow: auto;
  border-radius:1px;
  font-size:16px;
  width:60%;
  height:150px;
  padding:2%;
margin:0 auto;
font-family:'Raleway',sans-serif;
}
#ed{
color:blue;
cursor:pointer;
}
.changed{
display:none;
width:100%;
}
.closedesced{
text-align:right;
font-size:40px;
margin:0;
margin-right:14%;
padding:0;
}
.closedesced:hover{cursor:pointer;color:#d7d7d7;}
.changed input{
font-size:20px;
font-family:'Raleway',sans-serif;
background:#399E5A;
color:#fff;
padding:1%;
outline:none;
font-weight:100;
margin-bottom:20px;
border:none;
width:30%;
}
.picc{
font-size:20px;
font-family:'Raleway',sans-serif;
background:#399E5A;
color:#fff;
outline:none;
font-weight:100;
margin-bottom:20px;
border:none;
cursor:pointer;
display:none;
}
.comments{
text-align:center;
font-size:20px;
font-family:'Raleway',sans-serif;
background:#399E5A;
color:#fff;
outline:none;
font-weight:100;
margin-bottom:20px;
border:none;
display:inline-block;
}
.comments p{margin:0;}
.comments:hover{cursor:pointer;}

.commentview{

overflow:auto;
width:100%;
height:400px;
background:#fff;
display:none;
position:relative;
overflow-x:hidden;
}
.cviewname{
border:1px solid #d3d3d3;
width:100%;
text-align:center;
color:green;
}
.cviewname p{
font-size:25px;
margin:0;
padding:5px;
letter-spacing:5px;
}
#descy{
 resize: none;
  outline: none;
  overflow: auto;
  width: 60%;
  min-height: 20px;
  max-height: 120px;
  display: block;
  border:none;
  text-align: center;
margin:0 auto;
font-family:'Josefin Slab',sans-serif;
font-weight:100;
font-size:1.5em;
border:1px solid #fff;
overflow-x:hidden;
}
#descy:focus{
border:1px solid #d7d7d7;
}
#descy:hover{
cursor:pointer;
}
.updesc{
padding:2%;
display:none;
font-size:20px;
font-family:'Raleway',sans-serif;
background:#fff;
color:#399E5A;
outline:none;
font-weight:100;
margin-bottom:20px;
border:none;
margin:0 auto;
margin-bottom:10px;
}
.updesc:hover{cursor:pointer;}
.dsxc:focus ~ .updesc{
  display:block;

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
.amfol{border-bottom:1px solid #fff;}
.amfol:hover{cursor:pointer;border-bottom:1px solid #d3d3d3;}

.followersshow{
display:none;

background:#fff;
width:25%;
height:15%;
border:1px solid #d7d7d7;
left:25%;
}

.followedshow{
display:none;
background:#fff;
width:25%;
height:15%;
border:1px solid #d7d7d7;
right:25%;
}

.contr{
width: 20%;
    height: 20%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: 50% 50%;
    margin-top:5%;
    display:inline-block;
}

#hmanymore{
color:blue;
}

.notif{
width:5%;
height:15px;
border-radius:50%;
background:red;
color:#fff;

}
#monster{
display:inline-block;
width:10
}
.amfol a{
text-decoration:none;
color:black;
}

.wcom{
z-index:2;
border:1px solid #d7d7d7;
//position:absolute;
//bottom:0;
width:100%;
height:80px;
  display: flex;
display: -webkit-flex;
   justify-content: center;
   //align-items:center;
-webkit-align-items: center;
  -webkit-flex-direction: row ;
-webkit-justify-content: space-around;
}

.wcom input[type=text]{
height:50%;
border-radius:15px;
outline:none;
border:none;
border:1px solid #d7d7d7;
padding-left:15px;
}
.wcom input[type=text]:focus{
border-color: #66CC75;
}

.comstandin{
margin-top:5px;
width:90%;
margin:0 auto;
border:1px solid #fff;
}
.comstandin:hover{
border-top:1px solid #d7d7d7;
border-bottom:1px solid #d7d7d7;
cursor:pointer;
}

.comstandin:hover +#delcom{display:none;}


#delcom:hover{color:red;cursor:pointer;}

.com{
height:40px;
text-align:left;
margin-left:5%;
}
.com img{
border-radius:50%;
width:40px;
height:40px;
border:1px solid #d3d3d3;
}
.comname{
background:none;
color:blue;
text-decoration:underline;
padding:5px;
text-align:left;
     border:none;
     padding:0!important;
     font: inherit;
     /*border is optional*/
     /*border-bottom:1px solid blue; */

}
.contcomv{
display:inline-block;
height:40px;
}
.comcon{padding:2px;}
.comname:hover, .com img:hover{
cursor:pointer;
}
.cominpar{display:none;}
.noircom{z-index:-1;}

//#delcom{display:none;}
#delecom{display:none;}
.comdel{background:none;border:none;}
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
.chatb  h3, h2{display:inline;}

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
.crepost{width:49%;display:inline-block;}
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
<?php
echo $mychat;
 ?>
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


<div id="create" class="modal">

  <form class="modal-content animate" action="post.php" method="post">
    <div class="scontainer">
      <span onclick="document.getElementById('create').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h1>Blog</h1>
    </div>

    <div class="container">
      <input type="text" placeholder="Enter Title" name="utitle" required>

      <textarea name ="textd" placeholder="Content..."></textarea>
      <button type="submit" name="create">Create</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">

    </div>
  </form>
</div>

<div class="mains">
<h2><?php echo $username ?></h2>
<form action="picture.php" method="post" enctype = "multipart/form-data">
<label class="custom-file-upload">


<?php echo "<img src = '$pimg' width='20%' height='150px'>"; ?>


    <input id="cfile" name ="img" type="file"/>
    <input class="picc" type ="submit" value ="Change picture" name="pic">
</label>
</form>
<h4 id="pad5">Since: <?php echo $date; ?></h6>
</div>
<div class="mainp">
<div class="am">
<div class="amfol" ><p id="monster"><a href="notification.php">Followers: <?php echo $followed; ?></a>


</div>

<div class="amfol"  style="margin-left:5%;"><p><a href="notification.php"> Following: <?php echo $following; ?></a>


</div>

</div>

<form id="secf">
<!--<input type="submit" value="My chats">-->
<div class="comments" onclick="open_mychaty()"><p>My chats</p></div>
<div class="comments" id="ccom" onclick="comment();receivecom();" ><p>My comments</p></div>
</form>

<div class="commentview">
<div class="cviewname"><p>Comments</p></div>

<div id="noircom">
<div id="comprint"></div>
</div>



</div>

<div class="cominpar">
<form method="post" id="comform">
<div class="wcom" >
<input maxlength="140" id="comidin" type = "text" class="comin" placeholder="My comment..." name="sendcom" autocapitalize="off" autocorrect="off"/>
</div>
</form>
</div>


<form method="post" style="border-bottom:1px solid #d7d7d7;margin:2%;">
<h2>Description</h2>
<div class="dsxc">
<textarea name="ndesc" onkeyup="auto_grow(this)" onblur="ndescchdel()" id="descy"><?php echo $description; ?></textarea>
<input name="descup" class="updesc" type="submit" value="Change"/>
</div>
</form>

<div class="posts"><p class="post"><i>No posts yet</i></p></div>
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
<input type="file" id="upload" class="custom-file-input" name="chat_back"/>

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

<div class='open_chat'></div>
<div class='open_chat'></div>
<div class='open_chat'></div>

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
echo "  <form id='pstchcr' method='post'>
    <button name='chat_loc' value='$chat_index'>here</button>
    </form>";

echo "</div>";

}
?>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="scripts/chat.js"></script>
<script src="scripts/nav.js"></script>
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

<!--Chat-->


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

if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("comprint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST","backend/receivecom.php",true);
        xmlhttp.open("POST","backend/receivecom.php",true);
        xmlhttp.send();




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

$("#cfile").click(function(){
$(".picc").fadeIn(1000);
closepicchoose();
});

function closepicchoose(){
setTimeout(function(){
$(".picc").fadeOut(1000);
}, 22000);
}

function closedesced(){
$(".changed").fadeOut(1000);
}

$(".dsxc").click(function(){
$(".updesc").fadeIn();

});

function ndescchdel(){
$(".updesc").fadeOut();
}

function greener(){
$("#two input[type=submit]").css("background","#399E5A");
$("#two input[type=submit]").css("color","#fff");
}


function blacker(){
$("#two input[type=submit]").css("background","#fff");
$("#two input[type=submit]").css("color","black");
}

/*function followers(){
if ($(".followersshow").css("position") == "fixed"){
$(".followersshow").css("display","block");
}
}

function followersx(){

$(".followersshow").css("display","none");

}*/



/*function followed(){
if ($(".followedshow").css("position") == "fixed"){
$(".followedshow").css("display","block");
}

}*/

/*function followedx(){
$(".followedshow").css("display","none");
}*/

//receive func

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
                document.getElementById("comprint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST","backend/receivecom.php",true);
 xmlhttp.open("POST","backend/receivecom.php",true);
 xmlhttp.open("POST","backend/receivecom.php",true);
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
                document.getElementById("comprint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST","backend/receivecom.php",true);
 xmlhttp.open("POST","backend/receivecom.php",true);
 xmlhttp.open("POST","backend/receivecom.php",true);
        xmlhttp.send();


}
//send
$(".comin").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();

if($.post('backend/sendcom.php', $('#comform').serialize())){
document.getElementById("comidin").value = "";
//sent and cleared

    receivecom();


}
}

});

//take
setInterval(function(){ receivecom(); }, 3000);
//delete comment

function deletecom(obj){
$(obj).fadeOut();
var id = $(obj).attr('id');
var id= "."+id;

if($.post('backend/delcom.php', $(id).serialize())){

 receivecom();
}

/*if($.post('delcom.php', $('#melcom').serialize())){

 receivecom();
}*/



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

$("#chat_loc").on("click",function() {
  $(this).submit();

});

function comment() {

         $(".cominpar").fadeToggle(150);
        $( ".commentview" ).slideToggle( 300, function() {


        });



}

function close_chatn() {
        $(".chatbool").hide();
}
</script>

</body>
</html>
