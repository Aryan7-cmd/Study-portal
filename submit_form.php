<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: contact.php");
    exit;
}

$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if ($name === '' || $email === '' || $message === '') {
    $_SESSION['contact_error'] = "All fields are required.";
    header("Location: contact.php");
    exit;
}

require "db.php";

$stmt = $conn->prepare(
    "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)"
);
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    $_SESSION['contact_success'] = "Message sent successfully!";
} else {
    $_SESSION['contact_error'] = "Message failed to send.";
}

header("Location: contact.php");
exit;
