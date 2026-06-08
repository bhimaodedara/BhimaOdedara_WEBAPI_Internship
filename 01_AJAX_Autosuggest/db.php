<?php
$host = "localhost"; 
$user = "root";
$pass = "";
$dbname = "ajaxdb"; 

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Database Connection Failed");
}
?>
