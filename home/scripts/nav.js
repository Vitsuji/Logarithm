$jjo = "zero";
$jjj = "orez";

$jjo1 = "zero";
$jjj1 = "orez";

function openNav() {


    if($jjj == "acd"){
document.getElementById("Sidenav").style.width= "0";
  $("#Sidenav").hide();
  $( ".mychat_nav" ).hide();
$jjj = "orez";
}else{
          if($("#Sidenav").show()){
                  const mq = window.matchMedia( "(min-width: 681px)" );

                  if (mq.matches) {
                          document.getElementById("Sidenav").style.width= "250px";
                  }else {
                          document.getElementById("Sidenav").style.width = "100%";
                  }

    }
    $jjj = "acd";

}


}


function openCre(){
$(".create").fadeIn(400);
}

    $(".crechat2").on("click",function() {
        $(".create").fadeOut();
$(".crechatform").fadeIn(500);
    });

    $(".crepost2").on("click",function() {
        $(".create").fadeOut();
$(".crepostform").fadeIn(500);
    });

   $(".crechatform .delc i").on("click",function() {
$(".crechatform").fadeOut();
console.log("1");
});

$(".crepostform .delc i").on("click",function() {
$(".crepostform").fadeOut();
console.log("2");
});

function open_mychat() {
        //$(".mychat_nav").slideDown();
        $( ".mychat_nav" ).slideToggle();


}

function open_mychaty() {
        //$(".mychat_nav").slideDown();
        if($jjj1 == "acd"){
    document.getElementById("Sidenav").style.width= "0";
      $("#Sidenav").hide();
    $jjj1 = "orez";
    }else{
              if($("#Sidenav").show()){
                      const mq = window.matchMedia( "(min-width: 680px)" );

                      if (mq.matches) {
                              document.getElementById("Sidenav").style.width= "250px";
                      }else {
                              document.getElementById("Sidenav").style.width = "100%";
                      }
        }
        $jjj1 = "acd";

    }
        $( ".mychat_nav" ).slideToggle();


}

function close_chatn() {
        $("#chat_chatn").hide();
}

/*function addFile() {

          var cusid_ele = document.getElementsByClassName('craze');

        var len = cusid_ele.length;
        var expo = 0;
        while (len > expo) {

                if($(cusid_ele[expo]).css('display') == 'none'){
                        $(cusid_ele[expo]).css("display","block");
                        $("<textarea name='post_cont' onfocus='textfoc(this)' onblur='textblur(this)' maxlength='240'></textarea>").insertAfter(cusid_ele[expo]);

                        if(expo == 2){
                                console.log("hi");
                                $(".post_file_add").css("display","none");
                        }
                        break;
                }else{
                        expo++;


                }



        }




        console.log(cusid_ele[len-1]);


}*/

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

function post_active(post_id) {
        $(".override_post").show();
}

function post_close() {
        $(".override_post").hide(150);
}

function post_create (){
//var x = $("")document.forms["chatf"]["post_title"].value;

var x = $("input[name='post_title']" ).val();

if (x == "") {
    $("#txtpst").append("<p id='errortxt'>*Must be filled in</p>");
    return false;
}else{
        var cusid_ele = document.getElementsByClassName('tab_input');
        var tags = [];
        for (var i = 0; i < cusid_ele.length; i++) {
               tags.push($(cusid_ele[i]).html());
        }

        var tags_str = tags.toString();
        $(".tag_input input[type=text]").val(tags_str);


$('.crepostform #dacform').submit();

}
}



$('.tag_input').keyup(function(e){
   if(e.keyCode == 8){
       // user has pressed backspace
       var tag = $(".tag_input input[type=text]").val();
       if(tag == ""){

               var cusid_ele = document.getElementsByClassName('tab_input');
             var len = cusid_ele.length;
             $(cusid_ele[len-1]).remove();

       }

   }
   if(e.keyCode == 32){
       // user has pressed space
      // array.push('');

      var tag = $(".tag_input input[type=text]").val();
      if(tag == " "){

      }else {
              var cusid_ele = document.getElementsByClassName('tab_input');
            var len = cusid_ele.length;
            if(len >= 5){

            }else{

      $("#categories").append("<div class='tab_input'>"+tag+"</div>");
      $(".tag_input input[type=text]").val("");




   }
   }
   }
});
