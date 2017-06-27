<?php
$username = "id1251041_userd";
$password = "pop123";
$hostname = "localhost"; 


$conn = mysqli_connect($hostname, $username, $password);
 
if(!$conn){
die("Connection Failed".mysqli_connect_error());
}else{
 
$term = mysqli_real_escape_string($conn, $_REQUEST['term']);
 
if(isset($term)){
    $sql = "SELECT * FROM `id1251041_udata`.`userd` WHERE `username` LIKE '" . $term . "%'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p>" . $row['username'] . "</p>";
            }
            mysqli_free_result($result);
        } else{
            echo "<p>No Suggestions</p>";
        }
    } else{
        echo "ERROR: " . mysqli_error($conn);
    }
}
 
mysqli_close($conn);
}