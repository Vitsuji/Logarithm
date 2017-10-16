

function startf(){
  //chat_enlarge_standard_general();
  //setInterval(function(){ chat_receivemsgs(); }, 250);
  chat_receivemsgs_general();

}

function chat_generate(chat_id) {

var id = chat_id.toString();
var check_user_in = "#chat_"+id;
if($(check_user_in).length == 0) {
        var open ="";
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var myObj = JSON.parse(this.responseText);
                        /*var text = "Welcome to chat: "+myObj[1];*/
                        open = [
                          "<div class='full_wrap' id='chat_"+chat_id+"'>   <div class='force-overflow'></div>    <div id='nav_"+chat_id+"' class='chat_side'>      <h2>Chat Settings & Info</h2>  <a id='closebtn' href='javascript:void(0)'",
                          "class='closebtn' onclick='chat_closeNav("+chat_id+")'>&times;</a>    	<div class='authr' style='background-image:url("+myObj[3]+");'>    	<a>    <div class='authr_img' style='background-image:url(pimages/"+myObj[9]+");'></div>​       </a>    <form action='mypage.php' method='post'>    <div ",
                          "class='authr_name'><button value='"+myObj[6]+"' name='userlink' class='subm_as_text'> "+myObj[6]+"</button></div>    </form>    	</div>    <div class='chat_info'>    <div ",
                          "class='chat_descy'>    <h2>Chat Description</h2>    <div class='descc'>    <h3>"+myObj[2]+"</h3>    </div>    </div>    <div class='chat_fol'><h2>Chat users: 2</h2></div>    <div class='chat_back'>    <h2> ",
                          "Change Chat Wallpaper</h2>    <form method='post' action='picture.php' enctype='multipart/form-data'>    <input type='file' id='upload' class='custom-file-input' name='chat_wall'>    <input type='submit' ",
                        "class='chat_wall_subm' value='Change'/>    </form>    </div>    </div>    <form method='post' action='chat.php' >    <button class='chat_leave' name='chat_leave' value='$chat_index' >Leave Chat</button>    </form>    </div>    <div class='chat_mnav'>    ",
                        "<span onclick='chat_openNav("+chat_id+")'>&#9776;</span>    <i class='material-icons' id='chat_un_small' onclick='chat_un_small("+chat_id+")'>arrow_upward</i>    <h1>"+myObj[1]+"</h1>    <div class='chat_close' onclick='chat_close("+chat_id+")'><i ",
                        "class='material-icons' >&#xE5CD;</i></div>    </div>    <div class='conceal_wrapper'>    <div class='msgs' style='background-image:url("+myObj[4]+")' id='"+chat_id+"'>    </div>    <form method='post' id='form_"+chat_id+"' class='comform'>    <div class='chat_wcom' >    <input maxlength='140' type = 'text' id='input_"+chat_id+"'  class='comin' placeholder='My message...' name='sendmsg' onkeypress='g(event,"+chat_id+")' ",
                        "autocapitalize='off' autocorrect='off'  />    <input class='hidden_index' type='text' value='"+chat_id+"' name='chat_index'/>    </div>    </form>    </div>    <div class='chat_enlarge'>    <div class='chat_enlarge_full' onmouseover='chat_action(this)' onmouseout='chat_action_negative(this)' ",
                        "onclick='chat_enlarge_full("+chat_id+")'></div>    <div class='chat_enlarge_standard'  onmouseover='chat_action(this)' onmouseout='chat_action_negative(this)' onclick='chat_enlarge_standard("+chat_id+")'></div>    <div ",
                        "class='chat_enlarge_small'  onmouseover='chat_action(this)' onmouseout='chat_action_negative(this)' onclick='chat_enlarge_small("+chat_id+")'></div><div class='chat_enlarge_close'  onmouseover='chat_action(this)' onmouseout='chat_action_negative(this)' onclick='chat_close("+chat_id+")'></div>    </div></div>"
                        ].join("\n");

                        var cusid_ele = document.getElementsByClassName('open_chat');
                        if(cusid_ele.length == 0){
                          alert("No more chat space");

                        }else{

                                if($(cusid_ele[0]).replaceWith(open)){

                                        draggables();
                                        startf();

                                }

                    }
            }



        chat_enlarge_standard(chat_id);

                };

                xmlhttp.open("GET", "backend/receivechatinfo.php?id="+id, true);
                xmlhttp.send();




}else{

        alert("The chat is already open");
}





}


function scrollOpen(id) {
                var elem = document.getElementById(id);
                elem.scrollTop = elem.scrollHeight;

}

  function chat_close(chat_id){
          chat_id = chat_id.toString();
        $("#chat_"+chat_id).replaceWith("<div class='open_chat'></div>");
        //$('#mydiv').replaceWith('Aloha World');

    }

function g(e, chat_id){
        if (e.keyCode == 13) {
               e.preventDefault();

              var item_id = chat_id;
        if($.post('backend/sendcom.php', $('#form_'+item_id).serialize())){
         var a = $(".comin").val();

        // var up = '"'+item_id+'"';
         document.getElementById("input_"+item_id).value = "";
        //this.value = " ";
//        chat_receivemsgs_specific(item_id);
        //sent and cleared
}
}
}

function sendmsg(e){

        //send
         /*   if (e.keyCode == 13) {
                e.preventDefault();
                var item_id = this.id;
                alert(item_id);
        if($.post('sendcom.php', $('#form_'+item_id).serialize())){
          var a = $(".comin").val();
          alert(a);
          var up = '"'+item_id+'"';
          alert(up);
        this.value = " ";
        chat_receivemsgs_specific(item_id);
        //sent and cleared




        }

}*/

}


$(".custom-file-input").focus(function(){
$(".chat_wall_subm").css("display","inline-block");


});

function chat_openNav(id) {
  //  document.getElementById("Sidenav").style.width = "25%";
  //var left = $(".full_wrap").css("left");
  var side_id = "nav_"+id.toString();
  var form_id = "form_"+id.toString();

  $( "#"+side_id ).slideToggle( "slow", function() {
    // Animation complete.
    //$(this).css("left",'"'+left+'"');
  });

  if($("#"+form_id+" .chat_wcom" ).css('display') == "flex"){
    $("#"+form_id+" .chat_wcom" ).css("display","none");
}else{
  $("#"+form_id+" .chat_wcom" ).css("display","flex");

}
}

function chat_closeNav(id) {
//    document.getElementById("Sidenav").style.width = "0";
  var side_id = "nav_"+id;
    var form_id = "form_"+id;

$( "#"+side_id ).slideToggle( "slow", function() {
  // Animation complete.
});


$("#"+form_id+" .chat_wcom").css("display","-webkit-flex");
$("#"+form_id+" .chat_wcom").css("display","flex");
}


function chat_receivemsgs_general(){

var cusid_ele = document.getElementsByClassName('msgs');
if(cusid_ele.length == 0){
console.log("open");

}else{
  for (var i = 0; i < cusid_ele.length; ++i) {
    var item = cusid_ele[i];
    var item_id = item.id;




  var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = function(this_item_id) {
        if (this.readyState == 4 && this.status == 200) {
          //  document.getElementById(this_item_id).innerHTML = this.responseText;
          $("#"+this_item_id).html(this.responseText);
        }else{

        }
      }.bind(xmlhttp, item_id);

      xmlhttp.open("GET","backend/receivemsg.php?q="+item_id,true);
      xmlhttp.send();

  }


  }

}

function chat_receivemsgs_specific(chat_id){

  var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = function(this_item_id) {
        if (this.readyState == 4 && this.status == 200) {

          //  document.getElementById(this_item_id).innerHTML = this.responseText;
          $("#"+this_item_id).html(this.responseText);
        }else{

        }
      }.bind(xmlhttp, chat_id);

      xmlhttp.open("GET","backend/receivemsg.php?q="+chat_id,true);
      xmlhttp.send();

}

function draggables(){
    $(".full_wrap").draggable({
  axis: "x",
   containment: "window"
});
}

function chat_enlarge_full(chat_id){
  var item_id = "chat_"+chat_id.toString();

$("#"+item_id+" .chat_close").css("display","none");
$("#"+item_id+" .msgs").css("width","100%");
$("#"+item_id).css({"width":"100%","height":"100%","left":"0"});
$("#"+item_id+" .msgs").css("width","100%");
$("#"+item_id+" .msgs").css("height","82.3%");
$("#"+item_id+" .chat_comstandin").css("margin-top","0.8%");
$("#"+item_id+" .chat_wcom").css("width","100%");
//$("#"+item_id+" .side").css("width","100%");
$("#"+item_id+" .chat_leave").css("width","30%");
//$("#"+item_id+" .chat_leave").css("margin-left","35%");
$("#"+item_id+" .chat_mnav span").css("padding","1.2%");
$("#"+item_id+" .chat_side a:nth-child(2)").css("padding","0.83em");
$("#"+item_id+" .chat_mnav").css("height","8%");
$("#"+item_id+" .chat_mnav h1").css("padding","1%");
$("#"+item_id+" .chat_mnav span").css({"padding":"0.8%","margin-right":"1.5%","width":"auto"});
$("#"+item_id+" .chat_comstandin").css({"margin-top":"3.5%","padding":"0"});
$("#"+item_id+" .chat_side").css({"width":"100%","height":"100%","top":"0"});
$("#"+item_id+" .chat_mnav h1").css("width","90%");
$("#"+item_id+" .chat_enlarge_close").css("display","block");
$("#"+item_id+" .chat_enlarge_small").css("display","none");
$("#"+item_id+" .chat_wcom input[type=text]").css({"padding":"15px","width":"24%"});
  }





/*function chat_enlarge_standard_general(){

const mq = window.matchMedia( "(min-width: 981px)" );

if (mq.matches) {
  // window width is at least

 //   if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
     // some code..

      $(" .chat_mnav h1").css("padding","5% 0px 5% 5%");
     $(".full_wrap").css({"height":"75.6%","right":"auto"});
     $(".chat_side").css("width","100%");
     $(".chat_leave").css("width","70%");
     $(".chat_mnav span").css("padding","0");
     $(".chat_side a:nth-child(2)").css({"padding":"15px"});
     $(".chat_mnav").css("height","10%");
     $(".chat_mnav h1").css("padding","5% 0px 5% 5%");
          $(".chat_comstandin").css("margin-top","13%");
         $(".chat_mnav span").css({
               "padding": "5%",
                   "padding-left": "0",
                   "padding-top":"3%",
                   "width":"5%"
             });
     $(".chat_side").css({"width":"100%","height":"90%"});

     $(".chat_mnav h1").css("width","75%");
      if($(".chat_comstandin").css("margin-top","13%")){console.log("comstandin booiii");}
    }else{

    $(".full_wrap").css({"width":"100%","height":"100%","left":"0"});
    $(".msgs").css("width","100%");
    $(".msgs").css("height","82.3%");
    $(".chat_wcom").css("width","100%");
     // $(".wcom input[type=text]").css({"padding":"3.2%","width":"40%","font-size":"20px","padding":"10px"});
    //$("#"+item_id+" .side").css("width","100%");
    $(".chat_leave").css("width","40%");
   // $(".chat_leave").css("margin-left","30%");
    $(".chat_mnav span").css("padding","1.2%");
    $(" .chat_mnav").css("height","8%");
      $(" .chat_close").css("display","none");
    $(".chat_mnav span").css({"margin-right":"1.5%","width":"auto","padding":"3%","padding-left":"0"});
    // $(".comstandin").css({"margin-top":"3%","padding":"0"});
    $(".chat_side").css({"width":"100%","height":"100%","top":"0"});
            $(".chat_mnav h1").css({"padding-top":"3%", "margin-left":"3%"});

              $(".chat_enlarge").css({"height":"6%","width":"6%"});
              $(".chat_enlarge_standard").css({"display":"none"});
              $(".chat_enlarge_small").css({"display":"none"});
              $(".chat_enlarge_full").css({"display":"none"});
              $(".chat_enlarge_close").css({"display":"block","width":"100%"});



    }
    }*/




  function chat_enlarge_standard(chat_id){
var item_id = "chat_"+chat_id.toString();
const mq = window.matchMedia( "(min-width: 981px)" );

if (mq.matches) {

    $("#"+item_id+" .chat_close").css("display","inline-block");
  $("#"+item_id+" .comstandin").css("margin-top","20%");
  $("#"+item_id+" .chat_leave").css("width","70%");
 // $("#"+item_id+" .chat_leave").css("margin-left","15%");
  $("#"+item_id+" .chat_mnav span").css("padding","0");
  $("#"+item_id+" .chat_side a:nth-child(2)").css({"padding":"15px"});
  $("#"+item_id+" .chat_mnav").css("height","10%");
  $("#"+item_id+" .chat_mnav h1").css("padding","5% 0px 5% 5%");

      $("#"+item_id+" .chat_mnav span").css({
            "padding": "5%",
                "padding-left": "0",
                "padding-top":"3%",
                "width":"5%"
          });
  $("#"+item_id+" .chat_side").css({"width":"100%","height":"90%"});

  $("#"+item_id+" .chat_mnav h1").css("width","75%");
  $("#"+item_id+" .chat_enlarge_close").css("display","none");
  $("#"+item_id+" .chat_enlarge_small").css("display","block");
  $("#"+item_id+" .comin").css("width","auto");


      const mq = window.matchMedia( "(min-width: 1025px)" );

      if (mq.matches) {

       $("#"+item_id).css({"width":"25%","height":"75.6%","right":"auto"});
         $("#"+item_id+" .msgs").css({"width":"25%","height":"58%"});
          $("#"+item_id+" .chat_wcom").css("width","25%");
          $("#"+item_id+" .chat_comstandin").css("margin-top","13%");
        }else {

       $("#"+item_id).css({"width":"37%","height":"75.6%","right":"auto"});
      $("#"+item_id+" .msgs").css({"width":"37%","height":"58%"});
      $("#"+item_id+" .chat_wcom").css("width","37%");
      $("#"+item_id+" .chat_comstandin").css("margin-top","13%");
        }



}else{

$(".full_wrap").css({"width":"100%","height":"100%","left":"0"});
$(".msgs").css("width","100%");
$(".msgs").css("height","82.3%");
$(".chat_wcom").css("width","100%");
// $(".wcom input[type=text]").css({"padding":"3.2%","width":"40%","font-size":"20px","padding":"10px"});
//$("#"+item_id+" .side").css("width","100%");
$(".chat_leave").css("width","40%");
// $(".chat_leave").css("margin-left","30%");
$(".chat_mnav span").css("padding","1.2%");
$(" .chat_mnav").css("height","8%");
$(" .chat_close").css("display","none");
$(".chat_mnav span").css({"margin-right":"1.5%","width":"auto","padding":"3%","padding-left":"0"});
// $(".comstandin").css({"margin-top":"3%","padding":"0"});
$(".chat_side").css({"width":"100%","height":"100%","top":"0"});
      $(".chat_mnav h1").css({"padding-top":"3%", "margin-left":"3%"});

        $(".chat_enlarge").css({"height":"6%","width":"6%"});
        $(".chat_enlarge_standard").css({"display":"none"});
        $(".chat_enlarge_small").css({"display":"none"});
        $(".chat_enlarge_full").css({"display":"none"});
        $(".chat_enlarge_close").css({"display":"block","width":"100%"});



}



}

function chat_enlarge_small(id){
  var item_id = "chat_"+id.toString();

chat_enlarge_standard(id);


$("#"+item_id+" .chat_close").css("display","inline-block");
  $("#"+item_id).css({"width":"25%","height":"75.6%","right":"auto"});
 /* $("#"+item_id+" .msgs").css("width","25%");*/
  $("#"+item_id+" .comstandin").css("margin-top","13%");
  $("#"+item_id+" .chat_wcom").css("width","25%");
  $("#"+item_id+" .chat_side").css("width","100%");
  $("#"+item_id+" .chat_leave").css("width","70%");
//  $("#"+item_id+" .chat_leave").css("margin-left","15%");
  $("#"+item_id+" .chat_mnav span").css("padding","0");
  $("#"+item_id+" .chat_side a:nth-child(2)").css({"padding":"15px"});
  $("#"+item_id+" .chat_mnav").css("height","10%");
  $("#"+item_id+" .chat_mnav h1").css("padding","5% 0px 5% 5%");

      $("#"+item_id+" .chat_mnav span").css({
            "padding": "5%",
                "padding-left": "0",
                "padding-top":"3%",
                "width":"5%"
          });
  $("#"+item_id+" .chat_side").css({"width":"100%%","height":"90%"});
$("#"+item_id+" .chat_mnav h1").css("width","75%");

$("#"+item_id+" .msgs").css("display","none");
$("#"+item_id+" .chat_wcom").css("display","none");
$("#"+item_id+" .chat_enlarge").css("display","none");
$("#"+item_id).css("top","92%");
$("#"+item_id+" .chat_mnav span").css("display","none");
$("#"+item_id+" #chat_un_small").css("display","inline-block");
$("#"+item_id+" .chat_enlarge_close").css("display","none");
$("#"+item_id+" .chat_enlarge_small").css("display","block");

const mq = window.matchMedia( "(min-width: 1025px)" );

if (mq.matches) {
 $("#"+item_id).css({"width":"25%","height":"75.6%","right":"auto"});
  }else {
 $("#"+item_id).css({"width":"37%","height":"75.6%","right":"auto"});

  }

}
function chat_un_small(chat_id){
    var item_id = "chat_"+chat_id.toString();
      $("#"+item_id+" .chat_close").css("display","inline-block");
  $("#"+item_id+" .msgs").css("display","block");
  $("#"+item_id+" .chat_wcom").css({"display":"flex","display":"-webkit-flex"});
  $("#"+item_id+" .chat_enlarge").css({"display":"flex","display":"-webkit-flex"});
  $("#"+item_id).css({"top": "auto"," bottom":"0"});
$("#"+item_id+" #chat_un_small").css("display","none");
$("#"+item_id+" .chat_mnav span").css("display","inline-block");

const mq = window.matchMedia( "(min-width: 1025px)" );

if (mq.matches) {
 $("#"+item_id+" .chat_wcom").css("width","25%");
  }else {
 $("#"+item_id+" .chat_wcom").css("width","37%");

  }

}

function chat_action(obj){
$(obj).css("width","100%");

}

function chat_action_negative(obj){
$(obj).css("width","0");

}
