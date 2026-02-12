<?php
require 'auth.php';
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Students Study Website</title>
    <link rel="stylesheet" href="style.css">
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
    padding: 4px 16px;
    border-radius: 20px;
    background: rgba(56, 189, 248, 0.12);
    list-style: none;
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

    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome to Tech Masters</h1>
        <p>Your one-stop solution for notes, quizzes, and exam preparation.</p><br>
        <a href="subjects.php" class="btn">Get Started</a>
        <div class="hero-badges">
    <span>📚 Study Focused</span>
    <span>🤖 AI Assisted</span>
    <span>📝 Notes + Quizzes</span>
</div>

    </section>

    <!-- Features Section -->
    
<section class="hero2">
  <div class="hero2-content">
    <h2>Your Smart Study Companion</h2>

    <p>
      Tech Masters is a modern study portal designed to help students organize
      their academic life in one simple and powerful platform.
    </p>

    <p>
      With easy note management, you can upload, download, and revise study
      materials anytime, anywhere — making learning more efficient and stress-free.
    </p>

    <p>
      Our platform supports subject-wise notes, topic-based keywords, and quick
      searching, so you spend less time finding materials and more time learning.
    </p>

    <p>
      Tech Masters also includes quizzes and timetables to help you prepare better,
      track your progress, and stay consistent with your studies.
    </p>

    <p>
      Whether you are preparing for exams, managing daily classes, or revising
      important topics, Tech Masters keeps everything structured, accessible,
      and secure for your academic success.
    </p>
  </div>

  <div class="hero2-image">
    <img src="images/images (1).jpg" alt="Study Portal Illustration">
  </div>
</section>
<section class="subjects">
    <h2>Explore Subjects</h2>

    <div class="subject-grid">
        <div class="subject-card">📘 Mathematics</div>
        <div class="subject-card">🧪 Chemistry</div>
        <div class="subject-card">🧬 Biology</div>
        <div class="subject-card">💻 Computer Science</div>
        <div class="subject-card">📊 Economics</div>
        <div class="subject-card">🏢 Business Studies</div>
    </div>
</section>
<!--Ai preview sec-->
<section class="ai-preview">
    <h2>AI Study Assistant</h2>
    <p>Ask academic questions and get student-friendly answers.</p>

    <div class="ai-box">
        <div class="ai-q">AI Study Assistant:</div>
        <div class="ai-a">
            “Ask questions. Understand concepts. Learn smarter — not harder.”
        </div>
    </div>

    <a href="ai_search.php" class="ai-btn">Try AI Study Help</a>
</section>

    <section class="features">
        <div class="card">
            <h3>📘 Notes</h3>
            <p>Easy-to-understand notes for all subjects.</p>
        </div>
        <div class="card">
            <h3>🧠 Quiz</h3>
            <p>Test your knowledge with online quizzes.</p>
        </div>
        <div class="card">
            <h3>📅 Timetable</h3>
            <p>Plan your study schedule effectively.</p>
        </div>
    </section>
</body>
</html>
