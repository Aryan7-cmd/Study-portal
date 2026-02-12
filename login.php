<?php
session_start();
include "db.php";

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM users WHERE email='$user' OR username='$user'");
    if (mysqli_num_rows($q) == 1) {
        $row = mysqli_fetch_assoc($q);
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user'] = $row['username'];
            header("Location: index.php");
            exit();
        }
    }
    $error = "Invalid login details";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Tech Masters</title>
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="login-body">

<div class="login-box">

    <div class="logo-badge">🎓</div>
    
    <h2>Welcome Back</h2>
    <p class="welcome-subtitle">Sign in to continue</p>

    <?php if(isset($error)): ?>
        <div class='error'><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="input-group">
            <span class="input-icon">📧</span>
            <input type="text" name="username" placeholder="Email" required>
        </div>
        
    
        <div class="input-group">
            <span class="input-icon">🔒</span>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="password-strength">
            <div class="strength-bar"></div>
            <div class="strength-bar"></div>
            <div class="strength-bar"></div>
        </div>
        
        <div class="remember-forgot">
            <label class="remember-me">
                <input type="checkbox" name="remember"> Remember me
            </label>
            <a href="#" class="forgot-link" onclick="alert('Please contact your administrator to reset your password.'); return false;">Forgot password?</a>
        </div>
        
        <button type="submit" name="login">
            <span>Sign In</span>
        </button>
        
        <div class="divider">
            <span>OR</span>
        </div>
        
    </form>

    <div class="signup-link">
        Don't have an account? <a href="signup.php">Create account</a>
    </div>
    
</div>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</body>
</html>