<?php

include 'dbconnect.php';
session_start();

$username = $_SESSION['username'];
$post_index = $_REQUEST["q"];
$oper = $_REQUEST["oper"];


if($oper == "mypage"){
        $statis_oper = 1;
}else if($oper == "target"){
        $statis_oper = 2;
}else{
        $statis_oper = 0;
}



if($post_index === null){
        echo "Go Away";
}else{
        $post_data = "SELECT * FROM `posts` WHERE `post_index` = '$post_index'";
        $post_query = mysqli_query($conn,$post_data);

        $post_row = mysqli_fetch_assoc($post_query);

        $post_order = $post_row['post_order'];
        $post_order_arr = explode(",",$post_order);

        $post_authr = $post_row['post_authr'];


        $post_img = $post_row['img_names'];
        $post_img_arr = explode(",",$post_img);

        $post_title = $post_row['post_title'];
        $post_content = $post_row['post_content'];
        $post_content_arr = explode("<!--//-->",$post_content);
        $start = 0;

        $true_content = array();

        $check_like = "SELECT * FROM `post_relationship` WHERE `post` = '$post_index' AND `user` ='$username'";
        $checkq = mysqli_query($conn,$check_like);
        $check_num = mysqli_num_rows($checkq);


        while (count($post_content_arr) > $start) {

                if(!($post_content_arr[$start] === null)){
                        $renew_p = "<div class='paragraph'>$post_content_arr[$start]</div>";

                        array_push($true_content,$renew_p);


                        }

                $start++;
        }


        $master_output = "";
        $start = 0;
        while(count($post_order_arr) > $start){
                $argument = explode("_",$post_order_arr[$start]);

                if($argument[1] == "text"){
                        $master_output .= $true_content[$argument[2]+1];
                }else{
                        $open = $argument[2];
                        $master_output .= "<img src='$post_img_arr[$start]'>";
                }

                $start++;


        }

        $master_output = "<div class='post_main'><div class='post_content'>".$master_output."</div>";
        $master_output = "
        <div class='tcent2'><h2>$post_title</h2></div>

        <div class='post_close' onclick='post_close()'><i class='material-icons'>close</i></div>".$master_output."</div>";


        $master_output .="
        <div class='imperative_additions'>

                <div class='additional_post_values'>
                <div class='specific_additional_post_values' onclick='receivepostcom($post_index)'>Comments</div>
                <div class='specific_additional_post_values'><form method='post' action='mypage.php'><button style='text-shadow:none;' value='$post_authr' name='userlink' class='subm_as_text'>$post_authr</buttton></form></div>
                <div class='specific_additional_post_values' onclick='post_like_active($post_index,$statis_oper)'>Likes: $check_num</div>
                </div>

                <div class='post_comments'>

                <div id='pcom'></div>

                <form method='post' id='post_comform'>
                <div class='wcom wcom2'>
                <input onkeypress='check_send_post(event,$post_index)' maxlength='140' id='postcomidin' type='text' class='comin_post' placeholder='My comment...' name='sendcom' autocapitalize='off' autocorrect='off'>
                <input type='text' style='display:none;' name='post_index' value='$post_index'>
                </div>
                </form>

                </div>
                </div>
                </div>
                ";

        echo $master_output;




}
