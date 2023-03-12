<?php
$servername ="localhost";
$database ="Business_school";
$user="root";
$password="";

$db=mysqli_connect($servername,$user,$password,$database);

if(!$db){
    die("Connection failed: ".mysqli_connect_error());
}

?>
