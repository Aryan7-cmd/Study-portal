<?php
require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mathematics – Important Formulas</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Inter',sans-serif}
    body{background:linear-gradient(135deg,#f8fafc,#e5edf7);min-height:100vh;color:#0f172a}

    .header{background:#1e3a8a;color:#fff;padding:24px 40px}
    .header a{color:#dbeafe;text-decoration:none;font-size:14px;background:rgba(255,255,255,0.12);padding:8px 14px;border-radius:8px}
    .header h1{font-size:28px;margin-top:10px}
    .header p{color:#bfdbfe;margin-top:6px}

    .container{max-width:1200px;margin:40px auto;padding:0 20px}

    .chapter{background:#fff;border-radius:16px;box-shadow:0 15px 35px rgba(0,0,0,.08);margin-bottom:30px;overflow:hidden}
    .chapter-title{background:linear-gradient(135deg,#2563eb,#1e40af);color:#fff;padding:18px 24px;font-size:20px;font-weight:600}
    .formula-list{padding:24px}

    .formula{background:#eff6ff;border-left:5px solid #2563eb;border-radius:8px;padding:14px 18px;margin-bottom:14px}
    .formula h4{font-size:16px;margin-bottom:6px}
    .formula code{font-size:15px;color:#1e3a8a}

    .tag{display:inline-block;background:#dbeafe;color:#1e40af;padding:4px 10px;border-radius:14px;font-size:12px;margin-bottom:10px}
  </style>
</head>
<body>

<header class="header">
  <a href="subjects.php">← Back to Subjects</a>
  <h1>Mathematics – Important Formulas</h1>
  <p>Chapter-wise important formulas for quick revision</p>
</header>

<main class="container">

<!-- Chapter 1 -->
<section class="chapter">
  <div class="chapter-title">Chapter 1: Algebra</div>
  <div class="formula-list">
    <span class="tag">Algebra</span>
    <div class="formula"><h4>Quadratic Formula</h4><code>x = (−b ± √(b² − 4ac)) / 2a</code></div>
    <div class="formula"><h4>Identity</h4><code>(a + b)² = a² + 2ab + b²</code></div>
  </div>
</section>

<!-- Chapter 2 -->
<section class="chapter">
  <div class="chapter-title">Chapter 2: Trigonometry</div>
  <div class="formula-list">
    <span class="tag">Trig</span>
    <div class="formula"><h4>sin²θ + cos²θ</h4><code>= 1</code></div>
    <div class="formula"><h4>tanθ</h4><code>= sinθ / cosθ</code></div>
  </div>
</section>

<!-- Chapter 3 -->
<section class="chapter">
  <div class="chapter-title">Chapter 3: Coordinate Geometry</div>
  <div class="formula-list">
    <span class="tag">Geometry</span>
    <div class="formula"><h4>Distance Formula</h4><code>√[(x₂−x₁)² + (y₂−y₁)²]</code></div>
    <div class="formula"><h4>Slope</h4><code>m = (y₂ − y₁) / (x₂ − x₁)</code></div>
  </div>
</section>

<!-- Chapter 4 -->
<section class="chapter">
  <div class="chapter-title">Chapter 4: Calculus</div>
  <div class="formula-list">
    <span class="tag">Calculus</span>
    <div class="formula"><h4>Derivative</h4><code>d/dx (xⁿ) = n xⁿ⁻¹</code></div>
    <div class="formula"><h4>Integral</h4><code>∫ xⁿ dx = xⁿ⁺¹ / (n + 1)</code></div>
  </div>
</section>

<!-- Chapter 5 -->
<section class="chapter">
  <div class="chapter-title">Chapter 5: Probability</div>
  <div class="formula-list">
    <span class="tag">Probability</span>
    <div class="formula"><h4>Probability</h4><code>P(E) = n(E) / n(S)</code></div>
  </div>
</section>

<!-- Chapter 6 -->
<section class="chapter">
  <div class="chapter-title">Chapter 6: Statistics</div>
  <div class="formula-list">
    <span class="tag">Statistics</span>
    <div class="formula"><h4>Mean</h4><code>Mean = Σx / n</code></div>
    <div class="formula"><h4>Standard Deviation</h4><code>σ = √(Σ(x − μ)² / n)</code></div>
  </div>
</section>

<!-- Chapter 7 -->
<section class="chapter">
  <div class="chapter-title">Chapter 7: Vectors</div>
  <div class="formula-list">
    <span class="tag">Vectors</span>
    <div class="formula"><h4>Dot Product</h4><code>a · b = |a||b|cosθ</code></div>
    <div class="formula"><h4>Cross Product</h4><code>|a × b| = |a||b|sinθ</code></div>
  </div>
</section>

</main>
</body>
</html>