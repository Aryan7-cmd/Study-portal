<?php
require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Physics – Important Formulas</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Inter',sans-serif}
    body{background:linear-gradient(135deg,#f8fafc,#e5edf7);min-height:100vh;color:#0f172a}

    /* Header */
    .header{background:#0f172a;color:#fff;padding:24px 40px}
    .header h1{font-size:28px}
    .header p{color:#cbd5f5;margin-top:6px}

    /* Layout */
    .container{max-width:1200px;margin:40px auto;padding:0 20px}

    /* Chapter Card */
    .chapter{background:#fff;border-radius:16px;box-shadow:0 15px 35px rgba(0,0,0,.08);margin-bottom:30px;overflow:hidden}

    .chapter-title{background:linear-gradient(135deg,#2563eb,#1e40af);color:#fff;padding:18px 24px;font-size:20px;font-weight:600}

    .formula-list{padding:24px}

    .formula{background:#f1f5f9;border-left:5px solid #2563eb;border-radius:8px;padding:14px 18px;margin-bottom:14px}
    .formula h4{font-size:16px;margin-bottom:6px}
    .formula code{font-size:15px;color:#1e293b}

    /* Tag */
    .tag{display:inline-block;background:#dbeafe;color:#1d4ed8;padding:4px 10px;border-radius:14px;font-size:12px;margin-bottom:10px}

    /* Responsive */
    @media(max-width:600px){
      .chapter-title{font-size:18px}
    }
  </style>
</head>
<body>

  <header class="header">
    <div style="display:flex;align-items:center;gap:20px;">
      <a href="subjects.php" style="color:#cbd5f5;text-decoration:none;font-size:14px;background:rgba(255,255,255,0.1);padding:8px 14px;border-radius:8px;">← Back to Subjects</a>
      <div>
        <h1>Physics – Important Formulas</h1>
        <p>Chapter-wise collection of must-know physics formulas</p>
      </div>
    </div>
  </header>

  <main class="container">

    <!-- Chapter 1 -->
    <section class="chapter">
      <div class="chapter-title">Chapter 1: Motion</div>
      <div class="formula-list">
        <span class="tag">Kinematics</span>

        <div class="formula">
          <h4>Speed</h4>
          <code>Speed = Distance / Time</code>
        </div>

        <div class="formula">
          <h4>Velocity</h4>
          <code>Velocity = Displacement / Time</code>
        </div>

        <div class="formula">
          <h4>Acceleration</h4>
          <code>a = (v − u) / t</code>
        </div>
      </div>
    </section>

    <!-- Chapter 2 -->
    <section class="chapter">
      <div class="chapter-title">Chapter 2: Laws of Motion</div>
      <div class="formula-list">
        <span class="tag">Dynamics</span>

        <div class="formula">
          <h4>Force</h4>
          <code>F = m × a</code>
        </div>

        <div class="formula">
          <h4>Momentum</h4>
          <code>p = m × v</code>
        </div>

        <div class="formula">
          <h4>Impulse</h4>
          <code>Impulse = Change in Momentum</code>
        </div>
      </div>
    </section>

    <!-- Chapter 3 -->
    <section class="chapter">
      <div class="chapter-title">Chapter 3: Work, Energy & Power</div>
      <div class="formula-list">
        <span class="tag">Energy</span>

        <div class="formula">
          <h4>Work</h4>
          <code>W = F × s</code>
        </div>

        <div class="formula">
          <h4>Kinetic Energy</h4>
          <code>KE = ½ m v²</code>
        </div>

        <div class="formula">
          <h4>Power</h4>
          <code>P = Work / Time</code>
        </div>
      </div>
    </section>

  
    <!-- Chapter 4 -->
    <section class="chapter">
      <div class="chapter-title">Chapter 4: Rotational Dynamics</div>
      <div class="formula-list">
        <span class="tag">Rotation</span>

        <div class="formula">
          <h4>Angular Velocity</h4>
          <code>ω = θ / t</code>
        </div>

        <div class="formula">
          <h4>Angular Acceleration</h4>
          <code>α = (ω − ω₀) / t</code>
        </div>

        <div class="formula">
          <h4>Moment of Inertia</h4>
          <code>I = Σ m r²</code>
        </div>

        <div class="formula">
          <h4>Torque</h4>
          <code>τ = r × F</code>
        </div>

        <div class="formula">
          <h4>Rotational Kinetic Energy</h4>
          <code>KE = ½ I ω²</code>
        </div>
      </div>
    </section>

    <!-- Chapter 5 -->
    <section class="chapter">
      <div class="chapter-title">Chapter 5: Fluid Statics</div>
      <div class="formula-list">
        <span class="tag">Fluids</span>

        <div class="formula">
          <h4>Pressure</h4>
          <code>P = F / A</code>
        </div>

        <div class="formula">
          <h4>Pressure at Depth</h4>
          <code>P = P₀ + ρgh</code>
        </div>

        <div class="formula">
          <h4>Buoyant Force</h4>
          <code>F = ρVg</code>
        </div>

        <div class="formula">
          <h4>Pascal’s Law</h4>
          <code>P₁ = P₂</code>
        </div>
      </div>
    </section>

    <!-- Chapter 6 -->
    <section class="chapter">
      <div class="chapter-title">Chapter 6: Magnetism</div>
      <div class="formula-list">
        <span class="tag">Magnetism</span>

        <div class="formula">
          <h4>Magnetic Force</h4>
          <code>F = qvB sinθ</code>
        </div>

        <div class="formula">
          <h4>Force on Current-Carrying Conductor</h4>
          <code>F = BIL sinθ</code>
        </div>

        <div class="formula">
          <h4>Magnetic Field of Straight Wire</h4>
          <code>B = μ₀I / 2πr</code>
        </div>

        <div class="formula">
          <h4>Magnetic Flux</h4>
          <code>Φ = BA cosθ</code>
        </div>
      </div>
    </section>

  </main>

</body>
</html>
