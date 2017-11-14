<?php
include 'dbconnect.php';


// Array with names
/*
$a[] = "Anna";
$a[] = "Brittany";
$a[] = "Cinderella";
$a[] = "Diana";
$a[] = "Eva";
$a[] = "Fiona";
$a[] = "Gunda";
$a[] = "Hege";
$a[] = "Inga";
$a[] = "Johanna";
$a[] = "Kitty";
$a[] = "Linda";
$a[] = "Nina";
$a[] = "Ophelia";
$a[] = "Petunia";
$a[] = "Amanda";
$a[] = "Raquel";
$a[] = "Cindy";
$a[] = "Doris";
$a[] = "Eve";
$a[] = "Evita";
$a[] = "Sunniva";
$a[] = "Tove";
$a[] = "Unni";
$a[] = "Violet";
$a[] = "Liza";
$a[] = "Elizabeth";
$a[] = "Ellen";
$a[] = "Wenche";
$a[] = "Vicky";
/*/

// get the q parameter from URL
$q = $_REQUEST["q"];

if($q === Null){
  //start echo chats
  $hint = "";
  $comp = "SELECT * FROM `chats` AND `privated` != 'Yes'";
  $compres = mysqli_query($conn,$comp);

  $commentprint = "";
  $commentnum = mysqli_num_rows($compres);
  if($commentnum == 0){
  $commentprint .= "<p id='nocoml'>No chats yet.</p>";
  }else{
  if($compres){
  $comrow = mysqli_fetch_array($compres);
  $chat_title = $comrow['title'];
  $chat_description = $comrow['description'];
  $chat_img = $comrow['img'];
  $chat_date = $comrow['date'];
  $chat_authr = $comrow['authr'];
  $chat_index = $comrow['index'];
  $chat_rand = (rand(1,99999999));
  $chat_rand = $chat_rand +(rand(1,878668)+rand(1,100))-rand(1,10);
  $err = "SELECT * FROM `chat_relationship` WHERE `chat` = '$chat_index'";
  $erre = mysqli_query($conn,$err);
  $num_users = mysqli_num_rows($erre);

  $hint .=  "<div class='chaty' >
  <form method='post' action='index.php' name='chat_lox' class='chat_loc'>
  <input id='disspell' type='text' name = 'chat_locy' value='$chat_index'/>
  </form>
    <div class='chatDesc' id='$chat_rand'>
  <div class='tit'>Creator: </div>
    <div class='iriss'><i id='close_chatn' onclick='closeChat($chat_rand)' class='material-icons'>close</i></div>

    <form action='mypage.php' method='post'>


    <div class='authr_name'><button value='$chat_authr' name='userlink' class='subm_as_text'>$chat_authr</button></div>
  </form>
  <div class='titd'><h3>Description</h3></div>
  <div class='description_chat'>$chat_description</div>
  </div>


  <span onclick='openChat($chat_rand)'>&#9776;</span>
  <div class='chatname'><h3>$chat_title</h3></div>
  <div class='chatback'></div>
  <div class='underlie'><p>Users: $num_users</p><p> Created: $chat_date</p></div>

  </div>";



  //comsres #1

  while($comrow = mysqli_fetch_array($compres)) {
    $chat_title = $comrow['title'];
    $chat_description = $comrow['description'];
    $chat_img = $comrow['img'];
    $chat_date = $comrow['date'];
    $chat_authr = $comrow['authr'];
    $chat_index = $comrow['index'];
    $chat_rand = (rand(1,99999999));
    $chat_rand = $chat_rand +(rand(1,878668)+rand(1,100))-rand(1,10);
    $err = "SELECT * FROM `chat_relationship` WHERE `chat` = '$chat_index'";
    $erre = mysqli_query($conn,$err);
    $num_users = mysqli_num_rows($erre);

    $hint  =   "<div class='chaty'>
    <form method='post' action='index.php' name='chat_lox' class='chat_loc'>
    <input id='disspell' type='text' name = 'chat_locy' value='$chat_index'/>
    </form>
      <div class='chatDesc' id='$chat_rand'>
    <div class='tit'>Creator: </div>
      <div class='iriss'><i id='close_chatn' onclick='closeChat($chat_rand)' class='material-icons'>close</i></div>

      <form action='mypage.php' method='post'>


      <div class='authr_name'><button value='John Brown' name='userlink' class='subm_as_text'>$chat_authr</button></div>
    </form>
    <div class='titd'><h3>Description</h3></div>
    <div class='description_chat'>$chat_description</div>
    </div>


    <span onclick='openChat($chat_rand)'>&#9776;</span>
    <div class='chatname'><h3>$chat_title</h3></div>
    <div class='chatback'style='background:url($chat_img);  background-size: cover;
      background-repeat: no-repeat;
      background-position: 50% 50%;'></div>
    <div class='underlie'><p>Users: $num_users</p><p> Created: $chat_date</p></div>

    </div>".$hint;
  }
  //end while



  //Add to commetn print
  }else{
  header("location:mypage.php");
  }
  }
  //end echo chat






}else{
$getnames = "SELECT * FROM `chats` WHERE `title` LIKE '$q%' AND `privated` != 'Yes' ";

$sql = mysqli_query($conn,$getnames);
$number_names = mysqli_num_rows($sql);

if($number_names == 0){
  $hint = "No chats found";
}elseif($number_names == 1){

  $comrow = mysqli_fetch_array($sql);
  $chat_title = $comrow['title'];
  $chat_description = $comrow['description'];
  $chat_img = $comrow['img'];
  $chat_date = $comrow['date'];
  $chat_authr = $comrow['authr'];
  $chat_index = $comrow['index'];
  $chat_rand = (rand(1,99999999));
  $chat_rand = $chat_rand +(rand(1,878668)+rand(1,100))-rand(1,10);
  $err = "SELECT * FROM `chat_relationship` WHERE `chat` = '$chat_index'";
  $erre = mysqli_query($conn,$err);
  $num_users = mysqli_num_rows($erre);

  $hint =  "<div class='chaty'>
  <form method='post' action='index.php' name='chat_lox' class='chat_loc'>
  <input id='disspell' type='text' name = 'chat_locy' value='$chat_index'/>
  </form>
    <div class='chatDesc' id='$chat_rand'>
  <div class='tit'>Creator: </div>
    <div class='iriss'><i id='close_chatn' onclick='closeChat($chat_rand)' class='material-icons'>close</i></div>

    <form action='mypage.php' method='post'>


    <div class='authr_name'><button value='John Brown' name='userlink' class='subm_as_text'>$chat_authr</button></div>
  </form>
  <div class='titd'><h3>Description</h3></div>
  <div class='description_chat'>$chat_description</div>
  </div>


  <span onclick='openChat($chat_rand)'>&#9776;</span>
  <div class='chatname'><h3>$chat_title</h3></div>
  <div class='chatback'style='background:url($chat_img);  background-size: cover;
    background-repeat: no-repeat;
    background-position: 50% 50%;'></div>
  <div class='underlie'><p>Users: $num_users</p><p> Created: $chat_date</p></div>

  </div>";




}else{
  $comrow = mysqli_fetch_array($sql);
  $chat_title = $comrow['title'];
  $chat_description = $comrow['description'];
  $chat_img = $comrow['img'];
  $chat_date = $comrow['date'];
  $chat_authr = $comrow['authr'];
  $chat_index = $comrow['index'];
  $chat_rand = (rand(1,99999999));
  $chat_rand = $chat_rand +(rand(1,878668)+rand(1,100))-rand(1,10);
  $err = "SELECT * FROM `chat_relationship` WHERE `chat` = '$chat_index'";
  $erre = mysqli_query($conn,$err);
  $num_users = mysqli_num_rows($erre);

  $hint =  "<div class='chaty'>
  <form method='post' action='index.php' name='chat_lox' class='chat_loc'>
  <input id='disspell' type='text' name = 'chat_locy' value='$chat_index'/>
  </form>
    <div class='chatDesc' id='$chat_rand'>
  <div class='tit'>Creator: </div>
    <div class='iriss'><i id='close_chatn' onclick='closeChat($chat_rand)' class='material-icons'>close</i></div>

    <form action='mypage.php' method='post'>


    <div class='authr_name'><button value='John Brown' name='userlink' class='subm_as_text'>$chat_authr</button></div>
  </form>
  <div class='titd'><h3>Description</h3></div>
  <div class='description_chat'>$chat_description</div>
  </div>


  <span onclick='openChat($chat_rand)'>&#9776;</span>
  <div class='chatname'><h3>$chat_title</h3></div>
  <div class='chatback'style='background:url($chat_img);  background-size: cover;
    background-repeat: no-repeat;
    background-position: 50% 50%;'></div>
  <div class='underlie'><p>Users: $num_users</p><p> Created: $chat_date</p></div>

  </div";



  //comsres #1

  while($comrow = mysqli_fetch_array($sql)) {
    $chat_title = $comrow['title'];
    $chat_description = $comrow['description'];
    $chat_img = $comrow['img'];
    $chat_date = $comrow['date'];
    $chat_authr = $comrow['authr'];
    $chat_index = $comrow['index'];
    $chat_rand = (rand(1,99999999));
    $chat_rand = $chat_rand +(rand(1,878668)+rand(1,100))-rand(1,10);
    $err = "SELECT * FROM `chat_relationship` WHERE `chat` = '$chat_index'";
    $erre = mysqli_query($conn,$err);
    $num_users = mysqli_num_rows($erre);

    $hint  =  "<div class='chaty'>
    <form method='post' action='index.php' name='chat_lox' class='chat_loc'>
    <input id='disspell' type='text' name = 'chat_locy' value='$chat_index'/>
    </form>
      <div class='chatDesc' id='$chat_rand'>
    <div class='tit'>Creator: </div>
      <div class='iriss'><i id='close_chatn' onclick='closeChat($chat_rand)' class='material-icons'>close</i></div>

      <form action='mypage.php' method='post'>


      <div class='authr_name'><button value='John Brown' name='userlink' class='subm_as_text'>$chat_authr</button></div>
    </form>
    <div class='titd'><h3>Description</h3></div>
    <div class='description_chat'>$chat_description</div>
    </div>


    <span onclick='openChat($chat_rand)'>&#9776;</span>
    <div class='chatname'><h3>$chat_title</h3></div>
    <div class='chatback'style='background:url($chat_img);  background-size: cover;
      background-repeat: no-repeat;
      background-position: 50% 50%;'></div>
    <div class='underlie'><p>Users: $num_users</p><p> Created: $chat_date</p></div>

    </div>".$hint;
  }
}


}





// Output "no suggestion" if no hint was found or output correct values
echo $hint;
?>
