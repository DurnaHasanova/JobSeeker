<?php

$servername = "localhost";
$username = "jobuser";
$password='OV]KXoDpA*Z@B4qR';
$database="job";

$connection=new mysqli($servername,$username, $password, $database);

if($connection->connect_error){
    //echo "erroroor";
    //$message=$connection->connect_error;
    //echo $message;
    //header("HTTP/1.1 301 Moved Permanently");
    //header("Location: error.php");
    die ("Connection failed :" .$connection->connect_error);
}

$imageDir='././images/';