<?php

session_start();
include 'dbconnect.php';
$username = $_SESSION['username'];
$tags = $_REQUEST['tags'];

$post_tags_q = "SELECT * FROM  `posts`";
$post_info = mysqli_query($conn,$post_tags_q);
$post_arr = mysqli_fetch_assoc($post_info);

$post_tags = $post_arr['tags'];

if($post_tags === Null){

}else{

        $search_tags = explode(",",$tags);
        $query_tags = explode(",",$post_tags);

        $num_pair = 0;
        foreach ($search_tags as $stag) {
                foreach ($query_tags as $qtag) {
                        if($stag == $qtag){
                                $num_pair++;
                        }
                }
        }


        if($num_pair == count($search_tags)){
                $postprint = "";

                $tags_str = implode(",",$query_tags);

                $spec_q = "SELECT * FROM `posts` WHERE `tags` = '$tags_str'";
                $spec_r = mysqli_query($conn, $spec_q);
                $comrow = mysqli_fetch_array($spec_r);

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


                $check_like = "SELECT * FROM `post_relationship` WHERE `post` = '$post_index' AND `user` ='$username'";
                $checkq = mysqli_query($conn,$check_like);
                $check_num = mysqli_num_rows($checkq);



                $sql_rel = "SELECT * FROM `post_relationship` WHERE `post` = '$post_index'";
                $sql_relc = mysqli_query($conn,$sql_rel);
                $post_likes = mysqli_num_rows($sql_relc);

                $postprint .= "<div class='post_body' id='$post_index' >
                <div class='initial' onclick='post_active($post_index)'>";

                if($post_cover == "None"){

                        $postprint .= "<img class='post_back' style='background:#663399;'>";
                }else{


                        $postprint .= "<img class='post_back' src='$post_cover'>";
                }

                        $postprint .= "<h3>$post_title</h3>
                        <div class='post_halfcont'>$true_cont_v</div>

                </div>


                        <div class='post_tabs'>
                                $tag_result
                        </div>

                        <div class='other_controller'>

                        <div class='post_other'><form action='mypage.php' method='post'><button value='$post_authr' name='userlink' class='subm_as_text'>$post_authr</button></form></div>

                        <div class='post_other'><h5>$post_date</h5></div>";

                       if($check_num == 0){
                                       $postprint .= "<div class='post_other'><div class='post_likes post_open' onclick='post_like($post_index)'>$post_likes</div></div>";

                }else{

                 $postprint .= "<div class='post_other'><div class='post_likes post_liked' onclick='post_like($post_index)'>$post_likes</div></div>";
                }

                        $postprint .= "</div></div>";




                        echo $postprint;

        }else{echo "<h3>No results found</h3>";}//num_pair

}//else end








 ?>
