$(".btn-style").click(function() {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        var user = $(".maininput[name=username]").val();
        var em = $(".maininput[name=email]").val();
        var pass = $(".maininput[name=password]").val();

        var error_log = 0;

        if (!(/\S/.test(user))) {

$(".maininput[name=username]").css("border-color","red");
error_log +=1;
}else{
        $(".maininput[name=username]").css("border-color","#d7d7d7")
}

if (!(/\S/.test(em))) {
$(".maininput[name=email]").css("border-color","red");
error_log +=1;

}else{
        $(".maininput[name=email]").css("border-color","#d7d7d7");
        console.log("norm");
}

if (!(/\S/.test(pass))) {
$(".maininput[name=password]").css("border-color","red");
error_log +=1;

}else{

        if(!em.match(re)) {
                $(".maininput[name=email]").val("");
                $(".maininput[name=email]").attr("placeholder", "Invalid Email*");
                $('.maininput[name=email]').addClass('taken');
                error_log +=1;
   }else{
                   $(".maininput[name=password]").css("border-color","#d7d7d7");
   }

}

if(!error_log >0 ){
        $.post("checker.php",
                {
                  username: user,
                  email: em
                },
                function(data){
                    if(data == 0){
                            $("#holderm form").submit();
                    }else if (data == 1) {
                            //username taken
                              $(".maininput[name=username]").val("");
                              $(".maininput[name=username]").attr("placeholder", "Username currently taken*");
                              $('.maininput[name=username]').addClass('taken');
                    }else if(data == 2){
                            $(".maininput[name=email]").val("");
                            $(".maininput[name=email]").attr("placeholder", "Email currently in use*");
                            $('.maininput[name=email]').addClass('taken');

                    }else{
                            $(".maininput[name=username]").val("");
                            $(".maininput[name=username]").attr("placeholder", "Username currently taken*");
                            $('.maininput[name=username]').addClass('taken');

                            $(".maininput[name=email]").val("");
                            $(".maininput[name=email]").attr("placeholder", "Email currently in use*");
                            $('.maininput[name=email]').addClass('taken');
                    }


            });
    }

});
