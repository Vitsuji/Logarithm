<?php 
session_start();
include 'dbconnect.php';


$target = $_SESSION['target'];
$username = $_SESSION['username'];
$_SESSION['targetcom'] = $target;

if($target === null){
header("location:mypage.php");
}else{
if($target == $username){
header("location:mypage.php");
}else{
$sql ="SELECT * 
FROM  `id1251041_udata`.`profiles` 
WHERE  `name` LIKE '$target'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if($row){
$date = $row['date'];
$pimg = $row['pimg'];
$pimg = "pimages/".$pimg;
$description = $row['description'];

}else{
header("location:nfound.php");
}
//end 

$sqly ="SELECT * 
FROM  `id1251041_udata`.`profiles` 
WHERE  `name` ='$username'";

$sqres = mysqli_query($conn,$sqly);
$sqrow = mysqli_fetch_assoc($sqres);
if($sqrow){
$myimg = $sqrow['pimg'];
$myimg = "pimages/".$myimg;
}


//end
$sqll = "SELECT * FROM `id1251041_udata`.`relationship` WHERE  (`user1` = '$target' AND `user2` = '$username' ) OR (`user2` = '$target' AND `user1` = '$username')";

$consqll = mysqli_query($conn,$sqll);
if($consqll){
$num_rows = mysqli_num_rows($consqll);
if($num_rows == 0){
$felly = "Follow";
}else{
$rowses = mysqli_fetch_assoc($consqll);

if($rowses['user1'] == $username){

$userrel = $rowses['user1rel'];
$targrel = $rowses['user2rel']; 

if($userrel == "Following" && $targrel == "Not Following"){
$felly = "Following";
}else if($userrel == "Following" && $targrel == "Following"){
$felly = "Friends";
}else if($userrel =="Not Following" && $targrel == "Following"){
$felly = "Followed";
}else{
$felly = "Follow";
}

}else{

$userrel = $rowses['user2rel'];
$targrel = $rowses['user1rel']; 

if($userrel == "Following" && $targrel == "Not Following"){
$felly = "Following";
}else if($userrel == "Following" && $targrel == "Following"){
$felly = "Friends";
}else if($userrel == "Not Following" && $targrel =="Following"){
$felly = "Followed";
}else{
$felly = "Follow";
}

}
}



}

if(isset($_POST['tidsubm']) ? $_POST['tidsubm'] : null){
$_SESSION['target'] = $_POST['target'];
header("location: target.php");
}
if(isset($_POST['logout']) ? $_POST['logout'] : null){
session_destroy();
header("location: http://beta002.site88.net");
}

if(isset($_POST['follow']) ? $_POST['follow'] : null){

$sqlsearc = "SELECT * FROM `id1251041_udata`.`relationship` WHERE  (`user1` = '$target' AND `user2` = '$username') OR (`user2` = '$target' AND `user1` = '$username')";

$searchres = mysqli_query($conn,$sqlsearc);

if($searchres){

$num = mysqli_num_rows($searchres);
if($num == 0){
$follow = "Following";
$nfollow = "Not Following";
$screate = "INSERT INTO  `id1251041_udata`.`relationship` (
`user1` ,
`user2` ,
`user1rel` ,
`user2rel`
)
VALUES (
'$username', '$target', '$follow', '$nfollow'
)";

$cres = mysqli_query($conn,$screate);
if($cres){
$notif = "INSERT INTO  `id1251041_udata`.`notification` (
`user` ,
`target` ,
`msg`
)
VALUES (
'$target', '$username', 'Follow'
)";
$note  = mysqli_query($notif);
if(!$note){echo "rain";}
header("location: target.php");

}else{echo "No";}

}else{



$rowse = mysqli_fetch_assoc($searchres);

if($rowse['user1'] == $username){

if($rowse['user1rel'] == "Not Following"){
$update = "UPDATE  `id1251041_udata`.`relationship` SET  `user1rel` =  'Following' WHERE  `relationship`.`user1` = '$username'";

$updateq = mysqli_query($conn,$update);
if($updateq){
$notif = "INSERT INTO  `id1251041_udata`.`notification` (
`user` ,
`target` ,
`msg`
)
VALUES (
'$target', '$username', 'Follow'
)";
$note  = mysqli_query($conn,$notif);
header("location:target.php");
}else{header("location:mypage.php");}


}else{
$update = "UPDATE  `id1251041_udata`.`relationship` SET  `user1rel` =  'Not Following' WHERE  `relationship`.`user1` = '$username'";

$updateq = mysqli_query($conn,$update);
if($updateq){

header("location:target.php");

}else{header("location:mypage.php");}
}


}else{
//if user is user2
if($rowse['user2rel'] == "Not Following"){
$update = "UPDATE  `id1251041_udata`.`relationship` SET  `user2rel` =  'Following' WHERE  `relationship`.`user2` = '$username'";

$updateq = mysqli_query($conn,$update);
if($updateq){
header("location:target.php");
$notif = "INSERT INTO  `id1251041_udata`.`notification` (
`user` ,
`target` ,
`msg`
)
VALUES (
'$target', '$username', 'Follow'
)";
$note  = mysqli_query($conn,$notif);
}else{header("location:mypage.php");}


}else{
$update = "UPDATE  `id1251041_udata`.`relationship` SET  `user2rel` =  'Not Following' WHERE  `relationship`.`user2` = '$username'";

$updateq = mysqli_query($conn,$update);
if($updateq){
$notif = "UPDATE  `id1251041_udata`.`notification` SET  `user2rel` =  'Not Following' WHERE  `relationship`.`user2` = '$username'";

header("location:target.php");
}else{header("location:mypage.php");}
}
}

}




}


}


}



//Followers and Following
$sqll = "SELECT * FROM `id1251041_udata`.`relationship` WHERE  (`user1` = '$target') OR (`user2` = '$target')";
$sqllres = mysqli_query($conn,$sqll);
if($sqllres){

$rowfol = mysqli_fetch_array($sqllres);
$num_rows = mysqli_num_rows($sqllres);

$following = 0;
$followed = 0;

$us1 = $rowfol['user1'];

 if($us1 == $target){

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
    if($u1 == $target){

    $feel = $collections['user1rel'];

    if($feel == "Following"){$following++;}

    $exfeel = $collections['user2rel'];

    if($exfeel == "Following"){$followed++;}

}else{
    $feel = $collections['user2rel'];

    if($feel == "Following"){$following++;}

    $efxfeel = $collections['user1rel'];

    if($exfeel == "Following"){$followed++;}
}
}



//Display followers and following

$sqlll = "SELECT * FROM `id1251041_udata`.`relationship` WHERE  (`user1` = '$target') OR (`user2` = '$target')";
$sqlllres = mysqli_query($conn,$sqlll);
 
$rowfoll = mysqli_fetch_array($sqlllres);
$num_rowss = mysqli_num_rows($sqlllres);
 

$fol_num = 0;
$fold_num = 0;
 
$followings = "";
$followers = "";
 
$user1 = $rowfoll['user1'];
 $user2 = $rowfoll['user2'];
if($user1 != $target){
$opfeel = $rowfoll['user1rel'];
$myfeel = $rowfoll['user2rel'];
$user2 = $rowfoll['user2'];
if($opfeel == "Following"){
$sqly ="SELECT *
FROM  `id1251041_udata`.`profiles`
WHERE  `name` = '$user1'";
 
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
FROM  `id1251041_udata`.`profiles`
WHERE  `name` = '$user1'";
 
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
FROM  `id1251041_udata`.`profiles`
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
echo "wrong row".mysqli_error($row);
}
 
}else{
echo "wrong result4";
 
}
 
 
}
 
 
if($myfeel == "Following"){
$sqly ="SELECT *
FROM  `id1251041_udata`.`profiles`
WHERE  `name` = '$user2'";
 
$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);
 
if($row){
$dates = $row['date'];
$pimgs = $row['pimg'];

$pimgss = "pimages/".$pimgs;


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
if($user1 != target){
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
FROM  `id1251041_udata`.`profiles`
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
FROM  `id1251041_udata`.`profiles`
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
FROM  `id1251041_udata`.`profiles`
WHERE  `name` = '$user2'";

$resulty = mysqli_query($conn,$sqly);
if($resulty){
$row = mysqli_fetch_assoc($resulty);
if($row){
$dates = $row['date'];
$pimgs = $row['pimg'];
$pimgs = "pimages/".$pimgs;


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
$notesql = "SELECT * FROM `id1251041_udata`.`notification` WHERE `user` = '$username'";

$nnote = mysqli_query($conn,$notesql);
if($nnote){
$notesnum = mysqli_num_rows($nnote);
}




}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Raleway" rel="stylesheet">
<title><?php echo $target; ?> - Logarithm</title>
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
.com{padding:10px;}
.wcom input[type=text]{width:50%;}
.picc{width:20%;padding:1%;}
.comments{padding:1%;width:14%;}
#snackbar{left:20%;padding: 16px;}
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
}
@media screen and (max-width: 680px){
.wcom input[type=text]){width:70%;}
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
 -webkit-transition: 0.5s;
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

.side input:hover{
color:green;
cursor:pointer;
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
.mains h2,h3,h4,h5{
color:#fff;
font-family:'Josefin Slab',sans-serif;
margin:0;
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
width:100%;
height:400px;
background:#fff;
display:none;
}
.cviewname{
border:1px solid #d3d3d3;
width:100%;
text-align:center;
color:green;
}
.cviewname p{
font-size:20px;
margin:0;
padding:5px;
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

.followedshow{
display:none;
position:fixed;
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
.followersshow{
display:none;
position:fixed;
background:#fff;
width:25%;
height:15%;
border:1px solid #d7d7d7;
left:25%;
}

#lg{
-webkit-appearance:none;
-webkit-border-radius:6px;
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
#delcom{display:none;}
</style>

</head>
<body>
<div id="Sidenav" class="side">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="mypage.php"><img src="<?php echo $myimg; ?>">
  <p><?php echo $username;  ?></p>
</a>
  <div class="mdiv">
  <div class="middle" onclick="news()"><p>News</p></div>
  <div class="middle" onclick="document.getElementById('create').style.display='block'"><p>Create</p></div>
  <div class="middle"><p>Chats</p></div>
  </div>
  <a id="naive" href="#">Settings</a> 
  <form method="post" action="mypage.php" style="padding:16px 16px 8px 32px;border:1px solid #d7d7d7;">
  <input id="lg" name="logout" type= "submit" value="Log Out">
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
<h2><?php echo $target ?></h2>


<?php echo "<img src = '$pimg' width='20%' height='150px'>"; ?>


<h4 id="pad5">Since: <?php echo $date; ?></h6>
</div>
<div class="mainp">
<div class="am">
<div class="amfol" onmouseover="followers()" onmouseout="followersx()"><p>Followers: <?php echo $followed; ?>

<div class="followersshow"><?php echo $followers; ?>
<?php
if($followed == 0){
echo "<p>Followed by no one.</p>";
}else{
if($notesnum > 0){
echo "<a href='notification.php' style='text-decoration:none;'><p id='hmanymore'>More($followed)</p></a>";
}else{
echo "<a href='notification.php' style='text-decoration:none;'><p id='hmanymore'>More</p></a>";
}

}
 ?>
</div></div>

<div class="amfol" onmouseover="followed()" onmouseout="followedx()" style="margin-left:20%;"><p>Following: <?php echo $following; ?>
<div class="followedshow"><?php echo $followings; ?>
<?php
if($following == 0){
echo "<p>Following no one.</p>";
}else{

if($notesnum == 0){
echo "<a href='notification.php' style='text-decoration:none;'><p id='hmanymore'>More</p></a>";
}else{
echo "<a href='notification.php' style='text-decoration:none;'><p id='hmanymore'>More($notesnum)</p></a>";
}
}
?>

</div>
</div>

<form id="secf" action="target.php" method="post">
<!--<input type="submit" value="My chats">-->
<div class="comments"><p>Start chat</p></div>
<div class="comments" id="ccom" onclick="comment();receivecom();" ><p>Comments</p></div>
<!--<div class="comments"><p>Follow</p></div>-->

<input class="comments" type="submit" value="<?php echo $felly; ?>" name="follow">

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

<div class="demidesc">
<h2>Description</h2>
<div class="dsxc">
<p><?php echo $description; ?></p>
</div>
</div>

<div class="posts"><p class="post"><i>No posts yet</i></p></div>
</div>
</div>


<script>
$jjo = "zero";
$jjj = "orez";
function comment(){
if($jjo == "abc"){
$(".commentview").slideUp();
$(".cominpar").slideUp();

$jjo =" ";
}else{
$(".commentview").slideDown();
$(".cominpar").slideDown();

$jjo = "abc";
}
}

function openNav() {
    if($jjj == "acd"){
document.getElementById("Sidenav").style.width= "0";
$jjj = "orez";
}else{
    if ($(".mains img").css("height") > "169px"){
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


function followers(){
$(".followersshow").css("display","block");
}

function followersx(){
$(".followersshow").css("display","none");
}



function followed(){
$(".followedshow").css("display","block");
}

function followedx(){
$(".followedshow").css("display","none");
}

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
        xmlhttp.open("POST","receivecom.php",true);
 xmlhttp.open("POST","receivecom.php",true);
 xmlhttp.open("POST","receivecom.php",true);
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
        xmlhttp.open("POST","receivecom.php",true);
 xmlhttp.open("POST","receivecom.php",true);
 xmlhttp.open("POST","receivecom.php",true);
        xmlhttp.send();


}
//send
$(".comin").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
       
if($.post('sendcom.php', $('#comform').serialize())){
document.getElementById("comidin").value = "";
//sent and cleared

    receivecom();
        

}
}
});

//take
</script>

</body>
</html>