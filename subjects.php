<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students Study Website</title>
    <link rel="stylesheet" href="subjects.css">
</head>
<body>

<nav class="navbar">
        <div class="logo">Tech Masters</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="subjects.php">Subjects</a></li>
            <li><a href="notes.php">Notes</a></li>
            <li><a href="quiz.php">Quiz</a></li>
              <li><a href="ai_search.php" style="color: orange;">AI Help</a></li>
            <li><a href="contact.php">Contact</a></li>
          <li><a href="logout.php" style="color: #5dbcc9ff;">Logout</a></li>
            
        </ul>
    </nav>
<!-- Subjects Section -->
<section class="subjects-section">
    <div class="subject-search">
    <input type="text" placeholder="Search subjects...">
</div>
    <h1>Explore your Subjects</h1>
    <p>Select a subject to explore study materials</p>

    <div class="subjects-container">

        <div class="subject-card">
    <span class="subject-badge">Science</span>

    <h3>Physics</h3>
    <p>Learn mechanics, motion, energy and real-world physics concepts.</p>

    <div class="progress">
        <span style="width: 65%"></span>
    </div>

    <a href="physics.php" class="subject-btn">Open Subject</a>
</div>

        <div class="subject-card">
    <span class="subject-badge">Science</span>

    <h3>Chemistry</h3>
    <p>Learn atomic structure, bonding, and practical chemistry concepts.</p>

    <div class="progress">
        <span style="width: 65%"></span>
    </div>

    <a href="chemistry.php" class="subject-btn">Open Subject</a>
</div>

        <div class="subject-card">
    <span class="subject-badge">Science</span>

    <h3>Maths</h3>
    <p>Learn equations, problem-solving, and real-world concepts.</p>

    <div class="progress">
        <span style="width: 65%"></span>
    </div>

    <a href="math.php" class="subject-btn">Open Subject</a>
</div>

        <div class="subject-card">
    <span class="subject-badge">Science</span>

    <h3>Computer</h3>
    <p>Learn programming, algorithms, and real-world tech skills.</p>

    <div class="progress">
        <span style="width: 65%"></span>
    </div>

    <a href="computer.php" class="subject-btn">Open Subject</a>
</div>
<div class="subject-card">
    <span class="subject-badge">literature</span>

    <h3>English</h3>
    <p>Learn grammar, literature, writing, and real-world communication skills.</p>

    <div class="progress">
        <span style="width: 65%"></span>
    </div>

    <a href="english.php" class="subject-btn">Open Subject</a>
</div>
<div class="subject-card">
    <span class="subject-badge">Science</span>

    <h3>Biology</h3>
    <p>Learn life processes, cells, genetics, and real-world biological concepts.</p>

    <div class="progress">
        <span style="width: 65%"></span>
    </div>

    <a href="biology.php" class="subject-btn">Open Subject</a>
</div>

    </div>
</section>
<script>
const searchInput = document.querySelector(".subject-search input");
const cards = document.querySelectorAll(".subject-card");

searchInput.addEventListener("keyup", () => {
    const value = searchInput.value.toLowerCase();

    cards.forEach(card => {
        const text = card.innerText.toLowerCase();
        card.style.display = text.includes(value) ? "block" : "none";
    });
});
</script>
</body>
</html>
