<?php


$comp = "SELECT * FROM `posts` WHERE 1";
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
        $true_cont_v = $true_cont_v."...";
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


$postprint .= "<div class='post_body' id='$post_index' onclick='post_active($post_index)''>

        <div class='post_back' style='background: url($post_cover);'></div>
        <h3>$post_title</h3>
        <div class='post_halfcont'>$true_cont_v</div>
        <div class='post_tabs'>
                $tag_result
        </div>

        <div class='other_controller'>

        <div class='post_other'><form action='mypage.php' method='post'><button value='$post_authr' name='userlink' class='subm_as_text'>$post_authr</button></form></div>

        <div class='post_other'><h5>$post_date</h5></div>
        <div class='post_other'><div class='post_likes'>12</div></div>
        </div>

</div>";
}
}
