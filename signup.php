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
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO users (email, username, password)
                             VALUES ('$email', '$username', '$hash')");
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="login.css">
</head>
<body class="signup-body">

<div class="signup-box">
    <h2>Create Account</h2>

    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button name="signup">Sign Up</button>
    </form>
           
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

</body>
</html>
