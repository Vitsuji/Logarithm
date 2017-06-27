<?php

$username = "id1251041_userd";
$password = "pop123";
$hostname = "localhost"; 


$conn = mysqli_connect($hostname, $username, $password);
 
if(!$conn){
die("Connection Failed".mysqli_connect_error());
}