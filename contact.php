<?php
require 'auth.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact · Tech Masters</title>
    <link rel="stylesheet" href="contact.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            <li><a href="contact.php" >Contact</a></li>
            <li style="position: relative;">
                <details>
                    <summary>
                        <?= htmlspecialchars($username) ?>
                    </summary>
                    <div>
                        <a href="profile.php">Profile</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </details>
            </li>
        </ul>
    </nav>

    <main>
        <section class="contact-section">
            <h2>Get in touch</h2>
            <p>Have suggestions, feedback, or ideas? We'd love to hear from you.</p>

            <div class="contact-container">
                <form action="submit_form.php" method="post" class="contact-form">
                    <label for="name">Your name</label>
                    <input type="text" id="name" name="name" placeholder="enter your name" required>

                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" placeholder="enter your email" required>

                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="What is this regarding?" required>

                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>

                    <button type="submit">Send message</button>
                </form>
                <div class="contact-info">
                    <h3>Contact information</h3>
                    
                    <p><strong>Email</strong> Aryangurung037@gmail.com</p>
                    <p><strong>Phone</strong> 9861130687</p>
                    <p><strong>Address</strong> Lainchaur, Kathmandu</p>
                    
                    <h3>Follow us</h3>
                    <div class="abc">
                        <a href="https://www.facebook.com/s.a.g.a.r.tsu.311534" target="_blank">Facebook</a>
                        <a href="https://www.instagram.com/aashishsharma3300/" target="_blank">Instagram</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>