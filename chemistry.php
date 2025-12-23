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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chemistry – Important Concepts</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Inter',sans-serif}
    body{background:linear-gradient(135deg,#f8fafc,#e5edf7);min-height:100vh;color:#0f172a}

    .header{background:#14532d;color:#fff;padding:24px 40px}
    .header a{color:#dcfce7;text-decoration:none;font-size:14px;background:rgba(255,255,255,0.12);padding:8px 14px;border-radius:8px}
    .header h1{font-size:28px;margin-top:10px}
    .header p{color:#bbf7d0;margin-top:6px}

    .container{max-width:1200px;margin:40px auto;padding:0 20px}

    .chapter{
  background:#ffffff;
  border-radius:18px;
  box-shadow:0 10px 25px rgba(0,0,0,0.08);
  margin-bottom:32px;
  overflow:hidden;
  transition:transform 0.25s ease, box-shadow 0.25s ease;
}

.chapter:hover{
  transform:translateY(-4px);
  box-shadow:0 18px 40px rgba(0,0,0,0.12);
}
   .chapter-title{
    background: linear-gradient(135deg, #16a34a, #065f46);
    color: #fff;
    padding: 22px 30px;   
    font-size: 20px;
    font-weight: 600;
}
.formula-list{
    padding: 28px 32px 32px;  
}
    .content
    {background:#f0fdf4;
        border-left:5px solid #22c55e;
        border-radius:8px;
        padding:14px 18px;
        margin-bottom:14px
    }
    .content h4
    {font-size:16px;
        margin-bottom:6px
    }
    .content p{
        font-size:14px;
        color:#14532d}

    .tag{display:inline-block;background:#dcfce7;color:#166534;padding:4px 10px;border-radius:14px;font-size:12px;margin-bottom:10px}
  </style>
</head>
<body>

<header class="header">
  <a href="subjects.php">← Back to Subjects</a>
  <h1>Chemistry – Important Concepts</h1>
  <p>Chapter-wise key biology concepts for quick revision</p>
</header>

<main class="container">

<!-- Chapter 1 -->
<section class="chapter">
  <div class="chapter-title">Chapter 1: Solid State</div>
  <div class="formula-list">
    <span class="tag">Physical Chemistry</span>
    <div class="formula"><h4>Density of Unit Cell</h4><code>Density = (Z × M) / (a³ × Nₐ)</code></div>
    <div class="formula"><h4>Edge Length (Cubic)</h4><code>a = 2r (simple), 4r/√3 (BCC), 2√2r (FCC)</code></div>
  </div>
</section>

<!-- Chapter 2 -->
<section class="chapter">
  <div class="chapter-title">Chapter 2: Solutions</div>
  <div class="formula-list">
    <span class="tag">Solutions</span>
    <div class="formula"><h4>Molarity</h4><code>M = n / V</code></div>
    <div class="formula"><h4>Molality</h4><code>m = n / mass of solvent (kg)</code></div>
    <div class="formula"><h4>Raoult’s Law</h4><code>P = XₐPₐ°</code></div>
  </div>
</section>

<!-- Chapter 3 -->
<section class="chapter">
  <div class="chapter-title">Chapter 3: Electrochemistry</div>
  <div class="formula-list">
    <span class="tag">Electrochemistry</span>
    <div class="formula"><h4>Nernst Equation</h4><code>E = E° − (0.059/n) log Q</code></div>
    <div class="formula"><h4>Gibbs Free Energy</h4><code>ΔG° = −nFE°</code></div>
    <div class="formula"><h4>Faraday’s Law</h4><code>m = (Q × M) / (n × F)</code></div>
  </div>
</section>

<!-- Chapter 4 -->
<section class="chapter">
  <div class="chapter-title">Chapter 4: Chemical Kinetics</div>
  <div class="formula-list">
    <span class="tag">Kinetics</span>
    <div class="formula"><h4>Rate Law</h4><code>Rate = k[A]^n</code></div>
    <div class="formula"><h4>Half Life (First Order)</h4><code>t½ = 0.693 / k</code></div>
    <div class="formula"><h4>Arrhenius Equation</h4><code>k = Ae^(−Ea/RT)</code></div>
  </div>
</section>

<!-- Chapter 5 -->
<section class="chapter">
  <div class="chapter-title">Chapter 5: Coordination Compounds</div>
  <div class="formula-list">
    <span class="tag">Inorganic</span>
    <div class="formula"><h4>Coordination Number</h4><code>Total ligands attached to metal ion</code></div>
    <div class="formula"><h4>Oxidation State</h4><code>Charge on metal after removing ligands</code></div>
    <div class="formula"><h4>Werner Theory</h4><code>Primary & secondary valencies</code></div>
  </div>
</section>

<!-- Chapter 6 -->
<section class="chapter">
  <div class="chapter-title">Chapter 6: Haloalkanes & Haloarenes</div>
  <div class="formula-list">
    <span class="tag">Organic</span>
    <div class="formula"><h4>SN1 Reaction</h4><code>Rate ∝ [RX]</code></div>
    <div class="formula"><h4>SN2 Reaction</h4><code>Rate ∝ [RX][OH⁻]</code></div>
  </div>
</section>

<!-- Chapter 7 -->
<section class="chapter">
  <div class="chapter-title">Chapter 7: Alcohols, Phenols & Ethers</div>
  <div class="formula-list">
    <span class="tag">Organic</span>
    <div class="formula"><h4>Lucas Test</h4><code>3° > 2° > 1° alcohol</code></div>
    <div class="formula"><h4>Williamson Synthesis</h4><code>R−ONa + R'−X → R−O−R'</code></div>
  </div>
</section>

</main>
</body>
</html>
