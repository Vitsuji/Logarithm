<?php

$username = "root";
$password = "";
$hostname = "localhost";
$db = "logarithm";

$conn = mysqli_connect($hostname, $username, $password);
mysqli_select_db($conn,$db);


if(!$conn){
die("Connection Failed".mysqli_connect_error());
}
