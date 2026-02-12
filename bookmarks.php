<?php
require 'auth.php';
require_once "db.php";
$user = $_SESSION['user'];

// Get user's bookmarked notes
$result = mysqli_query($conn, "
    SELECT notes.*, 
           users.email as creator_email,
           (SELECT COUNT(*) FROM note_likes WHERE note_likes.note_id = notes.id) as like_count,
           (SELECT COUNT(*) FROM note_comments WHERE note_comments.note_id = notes.id) as comment_count,
           (SELECT COUNT(*) FROM note_bookmarks WHERE note_bookmarks.note_id = notes.id) as bookmark_count,
           (SELECT COUNT(*) FROM note_likes WHERE note_likes.note_id = notes.id AND note_likes.username = '$user') > 0 as user_liked,
           (SELECT COUNT(*) FROM note_bookmarks WHERE note_bookmarks.note_id = notes.id AND note_bookmarks.username = '$user') > 0 as user_bookmarked,
           note_bookmarks.created_at as bookmarked_date
    FROM notes 
    JOIN users ON notes.created_by = users.username
    JOIN note_bookmarks ON note_bookmarks.note_id = notes.id AND note_bookmarks.username = '$user'
    ORDER BY note_bookmarks.created_at DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Bookmarks - Tech Masters</title>
    <link rel="stylesheet" href="bookmark.css">
    <style>
.nav-links details > div {
    background: #0f172a !important;
    padding: 10px !important;
    border-radius: 6px !important;
    min-width: 140px !important;
    box-shadow: 0 8px 20px rgba(0,0,0,0.4) !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
}

.nav-links details > div a {
    color: white !important;
    padding: 8px 12px !important;
    margin: 5px 0 !important;
    display: block !important;
    text-decoration: none !important;
    border-radius: 6px !important;
    transition: all 0.3s ease !important;
    background: transparent !important;
}

.nav-links details > div a:hover {
    background: rgba(255, 255, 255, 0.1) !important;
    color: white !important;
    transform: translateX(5px) !important;
}
        </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">Tech Masters</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="subjects.php">Subjects</a></li>
            <li><a href="notes.php">Notes</a></li>
            <li><a href="quiz.php" style="color: #facc15;">Quiz</a></li>
            <li><a href="ai_search.php" style="color: orange;">AI Help</a></li>
            <li><a href="bookmarks.php" style="color: #ffc107;">🔖 Bookmarks</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li style="position: relative;">
                <details>
                    <summary style="
                        cursor: pointer;
                        color: rgb(217, 231, 238);
                        font-weight: 600;
                        padding: 4px 15px;
                        border-radius: 20px;
                        background: rgba(56, 189, 248, 0.15);
                        border: 1px solid rgba(56, 189, 248, 0.3);
                        list-style: none;
                        transition: all 0.3s ease;
                    ">
                        <?= htmlspecialchars($username) ?>
                    </summary>
                    <div style="
                        position: absolute;
                        top: 50px;
                        right: 0;
                        background: white;
                        padding: 1rem;
                        border-radius: 10px;
                        min-width: 160px;
                        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
                        z-index: 999;
                        border: 1px solid rgba(0, 0, 0, 0.05);
                    ">
                        <a href="profile.php" style="display: block; padding: 10px 15px; color: #2d3748; text-decoration: none; border-radius: 6px; transition: all 0.3s ease; margin: 5px 0;">
                            Profile
                        </a>
                        <a href="logout.php" style="display: block; padding: 10px 15px; color: #2d3748; text-decoration: none; border-radius: 6px; transition: all 0.3s ease; margin: 5px 0;">
                            Logout
                        </a>
                    </div>
                </details>
            </li>
        </ul>
    </nav>

    <div class="bookmarks-section">
        <div class="header">
            <h1>🔖 My Saved Notes</h1>
            <a href="notes.php" class="back-btn">← Back to Notes</a>
        </div>
        
        <div class="notes-grid">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($note = mysqli_fetch_assoc($result)): ?>
                    <div class="note-card">
                        <div class="note-header">
                            <h3><?= htmlspecialchars($note['title']) ?></h3>
                            <span class="creator-badge">
                                👤 <?= htmlspecialchars(explode('@', $note['creator_email'])[0]) ?>
                            </span>
                        </div>
                        
                        <div class="bookmark-date">
                            <i class="fas fa-bookmark" style="color: #f59e0b;"></i> Saved on <?= date('M d, Y', strtotime($note['bookmarked_date'])) ?>
                        </div>
                        
                        <div class="keywords">
                            <strong>📌 Topic:</strong> <?= htmlspecialchars($note['keywords']) ?>
                        </div>
                        
                        <div class="description">
                            <?= nl2br(htmlspecialchars(substr($note['description'], 0, 150))) ?><?= strlen($note['description']) > 150 ? '...' : '' ?>
                        </div>
                        
                        <div class="stats-row">
                            <span>❤️ <?= $note['like_count'] ?></span>
                            <span>💬 <?= $note['comment_count'] ?></span>
                            <span>🔖 <?= $note['bookmark_count'] ?></span>
                        </div>
                        
                        <div class="note-actions">
                            <a href="preview_note.php?id=<?= $note['id'] ?>" class="preview-btn">👁️ Preview</a>
                            <a href="<?= htmlspecialchars($note['file_path']) ?>" download class="download-btn">📥 Download</a>
                            <button onclick="removeBookmark(<?= $note['id'] ?>, this)" class="remove-bookmark-btn">🗑️ Remove</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-bookmarks">
                    <h3>📭 No Saved Notes</h3>
                    <p>You haven't saved any notes yet.</p>
                    <a href="notes.php">Browse Notes</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function removeBookmark(noteId, btn) {
            fetch('bookmark.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'note_id=' + noteId
            })
            .then(response => response.json())
            .then(data => {
                if (data.action === 'unbookmarked') {
                    // Remove the card from view
                    const card = btn.closest('.note-card');
                    card.style.opacity = '0.5';
                    card.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        card.remove();
                        
                        // Check if no bookmarks left
                        const notesGrid = document.querySelector('.notes-grid');
                        if (notesGrid.children.length === 0) {
                            location.reload();
                        }
                    }, 300);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>