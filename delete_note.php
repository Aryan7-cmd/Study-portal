<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user'])) exit;

$id = (int)$_GET['id'];
$user = $_SESSION['user'];

$q = mysqli_query($conn,
    "SELECT file_path FROM notes WHERE id=$id AND created_by='$user'"
);

if ($row = mysqli_fetch_assoc($q)) {
    unlink($row['file_path']);
    mysqli_query($conn, "DELETE FROM notes WHERE id=$id");
}

header("Location: notes.php");
