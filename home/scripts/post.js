function post_active(post_id,operator) {


                var xmlhttp = new XMLHttpRequest();

                    xmlhttp.onreadystatechange = function(this_item_id) {
                      if (this.readyState == 4 && this.status == 200) {
                        //  document.getElementById(this_item_id).innerHTML = this.responseText;
                        $(".override_post").html(this.responseText);


                      }
              }.bind(xmlhttp, post_id);

if(operator == 0){
        var carb = "general";
}else if (operator == 1) {
        var carb  = "mypage";
}else if (operator == 2) {
        var carb = "target";
}
                    xmlhttp.open("GET","backend/loadpostactive.php?q="+post_id+"&oper="+carb,true);
                    xmlhttp.send();



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



$('.post_search input[type=text]').keyup(function(e){
   if(e.keyCode == 8){
       // user has pressed backspace
       var tag = $(".post_search input[type=text]").val();
       if(tag == ""){

               var cusid_ele = document.getElementsByClassName('tab_inputp');
             var len = cusid_ele.length;
             $(cusid_ele[len-1]).remove();
             count_tags();

       }

   }
   if(e.keyCode == 32){
       // user has pressed space
      // array.push('');

      var tag = $(".post_search input[type=text]").val();
      if(tag == " "){

      }else {
              var cusid_ele = document.getElementsByClassName('post_search');
            var len = cusid_ele.length;
            if(len >= 5){

            }else{

      $("#post_res_tag").append("<div class='tab_inputp'>"+tag+"</div>");
      $(".post_search input[type=text]").val("");
       count_tags();




   }
   }
   }


});




function post_load() {
        var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    $(".main_body").html(this.responseText);
  }
};
xhttp.open("POST", "backend/loadpost.php", true);
xhttp.send();
}


function post_load_target(operand) {
if(operand == 1){
        var carb = "mypage";
}else{
        var carb = "target";
}
        var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    $(".main_body").html(this.responseText);

  }
};
xhttp.open("GET", "backend/loadpostspec.php?oper="+carb, true);
xhttp.send();


}

function post_like(post_id){

        $.post("backend/post_like.php",
                {
                  id: post_id
                },
                function(data){
                    post_load();
            });


}


function post_like_spec(post_id,oper){

        $.post("backend/post_like.php",
                {
                  id: post_id
                },
                function(data){
                    post_load_target(oper);
            });


}


function post_like_active(post_id,op){

        $.post("backend/post_like.php",
                {
                  id: post_id
                },
                function(data){
                        if(op == 0){
                                    post_load();
                        }else{
                                post_load_target(op);
                        }

                    $(".specific_additional_post_values:nth-child(3)").html("Likes: "+data);
            });

            //send
            $(".wcom2 input[type=text]").keypress(function(event) {
                if (event.which == 13) {
                    event.preventDefault();


            }

            });


}


function receivepostcom(post_id) {
        $(".post_comments").slideToggle(300);
        $(".wcom2").toggleClass("disflex");

        if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $("#pcom").html(this.responseText);
                }
            };
            xmlhttp.open("GET", "backend/receivepostcom.php?id="+post_id, true);
            xmlhttp.send();

}


function check_send_post(e,id){
        if (e.keyCode == 13) {
               e.preventDefault();

               if($.post('backend/sendpostcom.php', $('#post_comform').serialize())){
               document.getElementById("postcomidin").value = "";
               receivepostcom(id);


               }

}

}

function count_tags() {
        var tags_raw = $("#post_res_tag").html();
        if(tags_raw == ""){
                post_load();
        }else{

              var cusid_ele = document.getElementsByClassName('tab_inputp');
              var len = cusid_ele.length;
              var hum = 0;

              var finalization = [];

              while(len > hum){
                      finalization.push($(cusid_ele[hum]).html());
                      hum++;
              }
              var fin = finalization.toString();


              var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          $(".main_body").html(this.responseText);
        }
      };

              xhttp.open("POST", "backend/loadpostbytag.php", true);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhttp.send("tags="+fin);
}
}
