<?php

session_start();
include 'dbconnect.php';
$chat_date = substr(date("l"), 0,3);
$chat_date .=", ".date("h:i");


if($_SESSION['username'] === Null){


}else {



if(isset($_POST['chat_leave']) ? $_POST['chat_leave'] : null){
        $username = $_SESSION['username'];
$chatToLeave = $_POST['chat_leave'];
$leavequery = "DELETE FROM `chat_relationship` WHERE `chat` = '$chatToLeave' AND `user` = '$username'";
if(mysqli_query($conn,$leavequery)){

        $message_import = "INSERT INTO `messages` (`chat`,`sender`,`msg`,`date`,`type`) VALUES ('$chatToLeave','$username','leave','$chat_date','info')";
        $message_iq = mysqli_query($conn,$message_import);

}//if leave chat


}//leave chat iis_get_service_state



}//chat index not null
 ?>
