<?php
require 'auth.php';
require_once "db.php";

$note_id = (int)$_GET['id'];
$user = $_SESSION['user'];

// Get note details
$result = mysqli_query($conn, "
    SELECT notes.*, users.email as creator_email 
    FROM notes 
    JOIN users ON notes.created_by = users.username 
    WHERE notes.id = $note_id
");
$note = mysqli_fetch_assoc($result);

if (!$note) {
    header("Location: notes.php");
    exit;
}

// Log view for analytics
mysqli_query($conn, "INSERT INTO note_views (note_id, username) VALUES ($note_id, '$user')");

// Get file extension
$file_ext = strtolower(pathinfo($note['file_path'], PATHINFO_EXTENSION));
$is_pdf = $file_ext == 'pdf';
$is_image = in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
$is_text = in_array($file_ext, ['txt', 'md', 'csv']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Preview - <?= htmlspecialchars($note['title']) ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background: #f5f5f5;
        }
        
        .navbar {
            background: #333;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
        }
        
        .preview-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 20px;
        }
        
        .preview-header {
            background: white;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .note-info h1 {
            margin-bottom: 10px;
            color: #333;
        }
        
        .note-meta {
            color: #666;
            font-size: 14px;
        }
        
        .note-meta span {
            margin-right: 20px;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
        }
        
        .btn {
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-download {
            background: #28a745;
            color: white;
        }
        
        .btn-back {
            background: #6c757d;
            color: white;
        }
        
        .preview-content {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            min-height: 500px;
        }
        
        /* PDF Viewer */
        .pdf-viewer {
            width: 100%;
            height: 800px;
            border: none;
        }
        
        /* Image Viewer */
        .image-viewer {
            max-width: 100%;
            max-height: 800px;
            display: block;
            margin: 0 auto;
        }
        
        /* Text Viewer */
        .text-viewer {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            white-space: pre-wrap;
            font-family: monospace;
            line-height: 1.6;
            max-height: 800px;
            overflow-y: auto;
        }
        
        .unsupported-format {
            text-align: center;
            padding: 50px;
            background: #f8f9fa;
            border-radius: 5px;
            color: #666;
        }
        
        .unsupported-format h3 {
            margin-bottom: 20px;
            color: #333;
        }
        
        .description-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        
        .description-box h3 {
            margin-bottom: 10px;
            color: #333;
        }
        
        @media (max-width: 768px) {
            .preview-header {
                flex-direction: column;
                gap: 15px;
            }
            
            .pdf-viewer {
                height: 500px;
            }
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
            <li><a href="quiz.php">Quiz</a></li>
            <li><a href="ai_search.php">AI Help</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li>
                <span style="color: white; font-weight: bold;"><?= htmlspecialchars($user) ?></span>
                <a href="logout.php" style="color: #ff9999; margin-left: 10px;">Logout</a>
            </li>
        </ul>
    </nav>
    
    <div class="preview-container">
        <div class="preview-header">
            <div class="note-info">
                <h1><?= htmlspecialchars($note['title']) ?></h1>
                <div class="note-meta">
                    <span>👤 <?= htmlspecialchars(explode('@', $note['creator_email'])[0]) ?></span>
                    <span>📌 <?= htmlspecialchars($note['keywords']) ?></span>
                    <span>📅 <?= date('M d, Y', strtotime($note['created_at'])) ?></span>
                </div>
            </div>
            <div class="action-buttons">
                <a href="notes.php" class="btn btn-back">← Back</a>
                <a href="<?= htmlspecialchars($note['file_path']) ?>" download class="btn btn-download">📥 Download</a>
            </div>
        </div>
        
        <div class="preview-content">
            <?php if ($is_pdf): ?>
                <iframe src="<?= htmlspecialchars($note['file_path']) ?>" class="pdf-viewer"></iframe>
                
            <?php elseif ($is_image): ?>
                <img src="<?= htmlspecialchars($note['file_path']) ?>" alt="<?= htmlspecialchars($note['title']) ?>" class="image-viewer">
                
            <?php elseif ($is_text): ?>
                <div class="text-viewer">
                    <?php
                    if (file_exists($note['file_path'])) {
                        echo htmlspecialchars(file_get_contents($note['file_path']));
                    } else {
                        echo "File not found.";
                    }
                    ?>
                </div>
                
            <?php else: ?>
                <div class="unsupported-format">
                    <h3>📁 Preview Not Available</h3>
                    <p>This file format cannot be previewed online.</p>
                    <p style="margin-top: 20px; font-size: 14px;">File type: .<?= strtoupper($file_ext) ?></p>
                    <a href="<?= htmlspecialchars($note['file_path']) ?>" download class="btn btn-download" style="margin-top: 20px;">📥 Download to View</a>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($note['description'])): ?>
                <div class="description-box">
                    <h3>📝 Description</h3>
                    <p style="color: #444; line-height: 1.6;"><?= nl2br(htmlspecialchars($note['description'])) ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>