<!DOCTYPE html>
<html>
        <head>
                <meta charset="utf-8">
                <title>Test</title>
                <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
                <style media="screen">
                body {
padding: 20px;
}

i:hover{cursor:pointer;}

.custom-file-input {
padding: 5px;
color: #999;
vertical-align: middle;
border-bottom:1px solid #d7d7d7;
margin:2%;
display: inline-block;
outline:none;
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
#item1:hover{
        color: #069E2D;
}
#craze i:hover{
        color:red;
}


                </style>
        </head>
        <body>
                <form enctype="multipart/form-data" action="" method="post">
    <p>Upload file(s)</p>
    <div class="post_filein_open"></div>
     <div class="post_filein_open"></div>
     <div class="post_filein_open"></div>



  <!--  <p><input class="post_file_add" type="button" value="Add File" onclick="addFile();" /></p>-->

    <div class="post_file_add" onclick="addFile()"><i id='item1' class="material-icons">&#xE145;</i></div>
</form>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
function addFile() {
  var cusid_ele = document.getElementsByClassName('post_filein_open');
        if(cusid_ele.length == 0){


        }else{
        var post_file = "<div id='craze'><input type='file' id='upload' class='custom-file-input'><i class='material-icons' onclick='delFile(this)'>&#xE872;</i></div>";
        $(cusid_ele[0]).replaceWith(post_file)
        var cusid_ele = document.getElementsByClassName('post_filein_open');
                if(cusid_ele.length == 0){
      $(".post_file_add").hide();

                }

}

}

function delFile(obj) {

         $(obj).parent().replaceWith("<div class='post_filein_open'></div>");


        /*var cusid_ele = document.getElementsByClassName('post_files');
        if(cusid_ele.length == 0){


        }else{*/
        var cusid_ele = document.getElementsByClassName('post_filein_open');
                if(cusid_ele.length > 0){
      $(".post_file_add").show();

                }



}


</script>
        </body>
</html>
