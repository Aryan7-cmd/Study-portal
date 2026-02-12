<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $note_id = (int)$_POST['note_id'];
    $username = mysqli_real_escape_string($conn, $_SESSION['user']);
    $comment = mysqli_real_escape_string($conn, trim($_POST['comment']));
    
    if ($note_id > 0 && $comment !== '') {
        $query = "INSERT INTO note_comments (note_id, username, comment) VALUES ($note_id, '$username', '$comment')";
        mysqli_query($conn, $query);
        
        if (mysqli_affected_rows($conn) > 0) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "invalid";
    }
}
?>