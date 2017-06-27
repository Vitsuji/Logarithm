<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="utf-8"> 
<title>User interface for Ajax, PHP, MySQL demo</title> 
<meta name="description" content="HTML code for user interface for Ajax, PHP and MySQL demo."> 
<style type="text/css">
body {padding-top: 40px; padding-left: 25%}
li {list-style: none; margin:5px 0 5px 0; color:#FF0000}
</style>
</head>
<body>
<form class="well-home span6 form-horizontal" name="ajax-demo" id="ajax-demo">
<div class="control-group">
              <label class="control-label" for="book">Book</label>
              <div class="controls">
                <input type="text" id="book">
			  </div>
 </div>
 <div class="control-group">
              <div class="controls">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
 </div>
</form>
<script>
function book_suggestion()
{
var book = document.getElementById("book").value;
var xhr;
 if (window.XMLHttpRequest) { // Mozilla, Safari, ...
    xhr = new XMLHttpRequest();
} else if (window.ActiveXObject) { // IE 8 and older
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
}
var data = "book_name=" + book;
	 xhr.open("POST", "book-suggestion.php", true); 
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
     xhr.send(data);
}
</script>
</body>
</html>