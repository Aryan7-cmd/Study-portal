<?php

require 'auth.php';
require_once "db.php";
$user = $_SESSION['user'];

$result = mysqli_query($conn, "SELECT * FROM notes ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Notes</title>
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
    <p class="subtitle">Explore high-quality notes shared by students</p><br>
    <input type="text" id="searchInput" placeholder="Search notes...">
<h2>Add Note</h2>



<form class="add-note-form" action="add_note.php" method="POST" enctype="multipart/form-data">

    <div class="form-row">
        <input type="text" name="title" placeholder="Subject" required>
        <input type="text" name="keywords" placeholder="Topic" required>
    </div>

    <textarea name="description" placeholder="Description" required></textarea>

    <input type="file" name="file" required>

    <button type="submit">Add Note</button>

</form>
<h2>Notes</h2>

<div id="notesContainer" class="notes-grid">

<?php while ($note = mysqli_fetch_assoc($result)): ?>
    <div class="note-card"
         data-keywords="<?= htmlspecialchars($note['keywords']) ?>">
        <h3><?= htmlspecialchars($note['title']) ?></h3>
       <p>Keywords: <?= htmlspecialchars($note['keywords']) ?></p><br>
        <p><?= htmlspecialchars($note['description']) ?></p>

        <a class="download-btn"
           href="<?= htmlspecialchars($note['file_path']) ?>"
           download>
            Download
        </a>

        <?php if ($note['created_by'] === $user): ?>
            <a class="delete-btn"
               href="delete_note.php?id=<?= $note['id'] ?>"
               onclick="return confirm('Delete this note?')">
                Delete
            </a>
        <?php endif; ?>

    </div>
<?php endwhile; ?>

</div>
        </div>
<script>
   
  document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInput");
  const notes = document.querySelectorAll(".note-card");

  searchInput.addEventListener("input", () => {
    const query = searchInput.value.toLowerCase().trim();

    notes.forEach(note => {
      const title = note.querySelector("h3").innerText.toLowerCase();
      const description = note.querySelector("p").innerText.toLowerCase();
      const keywords = note.dataset.keywords.toLowerCase();

      const text = title + " " + description + " " + keywords;

      if (query === "") {
        note.style.display = "block";
      } else {
        note.style.display = text.includes(query) ? "block" : "none";
      }
    });
  });
});
   
   
</script>

</body>
</html>
