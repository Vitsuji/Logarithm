


var modal = document.getElementById('crecre');


window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";

    }

}

    $("#crecre").click(function(){

        hummus();
});

function hummus() {
        $("#crecre").fadeToggle();
}
function addFile() {
        var cusid_ele = document.getElementsByClassName('craze');

      var len = cusid_ele.length;
      if(len >= 3){
              console.log("congrats");
      }else{
              if(len == 2){
                      $(".post_file_add").hide();
              }
              $("<div class='craze' id='post_file_"+len+"' style='display: block;'><input type='file' id='upload' class='custom-file-input' name='post_img[]'><i class='material-icons' onclick='delFile(this)'>&#xE872;</i></div>").insertBefore(".post_file_add");

              var num_file = $("input[name=file_number]").val();
                      var num_file_int =  parseInt(num_file);
                      var new_num = num_file_int+1;
                      $("input[name=file_number]").val(new_num);
                      console.log("file: "+new_num);

                      var order = $("input[name=content_order]").val();
                      order = order+",post_file_"+len;
                      $("input[name=content_order]").val(order);


     }
}


function addText() {
          var cusid_ele = document.getElementsByClassName('post_cont');

        var len = cusid_ele.length;
        if(len == 4){
                console.log("congrats");
        }else{
                console.log(len);
                if(len == 3){
                        $(".post_text_add").hide();
                }
                $("<div class='post_cont' id='post_text_"+len+"'><textarea name='post_cont[]' onfocus='textfoc(this)' onblur='textblur(this)' maxlength='240'></textarea><i class='material-icons' onclick='delText(this)'>&#xE872;</i></div>").insertBefore(".post_file_add");


                              var num_file = $("input[name=text_number]").val();

                                      var num_file_int =  parseInt(num_file);
                                      var new_num = num_file_int+1;
                                      $("input[name=text_number]").val(new_num);
                                      console.log("text: "+new_num);

                                      var order = $("input[name=content_order]").val();
                                      order = order+",post_text_"+len;
                                      $("input[name=content_order]").val(order);



        }








}



function delFile(obj) {
/*
         $(obj).parent().replaceWith("<div class='post_filein_open'></div>");


        /*var cusid_ele = document.getElementsByClassName('post_files');
        if(cusid_ele.length == 0){


        }else{
        var cusid_ele = document.getElementsByClassName('post_filein_open');
                if(cusid_ele.length > 0){
      $(".post_file_add").show();

                }


*/

 /*$(obj).parent().css("display","none");*/
 $(obj).parent().remove();
  $(".post_file_add").show();
    $(obj).parent().find("input").val('');

    var num_file = $("input[name=file_number]").val();

            var num_file_int =  parseInt(num_file);
            var new_num = num_file_int-1;
            $("input[name=file_number]").val(new_num);
            console.log("file: "+new_num);

            var pid = $(obj).attr('id');
            pid = ','+pid;
            var order =  $("input[name=content_order]").val();
            order = order.replace(pid,'');
            $("input[name=content_order]").val(order);
            console.log("new order = "+order);


}

function delText(obj) {
        $(obj).parent().remove();
         $(".post_text_add").show();
           $(obj).parent().find("input").val('');

           var num_file = $("input[name=text_number]").val();

                   var num_file_int =  parseInt(num_file);
                   var new_num = num_file_int-1;
                   $("input[name=text_number]").val(new_num);
                   console.log("text: "+new_num);

                   var pid = $(obj).attr('id');
                   pid = ','+pid;
                   console.log("id: "+pid);
                   var order =  $("input[name=content_order]").val();
                   order = order.replace(pid,'');
                   $("input[name=content_order]").val(order);


}


$(".crepostform").draggable();
$(".override_post").draggable();




function greener(){
$("#two input[type=submit]").css("background","#399E5A");
$("#two input[type=submit]").css("color","#fff");
}


function blacker(){
$("#two input[type=submit]").css("background","#fff");
$("#two input[type=submit]").css("color","black");
}


function inputchf(obj){
  $(obj).css("margin-top","0");
}
function inputchb(obj){
  $(obj).css("margin-top","3%");
}

function textfoc(obj){
$(obj).css("padding-right","0");
$(obj).css("padding-bottom","0");
}

function textblur(obj){
$(obj).css("padding-right","2%");
$(obj).css("padding-bottom","2%");
}

$(function() {
    $(".crechatform").draggable();
});







function showHints() {
var fufu = $("#three input[type=text]").val();
showHint(fufu);

}

function showHint(str) {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("chatcon").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "backend/chat_hint.php?q=" + str, true);
        xmlhttp.send();

}
