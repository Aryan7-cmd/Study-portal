<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us </title>
    <link rel="stylesheet" href="contact.css">
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

    <main>
        <section class="contact-section">
            <h2>Contact Us</h2><br>
            <p>Have suggestions and more ideas for the website? Reach out to us!</p>

            <div class="contact-container">
                <form action="submit_form.php" method="post" class="contact-form">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>

                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <button type="submit">Send Message</button>
                </form>

                <div class="contact-info">
                    <h3>Our Info</h3>
                    <p><strong>Email:</strong> Aryangurung037@gmail.com</p>
                    <p><strong>Phone:</strong> 9861130687</p>
                    <p><strong>Address:</strong> Lainchaur, Kathmandu</p><br><br>

                    <h3>Follow Us</h3>
                    <p class="abc">
                        <a href="https://www.facebook.com/s.a.g.a.r.tsu.311534" style="color: #0056b3;">Facebook</a> |
                        <a href="https://www.instagram.com/aashishsharma3300/" style="color: #dd38c2;">Instagram</a>
                    </p>
                </div>
            </div>
        </section>
    </main>

   
</body>
</html>
