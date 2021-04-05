<?php


$server= "localhost";
$user= "deb";
$password = "";
$database = "php_tutorial";

$con= mysqli_connect($server,$user,$password,$database);

if (!$con){

    echo mysqli_connect_error();
}


?>
