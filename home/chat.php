<!DOCTYPE html>
<html>
<head>
<title>Public Chat - Logarithm</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="description" content="The developers' corner"/>
<meta name="author" content="Vitsuji Aura"/>
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<style>
body{margin:0;padding:0;font-family:'Raleway',sans-serif;overflow-x:hidden;}

@media screen and (min-width:680px){
.wcom input[type=text]{width:50%;}
}

@media screen and (max-width:680px){
.wcom input[type=text]){width:70%;}
}

.mnav{padding:0;margin:0;border:1px solid #d7d7d7;text-align:center;}

.mnav h1{display:inline-block;margin:0;padding:1.2%;font-family:'Josefin Slab',sans-serif;}
.mnav span{font-size:30px;cursor:pointer;padding:1.2%;float:right;}

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
   // padding-top: 60px;
    font-family:'Josefin Slab',sans-serif;
    
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
.side a:nth-child(2){padding:0.83em;margin:0;}
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
.mnav{padding:0;margin:0;border:1px solid #d7d7d7;}
.mnav h1{display:inline-block;margin:0;padding:1.2%;color:#069E2D;font-family:'Josefin Slab',sans-serif;}
.mnav span{font-size:30px;cursor:pointer;padding:1.2%;float:right;}

.side h2{font-size:1.8em;text-align:center;-webkit-margin-before:1.66em;}
.authr{width:78%;margin:0 auto;background:rebeccapurple;}

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
width:100%;
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

.msgs{
position:fixed;
width:100%;
height:80%;
}

.comstandin{
margin-top:0.8%;
width:90%;
margin:0 auto;
padding:1%;
height:5%;
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

}
.contcomv{
display:inline-block;
height:40px;
}
.comcon{padding:8px;border-radius:25px;border:1px solid #d7d7d7;}
.comcon p{margin:0;}

.comcon_p{padding:8px;border-radius:25px;border:1px solid #d7d7d7;color:#fff;background:#069E2D;}
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
    background-image: url("cimages/1Vitsuji_Aura202cb962ac59075b964b07152d234b701498763787.jpg");
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
    margin: 4px 2px;
    cursor: pointer;
width:30%;
margin-left:35%;
margin-top:5%;
margin-bottom:2%;
}

.chat_leave:hover{
background:#d3d3d3;
}

.com_p{text-align:right;float:right;}
</style>
</head>
<body>

<div id="Sidenav" class="side">

  <h2>Chat Settings & Info</h2>

    <a id="closebtn" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	
	<div class="authr">

	<a>
<div class="authr_img"></div>​
   </a>

<div class="authr_name">Vitsuji Aura</div>

    
	</div>

<div class="chat_info">

<div class="chat_descy">

<h2>Chat Description</h2>
<div class="descc">
<h3>This the the best chat in the world</h3>
</div>

</div>

<div class="chat_fol"><h2>Chat users: 11</h2></div>

<div class="chat_back">
<h2> Change Chat Background</h2>
<input type="file" id="upload" class="custom-file-input" name="chat_back">
</div>

</div>
	
<form method="post" >
<input type="submit" class="chat_leave" value="Leave Chat">
</form>
</div>


<div class="mnav">
<span onclick="openNav()">&#9776;</span>
<h1>Logarithm</h1>

</div>
<!--one ting-->
<div class="msgs">

<div class='comstandin'>
<div class='com'>
<img src='cimages/1Vitsuji_Aura202cb962ac59075b964b07152d234b701498763787.jpg'/>
<div class='contcomv'>
<form method ='post' action='mypage.php' id='getcom'>
<input class='comname' type='submit' name='userlink' value='John White' />
</form>

<!--<form method='post' id='melcom' class='$rand'>
<input type='text' name='msg' value='$msg' />
<input type='text' name='targ' value='$target' />
<input type='text' name='comdel' value='$commenter' />

</form>-->

 <!--<button class='comdel' type='submit'id='$rand' onclick='deletecom(this)' name='$commenter' >
    <i id='delcom' class='material-icons'>delete</i>
  </button>-->


<div class='comcon'><p>This is a simple text messsage</p></div>

</div></div>
</div>





<div class='comstandin'>
<div class='com_p'>
<img src='cimages/1Vitsuji_Aura202cb962ac59075b964b07152d234b701498763787.jpg'/>
<div class='contcomv'>
<form method ='post' action='mypage.php' id='getcom'>
<input class='comname' type='submit' name='userlink' value='John White' />
</form>

<!--<form method='post' id='melcom' class='$rand'>
<input type='text' name='msg' value='$msg' />
<input type='text' name='targ' value='$target' />
<input type='text' name='comdel' value='$commenter' />

</form>-->

 <!--<button class='comdel' type='submit'id='$rand' onclick='deletecom(this)' name='$commenter' >
    <i id='delcom' class='material-icons'>delete</i>
  </button>-->


<div class='comcon_p'><p>This is a simple text messsage#2</p></div>

</div></div>
</div>



<div class='comstandin'>
<div class='com'>
<img src='cimages/1Vitsuji_Aura202cb962ac59075b964b07152d234b701498763787.jpg'/>
<div class='contcomv'>
<form method ='post' action='mypage.php' id='getcom'>
<input class='comname' type='submit' name='userlink' value='John White' />
</form>

<!--<form method='post' id='melcom' class='$rand'>
<input type='text' name='msg' value='$msg' />
<input type='text' name='targ' value='$target' />
<input type='text' name='comdel' value='$commenter' />

</form>-->

 <!--<button class='comdel' type='submit'id='$rand' onclick='deletecom(this)' name='$commenter' >
    <i id='delcom' class='material-icons'>delete</i>
  </button>-->


<div class='comcon'><p>This is a simple text messsage#3</p></div>

</div></div>
</div>





</div>
<!--end one ting-->




<form method="post" id="comform">
<div class="wcom" >
<input maxlength="140" id="comidin" type = "text" class="comin" placeholder="My message..." name="sendmsg" autocapitalize="off" autocorrect="off"/>
</div>
</form>












<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script>


function openNav() {
    document.getElementById("Sidenav").style.width = "100%";
    $(".wcom").css("display","none");
   
}

function closeNav() {
    document.getElementById("Sidenav").style.width = "0";
$(".wcom").css("display","-webkit-flex");
$(".wcom").css("display","flex");
}
</script>
<script>
 function news(){
  document.getElementById("Sidenav").style.width = "0px";
 }

</script>


</body>
</html>