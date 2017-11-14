<?php
session_start();
include 'dbconnect.php';

$oper = $_GET['oper'];

$username = $_SESSION['username'];

if($oper == "mypage"){
$comp = "SELECT * FROM `posts` WHERE `post_authr` = '$username'";
$statis_oper = 1;
}else{
$targety = $_SESSION['target'];
$comp = "SELECT * FROM `posts` WHERE `post_authr` = '$targety'";
$statis_oper = 2;
}

$compres = mysqli_query($conn,$comp);

$postprint = "";
$commentnum = mysqli_num_rows($compres);
if($commentnum == 0){
$postprint .= "<p id='nocoml'>No posts yet.</p>";
}else{
if($compres){


        $comrow = mysqli_fetch_array($compres);

        $post_title = $comrow['post_title'];
        $post_content = $comrow['post_content'];
        $post_cont_arr = explode("<!--//-->",$post_content);
        $start = 0;

        $true_content = array();

        while (count($post_cont_arr) > $start) {


                if(!($post_cont_arr[$start] === null)){
                        array_push($true_content,$post_cont_arr[$start]);


                        }

                $start++;
        }

        $true_cont_v = implode(" ",$true_content);

        if(strlen($true_cont_v > 173)){
                $true_cont_v = substr($true_cont_v, 0, 173)."...";
        }else{
                $true_cont_v = $true_cont_v;
        }


        $post_cover = $comrow['post_cover'];
        $post_date = $comrow['post_date'];
        $post_authr = $comrow['post_authr'];
        $post_index = $comrow['post_index'];
        $tags = $comrow['tags'];

        $tags_explode = explode(",",$tags);
        $start = 0;

        $tag_result = "";

        while(count($tags_explode) > $start){


                $tag_result .= "<div class='tab'>$tags_explode[$start]</div>";
                $start++;
        }


        $check_like = "SELECT * FROM `post_relationship` WHERE `post` = '$post_index' AND `user` = '$username'";
        $checkq = mysqli_query($conn,$check_like);
        $check_num = mysqli_num_rows($checkq);



        $sql_rel = "SELECT * FROM `post_relationship` WHERE `post` = '$post_index'";
        $sql_relc = mysqli_query($conn,$sql_rel);
        $post_likes = mysqli_num_rows($sql_relc);

        $postprint .= "<div class='post_body' id='$post_index' >
        <div class='initial' onclick='post_active($post_index,$statis_oper)'>";

        if($post_cover == "None"){

                $postprint .= "<img class='post_back' style='background:#663399;'>";
        }else{


                $postprint .= "<img class='post_back' src='$post_cover'>";
        }

        $postprint .=  "<h3>$post_title</h3>
                <div class='post_halfcont'>$true_cont_v</div>

        </div>


                <div class='post_tabs'>
                        $tag_result
                </div>

                <div class='other_controller'>

                <div class='post_other'><form action='mypage.php' method='post'><button value='$post_authr' name='userlink' class='subm_as_text'>$post_authr</button></form></div>

                <div class='post_other'><h5>$post_date</h5></div>";

               if($check_num == 0){

                $postprint .= "<div class='post_other'><div class='post_likes post_liked' onclick='post_like_spec($post_index,$statis_oper)'>$post_likes</div></div>";
        }else{
                $postprint .= "<div class='post_other'><div class='post_likes post_open' onclick='post_like_spec($post_index,$statis_oper)'>$post_likes</div></div>";

        }

                $postprint .= "</div></div>";






        while($comrow = mysqli_fetch_array($compres)) {

                $post_title = $comrow['post_title'];
                $post_content = $comrow['post_content'];
                $post_cont_arr = explode("<!--//-->",$post_content);
                $start = 0;

                $true_content = array();

                while (count($post_cont_arr) > $start) {


                        if(!($post_cont_arr[$start] === null)){
                                array_push($true_content,$post_cont_arr[$start]);


                                }

                        $start++;
                }

                $true_cont_v = implode(" ",$true_content);

                if(strlen($true_cont_v > 173)){
                        $true_cont_v = substr($true_cont_v, 0, 173)."...";
                }else{
                        $true_cont_v = $true_cont_v;
                }


                $post_cover = $comrow['post_cover'];
                $post_date = $comrow['post_date'];
                $post_authr = $comrow['post_authr'];
                $post_index = $comrow['post_index'];
                $tags = $comrow['tags'];

                $tags_explode = explode(",",$tags);
                $start = 0;

                $tag_result = "";

                while(count($tags_explode) > $start){


                        $tag_result .= "<div class='tab'>$tags_explode[$start]</div>";
                        $start++;
                }


                $check_like = "SELECT * FROM `post_relationship` WHERE `post` = '$post_index' AND `user` = '$username'";
                $checkq = mysqli_query($conn,$check_like);
                $check_num = mysqli_num_rows($checkq);



                $sql_rel = "SELECT * FROM `post_relationship` WHERE `post` = '$post_index'";
                $sql_relc = mysqli_query($conn,$sql_rel);
                $post_likes = mysqli_num_rows($sql_relc);

                $postprint .= "<div class='post_body' id='$post_index' >
                <div class='initial' onclick='post_active($post_index,$statis_oper)'>";

                if($post_cover == "None"){

                        $postprint .= "<img class='post_back' style='background:#663399;'>";
                }else{


                        $postprint .= "<img class='post_back' src='$post_cover'>";
                }

                $postprint .=  "<h3>$post_title</h3>
                        <div class='post_halfcont'>$true_cont_v</div>

                </div>


                        <div class='post_tabs'>
                                $tag_result
                        </div>

                        <div class='other_controller'>

                        <div class='post_other'><form action='mypage.php' method='post'><button value='$post_authr' name='userlink' class='subm_as_text'>$post_authr</button></form></div>

                        <div class='post_other'><h5>$post_date</h5></div>";

                       if($check_num == 0){

                        $postprint .= "<div class='post_other'><div class='post_likes post_liked' onclick='post_like_spec($post_index,$statis_oper)'>$post_likes</div></div>";
                }else{
                        $postprint .= "<div class='post_other'><div class='post_likes post_open' onclick='post_like_spec($post_index,$statis_oper)'>$post_likes</div></div>";

                }

                        $postprint .= "</div></div>";



}//end loop

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "Master output: ".$postprint;
fwrite($myfile, $txt);


fclose($myfile);


}//compress
}//not null


echo $postprint;
