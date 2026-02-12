<?php
require 'auth.php';
require_once "db.php";
$user = $_SESSION['user'];

// Get all notes with like counts, comment counts, and bookmark counts
$result = mysqli_query($conn, "
    SELECT notes.*, 
           users.email as creator_email,
           (SELECT COUNT(*) FROM note_likes WHERE note_likes.note_id = notes.id) as like_count,
           (SELECT COUNT(*) FROM note_comments WHERE note_comments.note_id = notes.id) as comment_count,
           (SELECT COUNT(*) FROM note_bookmarks WHERE note_bookmarks.note_id = notes.id) as bookmark_count,
           (SELECT COUNT(*) FROM note_likes WHERE note_likes.note_id = notes.id AND note_likes.username = '$user') > 0 as user_liked,
           (SELECT COUNT(*) FROM note_bookmarks WHERE note_bookmarks.note_id = notes.id AND note_bookmarks.username = '$user') > 0 as user_bookmarked
    FROM notes 
    JOIN users ON notes.created_by = users.username
    ORDER BY notes.created_at DESC
");

// Get all comments for all notes
$comments_query = mysqli_query($conn, "
    SELECT * FROM note_comments 
    ORDER BY created_at DESC
");
$comments = [];
while ($comment = mysqli_fetch_assoc($comments_query)) {
    $comments[$comment['note_id']][] = $comment;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notes - Tech Masters</title>
    <link rel="stylesheet" href="notes.css">
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
    padding: 2px 10px;
    border-radius: 20px;
    background: rgba(56, 189, 248, 0.12);
   list-style:none;
">
    <?= htmlspecialchars($username) ?>
</summary>
        <div style="
            position: absolute;
            top: 35px;
            right: 0;
            background: #0f172a;
            padding: 10px;
            border-radius: 6px;
            min-width: 140px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
            z-index: 999;
        ">
            <a href="profile.php" style="display:block; margin-bottom:8px;">
                Profile
            </a>
            <a href="logout.php" style="display:block;">
                Logout
            </a>
        </div>
    </details>
</li>
            
        </ul>
    </nav>

    <div class="notes-section">
        <h2>📚 Study Notes</h2>
        
        <!-- Search Bar -->
        <input type="text" id="searchInput" placeholder="🔍 Search notes by title, topic, description or creator...">

        <!-- Add Note Form -->
        <h3>➕ Add New Note</h3>
        <form class="add-note-form" action="add_note.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <input type="text" name="title" placeholder="Subject (e.g., Mathematics)" required>
                <input type="text" name="keywords" placeholder="Topic (e.g., Calculus)" required>
            </div>
            <textarea name="description" placeholder="Write a detailed description of your notes..." required></textarea>
            <input type="file" name="file" required>
            <button type="submit">📤 Upload Note</button>
        </form>

        <!-- Notes Display -->
        <h3>📖 All Notes</h3>
        <div id="notesContainer" class="notes-grid">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($note = mysqli_fetch_assoc($result)): ?>
                    <div class="note-card" data-keywords="<?= htmlspecialchars(strtolower($note['keywords'])) ?>" data-note-id="<?= $note['id'] ?>">
                        <div class="note-header">
                            <h3><?= htmlspecialchars($note['title']) ?></h3>
                            <span class="creator-badge">
                                Created by: <?= htmlspecialchars(explode('@', $note['creator_email'])[0]) ?>
                            </span>
                        </div>
                        
                        <div class="keywords">
                            <strong>Topic:</strong> <?= htmlspecialchars($note['keywords']) ?>
                        </div>
                        
                        <div class="description">
                            <?= nl2br(htmlspecialchars($note['description'])) ?>
                        </div>
                        
                        <div class="note-actions">
                            <a href="preview_note.php?id=<?= $note['id'] ?>" class="preview-btn">
                                Preview
                            </a>
                            
                            <a class="download-btn" href="<?= htmlspecialchars($note['file_path']) ?>" download>
                                Download
                            </a>
                            
                            <?php if ($note['created_by'] === $user): ?>
                                <a class="delete-btn" href="delete_note.php?id=<?= $note['id'] ?>" 
                                   onclick="return confirm('Are you sure you want to delete this note? This action cannot be undone.')">
                                 Delete
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <div class="like-section">
                            <button onclick="toggleLike(<?= $note['id'] ?>, this)" 
                                    class="like-btn <?= $note['user_liked'] ? 'liked' : '' ?>">
                                <span>❤️</span>
                                <span class="like-count"><?= $note['like_count'] ?></span>
                            </button>
                            
                            <button onclick="toggleBookmark(<?= $note['id'] ?>, this)" 
                                    class="bookmark-btn <?= isset($note['user_bookmarked']) && $note['user_bookmarked'] ? 'bookmarked' : '' ?>">
                                <span>Bookmarks</span>
                                <span class="bookmark-count"><?= $note['bookmark_count'] ?? 0 ?></span>
                            </button>
                            
                            <span class="comment-count-text">💬 <?= $note['comment_count'] ?> <?= $note['comment_count'] == 1 ? 'comment' : 'comments' ?></span>
                        </div>
                        
                        <div class="comment-section">
                            <form onsubmit="addComment(event, <?= $note['id'] ?>, this)" class="comment-form">
                                <input type="text" class="comment-input" placeholder="Write a comment..." required>
                                <button type="submit" class="comment-submit-btn">Post</button>
                            </form>
                            
                            <button onclick="toggleComments(<?= $note['id'] ?>, this)" class="toggle-comments-btn">
                                💬 View Comments (<?= $note['comment_count'] ?>)
                            </button>
                            
                            <div id="comments-<?= $note['id'] ?>" class="comments-list">
                                <?php if (isset($comments[$note['id']]) && count($comments[$note['id']]) > 0): ?>
                                    <?php foreach ($comments[$note['id']] as $comment): ?>
                                        <div class="comment-item">
                                            <div class="comment-author">👤 <?= htmlspecialchars($comment['username']) ?></div>
                                            <div class="comment-text"><?= htmlspecialchars($comment['comment']) ?></div>
                                            <div class="comment-date">🕒 <?= date('M d, Y - h:i A', strtotime($comment['created_at'])) ?></div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="no-comments" style="color: #666; text-align: center; padding: 15px;">No comments yet. Be the first to comment!</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-notes">
                    <h3>📭 No Notes Yet</h3>
                    <p>Be the first to share your study notes with the community!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Like functionality - AJAX, no page refresh
        function toggleLike(noteId, btn) {
            // Disable button to prevent double clicking
            btn.disabled = true;
            
            fetch('like_note.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'note_id=' + noteId
            })
            .then(response => response.json())
            .then(data => {
                const likeCount = btn.querySelector('.like-count');
                
                if (data.action === 'liked') {
                    btn.classList.add('liked');
                    likeCount.textContent = data.like_count;
                } else if (data.action === 'unliked') {
                    btn.classList.remove('liked');
                    likeCount.textContent = data.like_count;
                }
                
                // Re-enable button
                btn.disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
                btn.disabled = false;
            });
        }

        // Bookmark functionality
        function toggleBookmark(noteId, btn) {
            btn.disabled = true;
            
            fetch('bookmark.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'note_id=' + noteId
            })
            .then(response => response.json())
            .then(data => {
                const bookmarkCount = btn.querySelector('.bookmark-count');
                
                if (data.action === 'bookmarked') {
                    btn.classList.add('bookmarked');
                    bookmarkCount.textContent = data.bookmark_count;
                } else if (data.action === 'unbookmarked') {
                    btn.classList.remove('bookmarked');
                    bookmarkCount.textContent = data.bookmark_count;
                }
                
                btn.disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
                btn.disabled = false;
            });
        }

        // Comment functionality - AJAX, no page refresh
        function addComment(event, noteId, form) {
            event.preventDefault();
            
            const input = form.querySelector('.comment-input');
            const comment = input.value.trim();
            
            if (comment === '') {
                alert('Please enter a comment');
                return;
            }
            
            const formData = new FormData();
            formData.append('note_id', noteId);
            formData.append('comment', comment);
            
            fetch('add_comment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                if (result === 'success') {
                    input.value = ''; // Clear input
                    
                    // Update comment count in button and text
                    const commentBtn = form.closest('.comment-section').querySelector('.toggle-comments-btn');
                    const commentCountText = form.closest('.note-card').querySelector('.comment-count-text');
                    
                    const countMatch = commentBtn.textContent.match(/\d+/);
                    const currentCount = countMatch ? parseInt(countMatch[0]) : 0;
                    const newCount = currentCount + 1;
                    
                    commentBtn.textContent = `💬 View Comments (${newCount})`;
                    commentCountText.innerHTML = `💬 ${newCount} ${newCount === 1 ? 'comment' : 'comments'}`;
                    
                    // Reload comments if they're currently visible
                    const commentsDiv = document.getElementById('comments-' + noteId);
                    if (commentsDiv.classList.contains('show')) {
                        loadComments(noteId);
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Toggle comments - FIXED: Only toggles selected note's comments without affecting others
        function toggleComments(noteId, btn) {
            const commentsDiv = document.getElementById('comments-' + noteId);
            
            if (commentsDiv.classList.contains('show')) {
                commentsDiv.classList.remove('show');
                // Extract the number from the button text
                const match = btn.textContent.match(/\d+/);
                const count = match ? match[0] : '0';
                btn.textContent = `💬 View Comments (${count})`;
            } else {
                commentsDiv.classList.add('show');
                btn.textContent = '💬 Hide Comments';
                loadComments(noteId);
            }
        }

        // Load comments via AJAX
        function loadComments(noteId) {
            const commentsDiv = document.getElementById('comments-' + noteId);
            
            fetch('get_comments.php?note_id=' + noteId)
            .then(response => response.json())
            .then(comments => {
                if (comments.length === 0) {
                    commentsDiv.innerHTML = '<p style="color: #666; text-align: center; padding: 15px;">No comments yet. Be the first to comment!</p>';
                } else {
                    let html = '';
                    comments.forEach(comment => {
                        html += `
                            <div class="comment-item">
                                <div class="comment-author">👤 ${comment.username}</div>
                                <div class="comment-text">${comment.comment}</div>
                                <div class="comment-date">🕒 ${comment.date}</div>
                            </div>
                        `;
                    });
                    commentsDiv.innerHTML = html;
                }
            })
            .catch(error => console.error('Error loading comments:', error));
        }

        // Search functionality
        document.addEventListener("DOMContentLoaded", () => {
            const searchInput = document.getElementById("searchInput");
            const notes = document.querySelectorAll(".note-card");

            if (searchInput) {
                searchInput.addEventListener("input", () => {
                    const query = searchInput.value.toLowerCase().trim();
                    
                    notes.forEach(note => {
                        const title = note.querySelector("h3").innerText.toLowerCase();
                        const description = note.querySelector(".description").innerText.toLowerCase();
                        const keywords = note.dataset.keywords.toLowerCase();
                        const creator = note.querySelector(".creator-badge").innerText.toLowerCase();
                        
                        const text = title + " " + description + " " + keywords + " " + creator;
                        
                        if (query === "") {
                            note.style.display = "flex";
                            note.style.flexDirection = "column";
                        } else {
                            if (text.includes(query)) {
                                note.style.display = "flex";
                                note.style.flexDirection = "column";
                            } else {
                                note.style.display = "none";
                            }
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>