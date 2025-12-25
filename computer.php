<?php
require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Computer Science – Important Concepts</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Inter',sans-serif}
    body{background:linear-gradient(135deg,#f8fafc,#e5edf7);min-height:100vh;color:#0f172a}

    .header{background:#020617;color:#fff;padding:24px 40px}
    .header a{color:#c7d2fe;text-decoration:none;font-size:14px;background:rgba(255,255,255,0.12);padding:8px 14px;border-radius:8px}
    .header h1{font-size:28px;margin-top:10px}
    .header p{color:#a5b4fc;margin-top:6px}

    .container{max-width:1200px;margin:40px auto;padding:0 20px}

    .chapter{background:#fff;border-radius:16px;box-shadow:0 15px 35px rgba(0,0,0,.08);margin-bottom:30px;overflow:hidden}
    .chapter-title{background:linear-gradient(135deg,#4f46e5,#312e81);color:#fff;padding:18px 24px;font-size:20px;font-weight:600}
    .formula-list{padding:24px}

    .formula{background:#eef2ff;border-left:5px solid #4f46e5;border-radius:8px;padding:14px 18px;margin-bottom:14px}
    .formula h4{font-size:16px;margin-bottom:6px}
    .formula code{font-size:14px;color:#1e1b4b;display:block;white-space:pre-wrap}

    .tag{display:inline-block;background:#e0e7ff;color:#312e81;padding:4px 10px;border-radius:14px;font-size:12px;margin-bottom:10px}
  </style>
</head>
<body>

<header class="header">
  <a href="subjects.php">← Back to Subjects</a>
  <h1>Computer Science – Important Concepts</h1>
  <p>Chapter-wise key concepts, formulas & syntax for revision</p>
</header>

<main class="container">

<!-- Chapter 1 -->
<section class="chapter">
  <div class="chapter-title">Chapter 1: Programming Basics</div>
  <div class="formula-list">
    <span class="tag">Basics</span>
    <div class="formula"><h4>Algorithm</h4><code>Step-by-step procedure to solve a problem</code></div>
    <div class="formula"><h4>Pseudocode</h4><code>Human-readable representation of logic</code></div>
  </div>
</section>

<!-- Chapter 2 -->
<section class="chapter">
  <div class="chapter-title">Chapter 2: Data Types & Variables</div>
  <div class="formula-list">
    <span class="tag">Data</span>
    <div class="formula"><h4>Variable</h4><code>Container to store data values</code></div>
    <div class="formula"><h4>Data Types</h4><code>int, float, char, double, boolean</code></div>
  </div>
</section>

<!-- Chapter 3 -->
<section class="chapter">
  <div class="chapter-title">Chapter 3: Control Statements</div>
  <div class="formula-list">
    <span class="tag">Logic</span>
    <div class="formula"><h4>If Statement</h4><code>if(condition) { statements }</code></div>
    <div class="formula"><h4>Loop</h4><code>for(initialization; condition; increment)</code></div>
  </div>
</section>

<!-- Chapter 4 -->
<section class="chapter">
  <div class="chapter-title">Chapter 4: Data Structures</div>
  <div class="formula-list">
    <span class="tag">DSA</span>
    <div class="formula"><h4>Array</h4><code>Collection of same data type elements</code></div>
    <div class="formula"><h4>Stack</h4><code>LIFO (Last In First Out)</code></div>
    <div class="formula"><h4>Queue</h4><code>FIFO (First In First Out)</code></div>
  </div>
</section>

<!-- Chapter 5 -->
<section class="chapter">
  <div class="chapter-title">Chapter 5: Algorithms</div>
  <div class="formula-list">
    <span class="tag">Algorithms</span>
    <div class="formula"><h4>Time Complexity</h4><code>O(1), O(n), O(n²)</code></div>
    <div class="formula"><h4>Binary Search</h4><code>Time Complexity: O(log n)</code></div>
  </div>
</section>

<!-- Chapter 6 -->
<section class="chapter">
  <div class="chapter-title">Chapter 6: Database (DBMS)</div>
  <div class="formula-list">
    <span class="tag">Database</span>
    <div class="formula"><h4>Primary Key</h4><code>Uniquely identifies a record</code></div>
    <div class="formula"><h4>SQL Select</h4><code>SELECT * FROM table;</code></div>
  </div>
</section>

<!-- Chapter 7 -->
<section class="chapter">
  <div class="chapter-title">Chapter 7: Computer Networks</div>
  <div class="formula-list">
    <span class="tag">Networking</span>
    <div class="formula"><h4>IP Address</h4><code>Unique address of a device on network</code></div>
    <div class="formula"><h4>HTTP</h4><code>Protocol for web communication</code></div>
  </div>
</section>

</main>
</body>
</html>