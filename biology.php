<?php
require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Biology – Important Concepts</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Inter',sans-serif}
    body{background:linear-gradient(135deg,#f8fafc,#e5edf7);min-height:100vh;color:#0f172a}

    .header{background:#14532d;color:#fff;padding:24px 40px}
    .header a{color:#dcfce7;text-decoration:none;font-size:14px;background:rgba(255,255,255,0.12);padding:8px 14px;border-radius:8px}
    .header h1{font-size:28px;margin-top:10px}
    .header p{color:#bbf7d0;margin-top:6px}

    .container{max-width:1200px;margin:40px auto;padding:0 20px}

    .chapter{background:#fff;border-radius:16px;box-shadow:0 15px 35px rgba(0,0,0,.08);margin-bottom:30px;overflow:hidden}
    .chapter-title{background:linear-gradient(135deg,#22c55e,#166534);color:#fff;padding:18px 24px;font-size:20px;font-weight:600}
    .content-list{padding:24px}

    .content{background:#f0fdf4;border-left:5px solid #22c55e;border-radius:8px;padding:14px 18px;margin-bottom:14px}
    .content h4{font-size:16px;margin-bottom:6px}
    .content p{font-size:14px;color:#14532d}

    .tag{display:inline-block;background:#dcfce7;color:#166534;padding:4px 10px;border-radius:14px;font-size:12px;margin-bottom:10px}
  </style>
</head>
<body>

<header class="header">
  <a href="subjects.php">← Back to Subjects</a>
  <h1>Biology – Important Concepts</h1>
  <p>Chapter-wise key biology concepts for quick revision</p>
</header>

<main class="container">

<section class="chapter">
  <div class="chapter-title">Chapter 1: Cell – The Unit of Life</div>
  <div class="content-list">
    <span class="tag">Cell Biology</span>
    <div class="content"><h4>Cell</h4><p>Basic structural and functional unit of life</p></div>
    <div class="content"><h4>Cell Membrane</h4><p>Selectively permeable membrane</p></div>
  </div>
</section>

<section class="chapter">
  <div class="chapter-title">Chapter 2: Biomolecules</div>
  <div class="content-list">
    <span class="tag">Biochemistry</span>
    <div class="content"><h4>Carbohydrates</h4><p>Main source of energy</p></div>
    <div class="content"><h4>Proteins</h4><p>Made of amino acids</p></div>
    <div class="content"><h4>Lipids</h4><p>Energy storage molecules</p></div>
  </div>
</section>

<section class="chapter">
  <div class="chapter-title">Chapter 3: Human Physiology</div>
  <div class="content-list">
    <span class="tag">Physiology</span>
    <div class="content"><h4>Digestive System</h4><p>Breaks down food into simpler substances</p></div>
    <div class="content"><h4>Respiratory System</h4><p>Exchange of oxygen and carbon dioxide</p></div>
  </div>
</section>

<section class="chapter">
  <div class="chapter-title">Chapter 4: Plant Physiology</div>
  <div class="content-list">
    <span class="tag">Plants</span>
    <div class="content"><h4>Photosynthesis</h4><p>Process of food formation in plants</p></div>
    <div class="content"><h4>Transpiration</h4><p>Loss of water through stomata</p></div>
  </div>
</section>

<section class="chapter">
  <div class="chapter-title">Chapter 5: Genetics</div>
  <div class="content-list">
    <span class="tag">Genetics</span>
    <div class="content"><h4>Gene</h4><p>Unit of heredity</p></div>
    <div class="content"><h4>Mendel’s Law</h4><p>Principles of inheritance</p></div>
  </div>
</section>

<section class="chapter">
  <div class="chapter-title">Chapter 6: Evolution</div>
  <div class="content-list">
    <span class="tag">Evolution</span>
    <div class="content"><h4>Natural Selection</h4><p>Survival of the fittest</p></div>
    <div class="content"><h4>Adaptation</h4><p>Traits helping survival</p></div>
  </div>
</section>

<section class="chapter">
  <div class="chapter-title">Chapter 7: Ecology</div>
  <div class="content-list">
    <span class="tag">Environment</span>
    <div class="content"><h4>Ecosystem</h4><p>Community of organisms and environment</p></div>
    <div class="content"><h4>Food Chain</h4><p>Transfer of energy between organisms</p></div>
  </div>
</section>

</main>
</body>
</html>