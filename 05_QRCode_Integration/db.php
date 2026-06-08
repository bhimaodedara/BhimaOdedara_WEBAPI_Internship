<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "qrdemo";

$conn = mysqli_connect($host, $user, $password, $database);

if(!$conn)
{
    die("Connection Failed");
}

?>
