<?php
include 'dbconnect.php';

if(isset($_POST['btn']) ? $_POST['btn'] : null){
echo $_POST['btn'];
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

$sql = "INSERT INTO  `id1251041_udata`.`userd` (
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

$a ="";
$result = mysqli_query($conn,$sql);

   if(!$result){
   $a .= " Username already taken. Same email can not be used twice ";
   }else{
   $close = mysqli_close($conn);

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
.maindiv{height:100%;}
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
<div class='confirm'><h3><a href='beta002.site88.net/confirmed.php'>Confirm Email</a></h3></div>



<div class='end'>
<p id='insend'>&copy; Logarithm,Inc.</p>
<p id='insendpl'><a href='beta002.site88.net/t&s.html'>Terms & Service </a></p>
<p id='insendpl'><a href='beta002.site88.net/pr&sec.html'>Privacy & Security</a></p>
<p id='insendpl'><a href='beta002.site88.net/faq.html'>FAQ</a></p>

<p id='insendpr'><a href='http://beta002.site88.net/signup.php'>Sign Up</a></p>
<p id='insendpr'><a href='http://beta002.site88.net/signin.php'>Sign In</a></p>
<p id='insendpr'><a href='http://beta002.site88.net/contact.html'>Contact</a></p>
<p id='insendpr'><a href='http://beta002.site88.net/bout.html'>About</a></p>
<p id='insendpr'><a href='http://beta002.site88.net'>Home</a></p>

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
session_start();
   $_SESSION['username']= $username;
   $_SESSION['email']= $email;
   header("location:home/pcreate.php");
}else{
$a .= "fail";

}   
   
}

}

} else {
    $emv = 0;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width" />
<meta name="description" content="The developers' corner"/>
<meta name="author" content="Vitsuji Aura"/>

<title>Logarithm</title>
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style> 

body {
margin:0;
font-family:'Josefin Slab',sans-serif;
text-align:center;
}

/*ul.topnav {
  list-style-type: none;
  margin: 0;
  //padding: 0;
  overflow: hidden;
  border:1px #d7d7d7 solid;
  //height:60px;
  

}
@media screen and (max-width:680px){
.snackbar{
margin-left:10%;
padding:32px;
}
}

@media only screen and (min-width:680px){
.snackbar{left:20%;padding: 16px;}
.maindiv{height:350px;}
.ex p{font-size:20px;}
body{background:blue;}
}
.snackbar {
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

.snackbar.show {
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

ul.topnav li {
float: right;
vertical-align:middle;
font-family: 'Josefin Slab', serif;
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
}

ul.topnav li a:hover {color: green;border-bottom:1px solid #d7d7d7;}

ul.topnav li.icon {display: none;}*/


ul.topnav {
  list-style-type: none;
  margin: 0;
  //padding: 0;
  overflow: hidden;
  border:1px #d7d7d7 solid;
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
}

ul.topnav.responsive li a:not(.logot):hover {color: green;border-bottom:1px solid #d7d7d7;}
ul.topnav li a:hover{color:green;border-bottom:1px solid #d7d7d7;}
ul.topnav li.icon {display: none;}

@media screen and (max-width:680px) {
 
  ul.topnav li:not(:first-child){display: none;}
  ul.topnav li.icon {
    float: right;
    display: inline-block;
  }
  #firstx{border-top:1px solid #d3d3d3;}
}
@media screen and (min-width:680px){
ul.topnav li a{border:none;font-size:22px;}
}


  ul.topnav.responsive li:not(:first-child) {
    float: none;
    display: inline;
  }
  ul.topnav.responsive li a {
    display: block;
    text-align: left;
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


@media screen and (max-width:680px) {
 
  ul.topnav li:not(:first-child){display: none;}
  #mainin{display:none;}
  .formgroup{display:none;}
  .ex:last-child{margin-bottom:2em;padding-bottom:10%;}
  #jlk{padding-bottom:10%;}
.maindiv{height:100%;}
  .end{display:none;}
  ul.topnav li.icon {
    float: right;
    display: inline-block;
  }
  #mainp{width:100%;}
  .ex{width:90%;margin:5%;height:33%;}
}
@media screen and (min-width:680px) {
.maindiv{height:350px;}

 .sidenav a{display:none;}
.mobileintro{display:none;}
.end{display:inline-block;}
#holderm{margin-top:2.2em;}
.btn-stylemob{display:none;}
@media only screen and (max-width: 800px) {
//body{background:red;}
} 
@media only screen and (max-width:1035px){
#holderm{margin-top:5%;margin-bottom:2em;}
#mainstarter{height:35vh;}

}
}

@media screen and (min-width:2000px){
.maininput{width:100%;}
}

@media screen and (max-width:620px){
#mainstarter{background:#81529d}
.btn-stylemob{margin-top:3em;}
#mainstarter{height:100%;}
.maindiv{flex-wrap:wrap; -webkit-flex-wrap: wrap;}
#dbutton{display:none;}
.ins{border-bottom:1px solid #d3d3d3;}
.examples{height:1000px;}
.ex p{font-size:20px;line-height:1.5;}
}

@media screen and (min-width:620px){
.ex{width:27%;margin:1%;}
.examples{height:500px;}
.ex p{font-size:22px;line-height:1.3;}
}

@media screen and (max-width:680px) {
  ul.topnav.responsive{position: relative;}
  ul.topnav.responsive li.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
}
  ul.topnav.responsive li {
    float: none;
    display: inline;
  }
  ul.topnav.responsive li a {
    display: block;
    text-align: left;
  }
   
  .mainfirstd{
   //background-image: url("https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQpoRVaChELvUanUd3YAZO3gO-MkyTInLPY4wTnGkp6cd0--_yx");
   width:100%;
   height:360px;
  }

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #424242;
    overflow-x: hidden;
    transition: 1.0s;
    padding-top: 60px;
}

.sidenav a {
    //padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 35px;
    color: #d7d7d7;
    transition: 1.5s;
    //margin:2.7em;
    padding:24px;
    display:block;
}

.sidenav a:not(:first-child):hover, .offcanvas a:focus{
    color: #f1f1f1;
    border-bottom:1px #d7d7d7 solid;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}
.closebtn{
font-size:24px;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 35px;}
}


.menu{
width:35px;
height:5px;
background-color:black;
margin:6px 0;

}

@media only screen and (min-width: 1250px) {
#deff{width:80%;margin:0 auto;}
}





.maininput {
        width:35%;
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
        border:3px solid rebeccapurple;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	box-sizing:border-box;
        margin-left:32.5%;
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
	border: solid 3px #D7D7D7;	
}

.formgroup{
	width: 100%;
        margin-top:7px;
       // margin:0 auto;
}

.btn-style{
        border:none;
	border-radius : 6px;
	font-size : 20px;
	padding : 10px 20px;
        background-color :#069E2D;
        color:white;
        width:35%;
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



.btn-stylemob{
        border:none;
	border-radius : 6px;
	font-size : 20px;
	padding : 3% 20px;
	background-color :#069E2D;
        width:75%;
        transition: border 0.5s;
        //height:15%;
        outline:none;
        margin-left:7%;
        
}
.btn-stylemob a{
color:#fff;
text-decoration:none;
font-weight:600;
}
.maindiv{
width:100%;
display:flex;
flex-direction:row;
-webkit-flex-direction: row;
display: -webkit-flex;
}

.ins{
flex-grow:1;
height:100%;
padding-bottom:5%;

}

.ins:not(:last-child){
text-align:center;

}

#mainp{
width:65%;
margin-left:20%;
//line-height:200%;
letter-spacing:0.1em;
//font-size:1.15em;
font-size:20px; 
font-family: 'Raleway', sans-serif;
}

#mainp:first-letter{
font-size:1.3em;
}
#dbutton{
background:#069E2D;
height:30px;
margin-left:37.6%;
width:24.8%;
border-radius:4.5px;
padding:0.5em;
}
#dbutton a{
color:#fff;
text-decoration:none;
font-size:1.7em;
}
.examples{
width:100%;

display:flex;
flex-direction:row;
flex-wrap:wrap;
}
.ex{
font-family:'Raleway',sans-serif;
flex-grow:1;
//width:27%;
//margin:1%;
padding:1%;
border:1px solid #d3d3d3;
}
.ex p{margin:0;}
.end{
font-family:'Raleway',sans-serif;
position:relative;
padding-top:2%;
line-height:1.5;
font-size:12px;
color:#767676;
border:1px solid #d7d7d7;
width:98%;
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

<!--<ul class="topnav" id="myTopnav">

  <li><a class="logot" style="color:green;font-size:30px;font-family: sans-serif;" href="#webpage">Logarithm</a></li>
  <li><a class="active" href="http://beta002.site88.net">Home</a></li>
  <li><a href="http://beta002.site88.net/bout.html">About</a></li>
  <li><a href="http://beta002.site88.net/signup.php">Sign Up</a></li>
  <li><a href="http://beta002.site88.net/signin.php">Sign In</a></li>
  <li class="icon">
    <a class="btntitle" href="javascript:void(0);" style="font-size:30px;" onclick="openNav()"><i class="material-icons">menu</i></a>
  </li>
</ul>-->

<ul class="topnav" id="myTopnav">

  <li><a class="logot" style="color:green;font-size:30px;border:none;" href="http://beta002.site88.net">Logarithm</a></li>

    <li class="icon">
    <a class="btntitle" href="javascript:void(0);" style="font-size:30px;" onclick="openNav()"><i style="margin-left:25%;"class="material-icons">menu</i></a>
  </li>

  <li><a href="http://beta002.site88.net/signup.php" id="firstx" >Sign Up</a></li>
  <li><a href="http://beta002.site88.net/signin.php">Sign In</a></li>
  <li><a href="http://beta002.site88.net/bout.html">About</a></li>
  <li><a href="http://beta002.site88.net">Home</a></li>



</ul>





<div id="jlk"style="width:100%;background:#663399;" id="mainstarter">
<div style="padding:5px;color:white;" id="mainentry">
<h1 style="padding-right:5px;margin-bottom:0;">"If something does not exist - create it."</h1>
<p style="float:right;margin:0;margin-right:10%;border:none;">- Vitsuji Aura</p>
</div>

<div class="formgroup" id="name-form">
<div id = "holderm">
<form method="post">
<!--[if IE 8]><h3 style="color:white;text-align:center;">Username</h3><![endif]-->
       <input placeholder="Username"type="text" class="maininput" name="username" required>
<!--[if IE 8]><h3 style="color:white;text-align:center;">Email</h3><![endif]-->
    <input placeholder="Email"type="email" class="maininput"  name="email" required/>
<!--[if IE 8]><h3 style="color:white;text-align:center;">Password</h3><![endif]-->
<input placeholder="Password"type="password" class="maininput" name="password" required>
<input style="margin-top:7px;" type="submit" name="btn" class="btn-style" value="Sign Up and Start Developing" >
</form>
<p style="color:white;font-family:Arial;font-size:10px;padding-bottom:25px;"><i>By signing up you agree to our Terms of Services and Privacy Policy</i></p>
</div>

</div>


<!--<input style="margin-top:7px;" type="button" name="btn" class="btn-stylemob" value="Start Developing Now" />-->
<div class="btn-stylemob"><a href="http://beta002.site88.net/signup.php">Start Developing Now</a></div>


</div>
<?php 
  if(isset($a) ? $a : null){
  echo "<div id='snackbar' class='snackbar'> $a </div>";
}
  ?>
<div class = "maindiv">
<div class = "ins">
<h2 style="font-size:1.6em;font-weight:400;">Develop</h2>
<p id="mainp">Join the worlds largest growing developers community and start developing now.Create something new or get ideas from others.</p>

<div id="dbutton"><a href="http://beta002.site88.net/signup.php">Start now</a>

</div>

</div>

<div class = "ins">
<h2 style="font-size:1.6em;font-weight:400;">Community</h2>
<p id="mainp">Logarithm is the worlds first growing developers community.It is a community created in attempt to connect developers from all around the world.</p>

<div id="dbutton">
<a href="http://beta002.site88.net/bout.html">Learn more</a>
</div>

</div>

</div>


<div class="examples">
<div class="ex">
<img src="_chat.png" width="100%" height="50%">
<div id="deff">
<p>Real time chat with people all around the world. Discuss your ideas with others and give advice to others or ask for help.</p>
</div>
</div>
<div class="ex">
<img src="_blog.png" width="100%"height="50%">
<div id="deff">
<p>Share your projects and ideas through blogs. Discover new projects by looking at blogs made by others and learn something new. </p>
</div>
</div>
<div class="ex">
<img src="_collaboration.png" width="100%"height="50%">
<div id="deff">
<p >Follow people and collaborate with them on exciting projects. Help others with their plans,give advice or get help from other people to improve your current work. </p>
</div>
</div>

</div>

<div class="end">
<p id="insend">&copy; Logarithm,Inc.</p>
<p id="insendpl"><a href="http://beta002.site88.net/t&s.html">Terms & Services</a></p>
<p id="insendpl"><a href="http://beta002.site88.net/pr&sec.html">Privacy & Security</a></p>
<p id="insendpl"><a href="http://beta002.site88.net/faq.html">FAQ</a></p>

<p id="insendpr"><a href="http://beta002.site88.net/signup.php">Sign Up</a></p>
<p id="insendpr"><a href="http://beta002.site88.net/signin.php">Sign In</a></p>
<p id="insendpr"><a href="http://beta002.site88.net/contact.html">Contact</a></p>
<p id="insendpr"><a href="http://beta002.site88.net/bout.html">About</a></p>


</div>

 
<script>
/*function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}*/

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
 }, 6000);

</script>
</body>
</html>