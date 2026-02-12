<?php
session_start();
require_once "db.php";

if (!isset($_GET['note_id'])) {
    echo json_encode([]);
    exit;
}

$note_id = (int)$_GET['note_id'];

$comments = mysqli_query($conn, "
    SELECT username, comment, 
           DATE_FORMAT(created_at, '%M %d, %Y - %h:%i %p') as formatted_date 
    FROM note_comments 
    WHERE note_id = $note_id 
    ORDER BY created_at DESC
");

$output = [];
while ($comment = mysqli_fetch_assoc($comments)) {
    $output[] = [
        'username' => htmlspecialchars($comment['username']),
        'comment' => htmlspecialchars($comment['comment']),
        'date' => $comment['formatted_date']
    ];
}

header('Content-Type: application/json');
echo json_encode($output);
?>