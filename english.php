<?php
require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>English – Important Concepts</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Inter',sans-serif}
    body{background:linear-gradient(135deg,#f8fafc,#e5edf7);min-height:100vh;color:#0f172a}

    .header{background:#7c2d12;color:#fff;padding:24px 40px}
    .header a{color:#ffedd5;text-decoration:none;font-size:14px;background:rgba(255,255,255,0.12);padding:8px 14px;border-radius:8px}
    .header h1{font-size:28px;margin-top:10px}
    .header p{color:#fed7aa;margin-top:6px}

    .container{max-width:1200px;margin:40px auto;padding:0 20px}

    .chapter{background:#fff;border-radius:16px;box-shadow:0 15px 35px rgba(0,0,0,.08);margin-bottom:30px;overflow:hidden}
    .chapter-title{background:linear-gradient(135deg,#ea580c,#9a3412);color:#fff;padding:18px 24px;font-size:20px;font-weight:600}
    .content-list{padding:24px}

    .content{background:#fff7ed;border-left:5px solid #ea580c;border-radius:8px;padding:14px 18px;margin-bottom:14px}
    .content h4{font-size:16px;margin-bottom:6px}
    .content p{font-size:14px;color:#7c2d12}

    .tag{display:inline-block;background:#ffedd5;color:#9a3412;padding:4px 10px;border-radius:14px;font-size:12px;margin-bottom:10px}
  </style>
</head>
<body>

<header class="header">
  <a href="subjects.php">← Back to Subjects</a>
  <h1>English – Important Concepts</h1>
  <p>Grammar rules, writing formats & literature basics</p>
</header>

<main class="container">

<section class="chapter">
  <div class="chapter-title">Chapter 1: Parts of Speech</div>
  <div class="content-list">
    <span class="tag">Grammar</span>
    <div class="content"><h4>Noun</h4><p>Name of a person, place, animal or thing</p></div>
    <div class="content"><h4>Verb</h4><p>Shows action or state of being</p></div>
    <div class="content"><h4>Adjective</h4><p>Describes a noun</p></div>
  </div>
</section>

<section class="chapter">
  <div class="chapter-title">Chapter 2: Tenses</div>
  <div class="content-list">
    <span class="tag">Grammar</span>
    <div class="content"><h4>Present Tense</h4><p>Action happening now</p></div>
    <div class="content"><h4>Past Tense</h4><p>Action completed in the past</p></div>
    <div class="content"><h4>Future Tense</h4><p>Action that will happen</p></div>
  </div>
</section>

<section class="chapter">
  <div class="chapter-title">Chapter 3: Active & Passive Voice</div>
  <div class="content-list">
    <span class="tag">Voice</span>
    <div class="content"><h4>Active Voice</h4><p>Subject performs the action</p></div>
    <div class="content"><h4>Passive Voice</h4><p>Subject receives the action</p></div>
  </div>
</section>

<section class="chapter">
  <div class="chapter-title">Chapter 4: Direct & Indirect Speech</div>
  <div class="content-list">
    <span class="tag">Speech</span>
    <div class="content"><h4>Direct Speech</h4><p>Exact words of the speaker</p></div>
    <div class="content"><h4>Indirect Speech</h4><p>Reported form of speech</p></div>
  </div>
</section>

<section class="chapter">
  <div class="chapter-title">Chapter 5: Writing Skills</div>
  <div class="content-list">
    <span class="tag">Writing</span>
    <div class="content"><h4>Essay</h4><p>Structured writing on a topic</p></div>
    <div class="content"><h4>Letter</h4><p>Formal or informal communication</p></div>
  </div>
</section>

</main>
</body>
</html>
