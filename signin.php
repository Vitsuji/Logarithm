<?php
include 'dbconnect.php';

if(isset($_POST['btn']) ? $_POST['btn'] : null){
$email = $_POST['email'];
$password = $_POST['password'];

$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);
$password = hash('ripemd160',sha1(sha1(md5(md5(sha1(md5($password)))))));
$sql = "SELECT * 
FROM  `id1251041_udata`.`userd` 
WHERE  `email` LIKE '$email'
AND  `password` LIKE '$password'";

$result = mysqli_query($conn,$sql);

if($result){
$row = mysqli_fetch_assoc($result);
if($row){
session_start();
$_SESSION['username'] = $row['username'];
$_SESSION['email'] = $row['email'];
header("location: /home");
}else{
$a = "Wrong email or password";
}
}else{
echo "Fail". mysqli_error($result);
}
echo"<html><body><div id='snackbar'> $a </div></body></html>";
$a = "";
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
<title>Logarithm Sign In</title>
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
   .example{height:900px;}
  ul.topnav li:not(:first-child){display: none;}
  ul.topnav li.icon {
    float: right;
    display: inline-block;
  }
  .ex{width:80%;margin-top:5%;}
  #firstx{border-top:1px solid #d3d3d3;}
  .maininput{width:80%;margin-left:10%;}
  .btn-style{width:80%;}
  .enc{width:100%;}
  .enc h3{margin:1%;}
    }
@media screen and (min-width:680px){
ul.topnav li a{border:none;}
.maininput{width:35%; margin-left:32.5%;}
.btn-style{width:35%;}
.enc{width:60%;}
.examples{height:700px;}
.ex{width:60%;margin-top:1%;}
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
margin:0 auto;
border-bottom:1px solid #d7d7d7;
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
        color:white;
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
#holderm h5{margin-top:1%;font-weight:100;}

.examples{
width:100%;
display:flex;
flex-direction:column;
flex-wrap:wrap;
}
.ex{
flex-grow:1;
//width:27%;
//margin:1%;
margin:0 auto;
margin-top:2%;
padding:1%;
border:1px solid #d3d3d3;
line-height:1.5;
}
.ex:last-child{margin-bottom:2%;}
#ax{width:70%;margin:0 auto;}
.end{
position:relative;
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
  <li><a href="http://beta001.site88.net/signup.html" id="firstx">Sign Up</a></li>
  <li><a href="http://beta001.site88.net/signin.html">Sign In</a></li>
  <li><a href="http://beta001.site88.net/bout.html">About</a></li>
    <li><a href="http://beta001.site88.net">Home</a></li>



</ul>


<div class="mainm">
<h1><strong>Logarithm</strong> wants you</h1>
</div>
<div class="upperi"><h3 style="letter-spacing:2px;">Continue your work</h3></div>



<div class="formgroup" id="name-form">
<div id = "holderm">
<form method="post">
<!--[if IE 8]><h3 style="color:white;text-align:center;;">Email</h3><![endif]-->
    <input placeholder="Email"type="email" class="maininput"  name="email" required>
<!--[if IE 8]><h3 style="color:white;text-align:center;">Password</h3><![endif]-->
<input placeholder="Password" type="password" class="maininput" name="password" required >
<input style="margin-top:7px;" type="submit" name="btn" class="btn-style" value="Log In" >
</form>
<h5><a href="http://beta001.site88.net/forgotpassword.html">Forgot password?</a></h5>
<?php 
if(isset($a) ? $a : null){
echo "<h1>$a</h1>";
}
?>
</div>

</div>

<div class="enc">
<h3>Don't have an account? Sign up <a href="beta001.site88.net/signup.html">here</a></h3>
</div>


<div class="examples">
<div class="ex">
<div id="ax">
<p style="font-size:20px;" >Not sure about something? Check out the</p>
<h3><a href="beta001.site88.net/faq.html">FAQ</a></h3>
</div>
</div>
<div class="ex">
<div id="ax">
<p style="font-size:20px;">Not sure what Logarithm is used for?</p>
<h3><a href="beta001.site88.net/bout.html">About</a> & <a href="beta001.site88.net/t&s.html">Terms & Service</a></h3>

<h3></h3>
</div>
</div>
<div class="ex">
<div id="ax">
<p style="font-size:20px;" >Worried about Security or Privacy? Check out</p>
<h3><a href="beta001.site88.net/pr&sec.html">Privacy and Security</a></h3>
</div>
</div>
</div>
<div class="end">
<p id="insend">&copy; Logarithm,Inc.</p>
<p id="insendpl"><a href="beta001.site88.net/t&s.html">Terms & Service </a></p>
<p id="insendpl"><a href="beta001.site88.net/pr&sec.html">Privacy & Security</a></p>
<p id="insendpl"><a href="beta001.site88.net/faq.html">FAQ</a></p>

<p id="insendpr"><a href="http://beta001.site88.net/signup.html">Sign Up</a></p>
<p id="insendpr"><a href="http://beta001.site88.net/signin.html">Sign In</a></p>
<p id="insendpr"><a href="http://beta001.site88.net/contact.html">Contact</a></p>
<p id="insendpr"><a href="http://beta001.site88.net/bout.html">About</a></p>


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