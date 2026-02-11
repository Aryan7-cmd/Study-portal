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
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body class="login-body">

<div class="login-box">
    <h2>Welcome Back</h2>

    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>

    <p>New here? <a href="signup.php">Create account</a></p>
</div>

</body>
</html>
