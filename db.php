<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "study_portal"; 

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
   die("Database connection failed");
}
