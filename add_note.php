<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user'])) exit;

$title = $_POST['title'];
$description = trim($_POST['description']);
$keywords = trim($_POST['keywords']);
$user = $_SESSION['user'];

if ($description === "" || $keywords === "") exit;

$fileName = time() . "_" . $_FILES['file']['name'];
$path = "uploads/" . $fileName;
move_uploaded_file($_FILES['file']['tmp_name'], $path);

mysqli_query($conn,
    "INSERT INTO notes (title, description, keywords, file_path, created_by)
     VALUES ('$title', '$description', '$keywords', '$path', '$user')"
);

header("Location: notes.php");
