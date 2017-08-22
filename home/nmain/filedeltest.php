<?php
session_start();
include 'dbconnect.php';


if($_SESSION['username'] === Null || $_SESSION['email'] === Null){
header("location:signup.php");
}else{
$username = $_SESSION['username'];
$email = $_SESSION['email'];

$sql ="SELECT * 
FROM  `profiles` 
WHERE  `name` LIKE '$username'
AND  `email` LIKE  '$email'";

$result = mysqli_query($conn,$sql);
if($result){
$row = mysqli_fetch_assoc($result);

if($row){
$date = $row['date'];
$pimg = $row['pimg'];
$pimg = "pimages/".$pimg;
$description = $row['description'];

}else{
echo "wrong row";
}

}else{
echo "wrong result";
}

if(isset($_POST['descup']) ? $_POST['descup'] : null){
$newdesc = $_POST['ndesc'];
$changedesc = "UPDATE  `profiles` SET  `description` =  '$newdesc' WHERE  `profiles`.`name` = '$username'";

$result = mysqli_query($conn,$changedesc);
if($result){
header("location:pinterpret.php");
}else{
echo "<div style='position:fixed;background:#fff;border:1px solid #d7d7d7;'><h3>Failed. Try again later.</h3></div>";
}
}


}
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Raleway" rel="stylesheet">
<title>My profile - Logarithm</title>
<style>
body{margin:0;padding:0;font-family:'Raleway',sans-serif;border:1px solid #d7d7d7;outline:none;}
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
.mainp input{width:15%;padding:1%;}
#secin{margin-left:16px;}
.dsxc{width:40%;}
.mains img{height:170px;}
.mains h2, h3{padding:2%;}
//.mcomments{width:80%;height:300px;margin-left:10%;}
.mnav span{padding:1.2%;}
#two input[type=text]{width: 130px;}
#pad5{padding:1%;}
}
@media screen and (max-width: 680px){
.comments:first-child{margin-top:20px;}
.picc{padding:3%;margin-top:3%;}
//.mcomments{width:100%;height:300px;}
.comments{width:80%;}
.mains img{width:55%;}
.mainp input{width:80%;padding:3%;}
.dsxc{width:80%;}
#padxs{
padding:6%;
}
#pad5{padding:5%;}
.mains h2{padding:8%;}
.mnav span{padding:6%;padding-top:3%;}
#two input[type=text]{width:100%;height:20px;}
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
    padding-top: 60px;
    font-family:'Josefin Slab',sans-serif;
    
}
.mdiv{
display:flex;
flex-wrap:wrap;
flex-direction:row;
width:100%;
height:70px;
margin-bottom:5%;
}
.middle{
flex-grow:1;
width:30%;
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

}
.side a#naive{    border:1px solid #d7d7d7;}
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
	width: 130px;
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
#two{display:inline-block;padding:1.2%;}

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
}
#two input:-moz-placeholder {
	color: transparent;
}
#two input::-webkit-input-placeholder {
	color: transparent;
}
.result{
position:fixed;
width:150px;
margin-left:15px;
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
.mains img:hover{box-shadow: 0px 0px 10px black;}

.mains h2{font-size:30px;}
.mains h2,h3,h4,h5{
color:#fff;
font-family:'Josefin Slab',sans-serif;
margin:0;
}
.mainp{
text-align:center;
}
.mainp input{
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
  <a id="naive" href="#">Log Out</a>
</div>

<div class="mnav">
<span onclick="openNav()">&#9776;</span>
<h1 id="padxs">Logarithm</h1>
<form id="two">
	<input type="text" placeholder="Search">
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
<div class="amfol"><p>Followers: 0<p></div>
<div class="amfol" style="margin-left:20%;"><p>Following: 0<p></div>
</div>

<form id="secf">
<!--<input type="submit" value="My chats">-->
<div class="comments"><p>Follow</p></div>
<div class="comments" onclick="comment();" ><p>Start Chat</p></div>
</form>

<div class="commentview">
<p/>This is the first comment<p>
<p/>This is the secondcomment<p>
</div>

<div class="dsxc"><p class="desc"><i><?php echo $description; ?></i> <a style="text-decoration:none;" id="ed">Edit</a></p>
<div class="changed">

<form action="mypage.php" method="post">
<p style="border:none" onclick="closedesced();" class="closedesced">&times;</p>
<textarea class="descchan" name="ndesc" placeholder="Description..."></textarea>
<input type="submit" name="descup" value="Change">
</form>

</div>
</div>
<div class="posts"><p class="post"><i>No posts yet</i></p></div>
</div>
</div>



<script>
function comment(){
$(".commentview").slideDown();
}


function openNav() {
    if ($(".mains img").css("height") > "169px"){
    document.getElementById("Sidenav").style.width= "250px";
    }else{
    document.getElementById("Sidenav").style.width = "100%";
    }
}

function closeNav() {
    document.getElementById("Sidenav").style.width = "0";
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

$("#Sidenav").mouseleave(function(){
    $(this).css("width","0px");
});

</script>

</body>
</html>