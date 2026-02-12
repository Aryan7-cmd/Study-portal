<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

$note_id = (int)$_POST['note_id'];
$username = mysqli_real_escape_string($conn, $_SESSION['user']);

// Check if already liked
$check = mysqli_query($conn, "SELECT id FROM note_likes WHERE note_id = $note_id AND username = '$username'");

if (mysqli_num_rows($check) == 0) {
    // Add like
    mysqli_query($conn, "INSERT INTO note_likes (note_id, username) VALUES ($note_id, '$username')");
    
    // Get updated like count
    $count_result = mysqli_query($conn, "SELECT COUNT(*) as count FROM note_likes WHERE note_id = $note_id");
    $count_row = mysqli_fetch_assoc($count_result);
    
    echo json_encode([
        'action' => 'liked',
        'like_count' => $count_row['count']
    ]);
} else {
    // Remove like
    mysqli_query($conn, "DELETE FROM note_likes WHERE note_id = $note_id AND username = '$username'");
    
    // Get updated like count
    $count_result = mysqli_query($conn, "SELECT COUNT(*) as count FROM note_likes WHERE note_id = $note_id");
    $count_row = mysqli_fetch_assoc($count_result);
    
    echo json_encode([
        'action' => 'unliked',
        'like_count' => $count_row['count']
    ]);
}
?>