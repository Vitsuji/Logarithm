<!DOCTYPE html>
<html>
<head>
<title>Homepage - Logarithm</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="description" content="The developers' corner"/>
<meta name="author" content="Vitsuji Aura"/>
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="maincss.css">
<style>
body{margin:0;padding:0;font-family:'Raleway',sans-serif;}

</style>
</head>
<body>
<div id="Sidenav" class="side">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="http://beta002.site88.net/home/mypage.php"><img src="<?php echo $pimg; ?>" height="115px">
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
<h1>Logarithm</h1>
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
      <button type="submit" name="subm">Create</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
   
    </div>
  </form>
</div>

<div id="snackbar">Welcome <?php echo $username; ?></div>


<script>
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
</script>
<script>


function openNav() {
    if ($("#snackbar").css("padding") == "32px"){
    document.getElementById("Sidenav").style.width = "100%";
    }else{
      document.getElementById("Sidenav").style.width = "250px";
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
</body>
</html>