<?php

$server = "localhost";
$user ="root";
$password = "";
$db = "employee";
    
$con = mysqli_connect($server, $user, $password, $db);

if(!$con){
    die("Connection failed: ");
}
?>