<?php 
session_start();
include 'dbconnect.php';

$username = $_SESSION['username'];
$email = $_SESSION['email'];

if($username == Null || $email == Null){
header("location:http://beta002.site88.net");
}else{
$notesql = "SELECT * FROM `id1251041_udata`.`notification` WHERE `user` = '$username' AND `msg` ='Follow' ";
$notesres = mysqli_query($conn, $notesql);
if($notesres){
$notesnum = mysqli_num_rows($notesres);
if($notesnum == 1){
$notesrow = mysqli_fetch_array($notesres);
$notesarr = array($notesrow['target']);
}else{

$notesrow = mysqli_fetch_array($notesres);
$notesarr = array($notesrow['target']);

while($collections = mysqli_fetch_array($notesres)) {
array_push($notesarr,$collections['target']);


}
}//end if not one note


}else{
echo "nine";
}
//END NOTESQL



$sql ="SELECT * 
FROM  `id1251041_udata`.`profiles` 
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

//Start real
$sqll = "SELECT * FROM `id1251041_udata`.`relationship` WHERE  (`user1` = '$username') OR (`user2` = '$username')";
$sqllres = mysqli_query($conn,$sqll);
if($sqllres){

$rowfol = mysqli_fetch_array($sqllres);
$num_rows = mysqli_num_rows($sqllres);


$followed = 0;

$us1 = $rowfol['user1'];

if($num_rows == 1){

 if($us1 == $username){


    $exfeels = $rowfol['user2rel'];

    if($exfeels == "Following"){$followed++;}

}else{

    $exfeels = $rowfol['user1rel'];

    if($exfeels == "Following"){$followed++;}
}
}else{


 if($us1 == $username){



    $exfeels = $rowfol['user2rel'];

    if($exfeels == "Following"){$followed++;}

}else{


    $exfeels = $rowfol['user1rel'];

    if($exfeels == "Following"){$followed++;}
}


while($collections = mysqli_fetch_array($sqllres)) {
    $u1 = $collections['user1'];
    if($u1 == $username){

    $exfeel = $collections['user2rel'];

    if($exfeel == "Following"){$followed++;}

}else{

    $exfeel = $collections['user1rel'];

    if($exfeel == "Following"){$followed++;}
}

}

}



//END Follow 

//START ECHO FOLLOWERS

$sqlll = "SELECT * FROM `id1251041_udata`.`relationship` WHERE  (`user1` = '$username') OR (`user2` = '$username')";
$sqlllres = mysqli_query($conn,$sqlll);
 
$rowfoll = mysqli_fetch_array($sqlllres);
$num_rowss = mysqli_num_rows($sqlllres);
 

$fol_num = 0;
$fold_num = 0;
 
$followers = "";
 
$user1 = $rowfoll['user1'];
 $user2 = $rowfoll['user2'];
if($user1 != $username){
$opfeel = $rowfoll['user1rel'];
$myfeel = $rowfoll['user2rel'];
$user2 = $rowfoll['user2'];
if($opfeel == "Following"){
$sqly ="SELECT *
FROM  `id1251041_udata`.`profiles`
WHERE  `name` LIKE '$user1'";
 
$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);
 
if($row){

$pimgs = $row['pimg'];
$pimgs = "pimages/".$pimgs;
$ro = 0;

foreach($notesarr as $text){
if($text == $user1){
$ro .=1;
}
 }

if($ro == 0){
$followers .= "<div class='nig'><img class='nigpic' src='$pimgs' /><div class='nigtext'><p>$user1 is now following you</p></div></div>";
}else{
$followers .= "<div class='nig' style='background:#E8CC89;'><img class='nigpic' src='$pimgs' /><div class='nigtext'><p>$user1 is now following you</p></div></div>";

}//if 0


}else{
echo "wrong row".mysqli_error($row);
}
 
}else{
echo "wrong result2";
}
 
 
 
}
 
 

 
 
 
 
}else{
$opfeel = $rowfoll['user2rel'];
$myfeel = $rowfoll['user1rel'];
$user2 = $rowfoll['user2'];
 
if($opfeel == "Following"){
$sqly ="SELECT *
FROM  `id1251041_udata`.`profiles`
WHERE  `name` LIKE '$user2'";
 
$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);
 
if($row){
$pimgs = $row['pimg'];
$pimgs = "pimages/".$pimgs;
 
$ro = 0;
foreach($notesarr as $text){
if($user2 == $text){$ro++;}
}
 
if($ro == 0){
$followers .= "<div class='nig'><img class='nigpic' src='$pimgs' /><div class='nigtext'><p>$user2 is now following you</p></div></div>";
}else{
$followers .= "<div class='nig' style='background:#E8CC89;'><img class='nigpic' src='$pimgs' /><div class='nigtext'><p>$user2 is now following you</p></div></div>";
}//if 0


}else{
echo "wrong row".mysqli_error($row);
}
 
}else{
echo "wrong result4";
 
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
FROM  `id1251041_udata`.`profiles`
WHERE  `name` = '$user1'";
 
$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);
 
if($row){
$pimgs = $row['pimg'];
$pimgs = "pimages/".$pimgs;
 
$ro = 0;//xx
foreach($notesarr as $text){
if($user1 == $text){$ro++;}
}
 
if($ro == 0){
$followers .= "<div class='nig'><img class='nigpic' src='$pimgs' /><div class='nigtext'><p>$user1 is now following you</p></div></div>";
}else{
$followers .= "<div class='nig' style='background:#E8CC89;'><img class='nigpic' src='$pimgs' /><div class='nigtext'><p>$user1 is now following you</p></div></div>";

}//if 0
 
 
}else{
echo "wrong row".mysqli_error($row);
}
 
}else{
echo "wrong result6";
}
 
 
 
}
 

 
 
 
 
}else{
$opfeel = $collection['user2rel'];
$myfeel = $collection['user1rel'];
$user2 = $collection['user2'];
 
if($opfeel == "Following"){
$sqly ="SELECT *
FROM  `id1251041_udata`.`profiles`
WHERE  `name` = '$user2'";
 
$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);
 
if($row){
$pimgs = $row['pimg'];
$pimgs = "pimages/".$pimgs;
 
$ro = 0;
foreach($notesarr as $text){
if($user2 == $text){$ro++;}
}
 
if($ro == 0){
$followers .= "<div class='nig'><img class='nigpic' src='$pimgs' /><div class='nigtext'><p>$user2 is now following you</p></div></div>";

}else{
$followers .= "<div class='nig' style='background:#E8CC89;'><img class='nigpic' src='$pimgs' /><div class='nigtext'><p>$user2 is now following you</p></div></div>";

}//if 0
 
}else{
echo "wrong row";
}
 
}else{
echo "wrong result8";
 
}
//END RESULT FOLLOWERS

$delnot = "DELETE FROM "; 



 
}
 
 
 }
}
 





//End continuous
























}else{
echo "wrong row".mysqli_error($row);
}

}else{
echo "wrong result1";
}
//End Result of user

$delnotes = "DELETE FROM `id1251041_udata`.`notification` WHERE `user` = '$username'";
$delnres = mysqli_query($conn, $delnotes);



}


}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Raleway" rel="stylesheet">
<title><?php echo $username; ?> Notifications - Logarithm</title>
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

@media screen and (min-width:680px){
.picc{width:20%;padding:1%;}
.comments{padding:1%;width:14%;}
#snackbar{left:20%;padding: 16px;}
.mainp input:not(.updesc){width:15%;padding:1%;}
#secin{margin-left:16px;}
.dsxc{width:40%;}
.mains h2, h3{padding:2%;}
.mnav span{padding:1.2%;}
#two input[type=text]{width: 130px;}
#pad5{padding:1%;}
#two{width:50%}
#two input[type=submit]{width:15.2%;padding-top:1%;padding-bottom:1%;}
#two input[type=text]:focus{width:130px;}
.result{margin-left:2.5%;}
.mitem{ width: 60%;}
.mitems{width:40%;}
.nig{height:40px;}
}
@media screen and (max-width: 680px){
.mitem{ width: 100%;}
.mitems{width:0;display:none;}
#padxs{
padding:6%;
}
#pad5{padding:5%;}
.mains h2{padding:8%;}

.mnav span{padding:6%;padding-top:3%;}
#two input[type=text]{height:20px;width:55%}
#two input[type=submit]{padding:3%;}
#two input[type=text]:focus{width:55%;}
#two{width:100%;}
.result{margin-left:10%;}
}
@media screen and (min-width:1250px){
.mains img{height:220px;}
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
 -webkit-transition: w0.5s;
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
.side a{
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
.result p{border:1px solid #d7d7d7;padding:10%;margin:0;}

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
input[type="file"] {
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

.mains h2{font-size:30px;}
.mains h1,h2,h3,h4,h5{
color:#fff;
font-family:'Josefin Slab',sans-serif;
margin:0;
}
.mainp{
text-align:center;
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

.mode{
 display: -webkit-flex;
    display: flex;
    width: 100%;
    height: 100%;


}
.mitem{

    height: 100%;
    margin: 0;
border:1px solid #d7d7d7;

}

.mitems{

    height: 100%;
    margin: 0;
border:1px solid #d7d7d7;
}

.nig{
display:flex;
flex-direction:row;
padding:5px;
border:1px solid #d7d7d7;

}
.nigpic{
border-radius:50%;
width:40px;
height:40px;
margin:1px;
margin-left:10px;
}
.nigtext{
flex-grow:1;
text-align:left;

}
.nigtext p{
margin:0;
padding:0;
text-align:left;
margin-top:10px;
margin-left:25px;
}
</style>

</head>
<body>
<div onblur="alert('hi')" id="Sidenav" class="side">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="mypage.php"><img src="<?php echo $pimg; ?>">
  <p><?php echo $username;  ?></p>
</a>
  <div class="mdiv">
  <div class="middle" onclick="news()"><p>News</p></div>
  <div class="middle" onclick="document.getElementById('create').style.display='block'"><p>Create</p></div>
  <div class="middle"><p>Chats</p></div>
  </div>
  <a id="naive" href="#">Settings</a> 
  <form method="post" action="mypage.php" style="padding:16px 16px 8px 32px;border:1px solid #d7d7d7;">
  <input name="logout" type= "submit" value="Log Out">
</form>
</div>

<div class="mnav">
<span onclick="openNav()">&#9776;</span>
<h1 id="padxs">Logarithm</h1>
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
<h2 style="padding-bottom:0;">Followers:</h2>
<h1 ><?php echo $followed; ?></h1>
</div>

<div class="mode">
<div class="mitems">asdasd</div>
<div class="mitem">
<?php
if($followed == 0){
echo "<p style='text-align:center'>No followers yet</p>";
}else{
echo $followers;
}
?>
</div>
</div>



<script>
$jjo = "zero";
$jjj = "orez";
function comment(){
if($jjo == "abc"){
$(".commentview").slideUp();
$jjo =" ";
}else{
$(".commentview").slideDown();
$jjo = "abc";
}
}

function openNav() {
    if($jjj == "acd"){
document.getElementById("Sidenav").style.width= "0";
$jjj = "orez";
}else{
    if ($(".nig").css("height") == "40px"){
    document.getElementById("Sidenav").style.width= "250px";
    
    }else{
    document.getElementById("Sidenav").style.width = "100%";
    }
    $jjj = "acd";
}
}

function closeNav() {
    document.getElementById("Sidenav").style.width = "0";
}
function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}

</script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
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
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
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



</script>

</body>
</html>