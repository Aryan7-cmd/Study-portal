<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "study_portal";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed");
}
?>
