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
$(".crechatform").fadeIn(500);
    });

    $(".crepost2").on("click",function() {
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
        $(".chatbool").remove();
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
