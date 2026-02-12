<?php
include "db.php";

if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm_password'];

    if ($pass != $cpass) {
        $error = "Passwords do not match";
    } else {
        // Check if email already exists
        $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check_email) > 0) {
            $error = "Email already registered";
        }
        // Check if username already exists
        else {
            $check_username = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
            if (mysqli_num_rows($check_username) > 0) {
                $error = "Username already taken";
            }
            else {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                mysqli_query($conn, "INSERT INTO users (email, username, password)
                                     VALUES ('$email', '$username', '$hash')");
                header("Location: login.php");
                exit();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign up · Tech Masters</title>
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <style>
        @media (max-width: 480px) {
            .signup-body {
                padding: 20px 16px;
            }
            .signup-box {
                margin: 0;
            }
        }
    </style>
</head>
<body class="signup-body">

<div class="signup-box">

    <div class="logo-badge">📘</div>
    
    <h2>Create account</h2>
    <p class="welcome-subtitle">Get started with Tech Masters</p>

    <?php if(isset($error)): ?>
        <div class='error'>
            <span class="emoji-icon">⚠️</span> <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST">
    
        <div class="input-group">
            <span class="input-icon">👤</span>
            <input type="text" name="username" placeholder="Username" 
                   value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" 
                   autocomplete="username" required>
        </div>
        
     
        <div class="input-group">
            <span class="input-icon">📧</span>
            <input type="email" name="email" placeholder="Email address" 
                   value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" 
                   autocomplete="email" required>
        </div>
       
        <div class="input-group">
            <span class="input-icon">🔒</span>
            <input type="password" name="password" id="password" placeholder="Password" 
                   autocomplete="new-password" required>
        </div>
        
        <div class="password-strength" id="strengthIndicator">
            <div class="strength-bar"></div>
            <div class="strength-bar"></div>
            <div class="strength-bar"></div>
            <div class="strength-bar"></div>
        </div>
        <div class="strength-text" id="strengthText">────────</div>
        
        <div class="input-group">
            <span class="input-icon">🔐</span>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" 
                   autocomplete="new-password" required>
        </div>
        
        <div class="password-match" id="matchIndicator"></div>
        
    
        <div class="terms-checkbox">
            <label class="terms-label">
                <input type="checkbox" name="terms" required>
                <span>I agree to the <a href="#" onclick="alert('Terms of Service'); return false;">Terms</a> and <a href="#" onclick="alert('Privacy Policy'); return false;">Privacy</a></span>
            </label>
        </div>
        
        <button type="submit" name="signup" id="signupBtn">
            <span>Create account</span>
        </button>
        
        <div class="divider">
            <span>or</span>
        </div>
        
    </form>

    <div class="signup-link">
        Already have an account? <a href="login.php">Sign in →</a>
    </div>
    
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const strengthBars = document.querySelectorAll('#strengthIndicator .strength-bar');
    const strengthText = document.getElementById('strengthText');
    const matchIndicator = document.getElementById('matchIndicator');
    
    // Password strength indicator
    if (password) {
        password.addEventListener('input', function() {
            const val = this.value;
            let strength = 0;
            
            if (val.length >= 8) strength += 1;
            if (val.match(/[A-Z]/)) strength += 1;
            if (val.match(/[0-9]/)) strength += 1;
            if (val.match(/[^a-zA-Z0-9]/)) strength += 1;
            
            // Reset bars
            strengthBars.forEach(bar => {
                bar.style.background = '#e2e8f0';
                bar.style.width = '100%';
            });
            
            // Set active bars
            for (let i = 0; i < strength; i++) {
                if (i < strengthBars.length) {
                    if (strength <= 2) {
                        strengthBars[i].style.background = '#f59e0b'; // amber
                    } else {
                        strengthBars[i].style.background = '#10b981'; // green
                    }
                }
            }
            
            // Update text
            const indicators = ['', '✓ 8+ chars', '✓ + uppercase', '✓ + number', '✓ + symbol'];
            strengthText.textContent = indicators[strength] || '────────';
            strengthText.style.color = strength <= 2 ? '#f59e0b' : '#10b981';
            
            if (val.length === 0) strengthText.textContent = '────────';
        });
    }
    
    // Password match indicator
    if (confirmPassword && password) {
        function checkMatch() {
            if (confirmPassword.value.length === 0) {
                matchIndicator.innerHTML = '';
                matchIndicator.className = 'password-match';
            } else if (password.value === confirmPassword.value) {
                matchIndicator.innerHTML = '✓ Passwords match';
                matchIndicator.className = 'password-match match-success';
            } else {
                matchIndicator.innerHTML = '✗ Passwords do not match';
                matchIndicator.className = 'password-match match-error';
            }
        }
        
        password.addEventListener('input', checkMatch);
        confirmPassword.addEventListener('input', checkMatch);
    }
});
</script>

<!-- Inter font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</body>
</html>