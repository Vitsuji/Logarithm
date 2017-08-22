<?php
include 'dbconnect.php';

if(isset($_POST['btn']) ? $_POST['btn'] : null){
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $username = mysqli_real_escape_string($conn, $username);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);
$password = hash('ripemd160',sha1(sha1(md5(md5(sha1(md5($password)))))));
$username = strip_tags($username);
$cvar = md5($username.rand(1,100));

$sql = "INSERT INTO  `userd` (
`id` ,
`username` ,
`email` ,
`password` ,
`ip` ,
`evar`,
`cpassc`
)
VALUES (
NULL ,  '$username',  '$email',  '$password',  '$ip' , '$cvar','None'
)";

$result = mysqli_query($conn,$sql);
if($result){

 $to = $email;
$subject = "Logarithm Email Varify";

$message = "
<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Josefin+Slab' rel='stylesheet'>
<meta name='viewport' content='width=device-width, initial-scale=1'/>
<style>
body{font-family:'Raleway',sans-serif;}
.topn{
margin:0;
padding:0;
width:100%;
float:left;
font-family:'Josefin Slab',sans-serif;
border:1px solid #d7d7d7;
color:#069E2D;
margin-bottom:5%;
background:#fff;
}
.topn h1{
margin-left:5%;
}
.maine{
padding-bottom:5%;
width:100%;
background:#663399;
color:white;
text-align:center;
font-family:'Josefin Slab', sans-serif;
}
.main p{
margin-left:15%;
line-height:1.5;
}
.confirm{
color:#fff;
background:#069E2D;
text-align:center;
width:30%;
margin:0 auto;
}
.confirm h3{
padding:3%;
margin-top:10%;
margin-bottom:10%;
color:#fff;
}
.confirm a{color:white;}
a{text-decoration:none;color:#fff;}
.main{width:100%;border:1px solid #d7d7d7;border-top:none;}

.end{
position:relative;
padding-top:2%;
line-height:1.5;
font-size:12px;
color:#767676;
border-top:1px solid #d7d7d7;
width:100%;
height:50px;
}
#insend{
float:left;
margin-bottom:1.5%;
margin-left:5%;
}
.end a{
text-decoration:none;
color:blue;
}
end a:hover{
text-decoration:underline;
}
#insendpl{
margin-left:20px;
margin-bottom:1.5%;
float:left;
color:#4078c0;
}
#insendpr{
margin-bottom:1.5%;
float:right;
color:#4078c0;
}

@media screen and (max-width:680px) {
.confirm{width:80%;}
.end p{display:none;}
.end p:first-child{display:inline-block;}
.end p:last-child{display:inline-block;}
#insendpr{margin-right:6%;}
}
@media screen and (min-width:680px) {
.endd{display:none;}
#insendpr{margin:0;padding:1%;}
}
</style>
</head>
<body>
<div class='topn'><h1>Logarithm</h1></div>
<div class='maine'><h2>Email Validation</h2></div>

<div class='main'>
<p>Hi $username,</p>
<p>Thanks for joining us</p>
<p>Your key for confirming email is $cvar</p>
<p>Please confirm your email to further use Logarithm</p>
<div class='confirm'><h3><a href='confirmed.php'>Confirm Email</a></h3></div>


<div class='end'>
<p id='insend'>&copy; Logarithm,Inc.</p>
<p id='insendpl'><a href='t&s.html'>Terms & Service </a></p>
<p id='insendpl'><a href='pr&sec.html'>Privacy & Security</a></p>
<p id='insendpl'><a href='faq.html'>FAQ</a></p>

<p id='insendpr'><a href='signup.php'>Sign Up</a></p>
<p id='insendpr'><a href='signin.php'>Sign In</a></p>
<p id='insendpr'><a href='contact.html'>Contact</a></p>
<p id='insendpr'><a href='bout.html'>About</a></p>
<p id='insendpr'><a href=''>Home</a></p>

</div>

</div>
</body>
</html>


";


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <logarithm@logarithm.com>' . "\r\n";

if(mail($to,$subject,$message,$headers)){




}else{
$a .= "fail";
}
session_start();
   $_SESSION['username']= $username;
   $_SESSION['email']= $email;
 header("location:home/pcreate.php");
}else{
$a .= "Can not use the same email. Username could be already taken";
}

}
}
?>



<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="description" content="Logarithm - the developers' corner"/>
<meta name="author" content="Vitsuji Aura"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Raleway" rel="stylesheet">
<title>Logarithm Sign Up</title>
<style>

body{
overflow-x:hidden;
font-family:'Raleway',sans-serif;
text-align:center;
margin:0;
padding:0;
}
h1,h2,h3,h4{
font-weight:100;
}
@media screen and (max-width:680px){
#snackbar{
margin-left:10%;
padding:32px;
}
}

@media screen and (min-width:680px){
#snackbar{left:20%;padding: 16px;}
}
#snackbar {
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

ul.topnav {
  list-style-type: none;
  margin: 0;
  //padding: 0;
  overflow: hidden;
  border-bottom:1px #d7d7d7 solid;
  //height:60px;


}

ul.topnav li {
float: right;
vertical-align:middle;
}
ul.topnav li:first-child {
float: left;
vertical-align:middle;
}

ul.topnav li a {
  display: inline-block;
  //color: #f2f2f2;
    color:#8B8989;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  transition: 0.3s;
  font-size: 22px;
  font-family:'Josefin Slab',sans-serif;
}

ul.topnav li a:hover {color: green;border-bottom:1px solid #d7d7d7;}

ul.topnav li.icon {display: none;}

@media screen and (max-width:680px) {
   .end{display:none;}
  ul.topnav li:not(:first-child){display: none;}
  ul.topnav li.icon {
    float: right;
    display: inline-block;
  }
  #firstx{border-top:1px solid #d3d3d3;}
  .maininput{width:80%;margin-left:10%;}
  .btn-style{width:80%;}
  .examples{height:1000px;}
}
@media screen and (min-width:680px){
ul.topnav li a{border:none;}
.maininput{width:35%; margin-left:32.5%;}
.btn-style{width:35%;}
}
@media screen and (min-width:620px){
.ex{width:27%;margin:1%;}
.examples{height:300px;}
}


  ul.topnav.responsive li:not(:first-child) {
    float: none;
    display: inline;
  }
  ul.topnav.responsive li a {
    display: block;
    text-align: left;
    font-family:'Josefin Slab',sans-serif;
  }

  ul.topnav.responsive li:nth-child(2){
//margin-left:25%;
}
/*ul.topnav.responsive.pp{
display:block;
}
ul.topnav.pp{
display:none;
}*/



li{
  list-style:none;

}
a{
  text-decoration:none;

}
/*ul{
  display:flex;
  flex-direction:row;
  flex-wrap:wrap;
}*/


.mainm{
flex-grow:1;
width:100;
}
.mainm{
background:#663399;
color:#fff;
width:100%;
}
.mainm h1{
font-family:'Josefin Slab';
margin:0;
padding:60px 16px;
}



.menu{
width:35px;
height:5px;
background-color:black;
margin:6px 0;

}

#z{
width:60%;
margin:0 auto;
line-height:1.5;
letter-spacing:2.5px;
}
.enc{
width:60%;
margin:0 auto;
border-bottom:1px solid #d3d3d3;
}




.maininput {
	border: none;
	border-radius: 10px;
	outline: none;
	padding: 10px;
	font-family: Raleway;
	font-size: 1em;
	color: #676767;
	transition: border 0.5s;
	-webkit-transition: border 0.5s;
	-moz-transition: border 0.5s;
	-o-transition: border 0.5s;
        border:1px solid #d7d7d7;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	box-sizing:border-box;
        display:block;

}
input{
     transition: border 0.5s;
	margin-top:7px;
-webkit-transition: border 0.5s;
	-moz-transition: border 0.5s;
	-o-transition: border 0.5s;
}
.maininput:focus{

}

.formgroup{
	width: 100%;
        margin-top:7px;
       // margin:0 auto;
}

.btn-style{
        -webkit-appearance: none;
  -webkit-border-radius: 6px;
        border:none;
	border-radius : 6px;
	font-size : 20px;
	padding : 10px 20px;
	background-color :#069E2D;
        color:#fff;
        transition: border 0.5s;
        outline:none;
        font-family:'Raleway', sans-serif;

}
.btn-style:hover{
cursor:pointer;
}
#mainentry{
//text-shadow: 2px 2px black;
}


.examples{
width:100%;

display:flex;
flex-direction:row;
flex-wrap:wrap;
}
.ex{
flex-grow:1;
//width:27%;
//margin:1%;
padding:1%;
border:1px solid #d3d3d3;
line-height:1.5;
}
.ex h2{margin:0;}
.end{
position:relative;
margin-top:2%;
padding-top:2%;
line-height:1.5;
font-size:12px;
color:#767676;
border:1px solid #d7d7d7;
border-right:none;
width:100%;
height:50px;
}
#insend{
float:left;
margin-bottom:1.5%;
margin-left:5%;
}
.end a{
text-decoration:none;
color:blue;
}
end a:hover{
text-decoration:underline;
}
#insendpl{
margin-left:20px;
margin-bottom:1.5%;
float:left;
color:#4078c0;
}
#insendpr{
margin-right:20px;
margin-bottom:1.5%;
float:right;
color:#4078c0;
}
</style>
</head>
<body>

<ul class="topnav" id="myTopnav">

  <li><a class="logot" style="color:green;font-size:30px;font-family:'Josefin Slab', sans-serif;border:none;" href="#webpage">Logarithm</a></li>

    <li class="icon">
    <a class="btntitle" href="javascript:void(0);" style="font-size:30px;border:none;" onclick="openNav()"><i style="margin-left:20%;"class="material-icons">menu</i></a>
  </li>
  <li><a href="signup.php" id="firstx">Sign Up</a></li>
  <li><a href="signin.php">Sign In</a></li>
  <li><a href="bout.html">About</a></li>
    <li><a href="Logarithm">Home</a></li>



</ul>


<div class="mainm">
<h1><strong>Logarithm</strong> needs you</h1>
</div>
<div class="upperi"><h3>Join Now</h3></div>



<div class="formgroup" id="name-form">
<div id = "holderm">
<form method="post">
<!--[if IE 8]><h3 style="color:white;text-align:center;">Username</h3><![endif]-->
       <input placeholder="Username"type="text" class="maininput" name="username" required>
<!--[if IE 8]><h3 style="color:white;text-align:center;">Email</h3><![endif]-->
    <input placeholder="Email"type="email" class="maininput"  name="email" required>
<!--[if IE 8]><h3 style="color:white;text-align:center;">Password</h3><![endif]-->
<input placeholder="Password"type="password" class="maininput" name="password" required>
<input style="margin-top:7px;" type="submit" name="btn" class="btn-style" value="Start Developing Now" >
</form>
<p style="color:black;font-family:Arial;font-size:10px;"><i>By signing up you agree to our Terms of Services and Privacy Policy</i></p>
</div>

</div>

<div class="enc">
<h3>Already have an account? Sign in <a href="signin.php">here</a></h3>
</div>
<div id="z">
<h3>Experience and enjoy Logarithm to its fullest. Sign up and communicate with dedicated developers, share your projects and form something new. </h3>
</div>

<div class="examples">
<div class="ex">
<h2>Use it</h2>
<p style="font-size:20px;" >Sign up and get all of the possiblities and services of Logarithm. You will be able to chat post follow, collaborate and ask for advice.</p>
</div>
<div class="ex">
<h2>100% Free</h2>
<p style="font-size:20px;">Logarithm is 100% free and will surely open up new possibilities for developers. You can advertise products, freelance forever and chat with other experienced developers.</p>
</div>
<div class="ex">
<h2>Recover and Change</h2>
<p style="font-size:20px;" >Logarithm has a fast password recovering system. You can change your password anytime, users can change their username on the website and write a bio about themselves.</p>
</div>

<div class="end">
<p id="insend">&copy; Logarithm,Inc.</p>
<p id="insendpl"><a href="t&s.html">Terms & Service </a></p>
<p id="insendpl"><a href="pr&sec.html">Privacy & Security</a></p>
<p id="insendpl"><a href="faq.html">FAQ</a></p>

<p id="insendpr"><a href="signup.php">Sign Up</a></p>
<p id="insendpr"><a href="signin.php">Sign In</a></p>
<p id="insendpr"><a href="contact.html">Contact</a></p>
<p id="insendpr"><a href="bout.html">About</a></p>


</div>
<script>

function openNav() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";

    } else {
        x.className = "topnav";
    }
}

</script>
<script>
var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){
    x.className = x.className.replace("show", "");
    x.style.visibility = "hidden";
    x.style.display = "none";
 }, 4500);

</script>

</body>
</html>
