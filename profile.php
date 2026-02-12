<?php
require 'auth.php';
require 'db.php';

$stmt = $conn->prepare("SELECT id, username, email, joined_date FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Profile | Tech Masters</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>

<!-- PROFILE WRAPPER -->
<section class="profile-wrapper">

    <!-- LEFT: USER CARD -->
    <div class="profile-card">
        <div class="avatar"><?= strtoupper($username[0]) ?></div>
        <h2><?= htmlspecialchars($user['username']) ?></h2>
        <div class="profile-info">
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
             <p><strong>Joined:</strong> <?= date("F j, Y", strtotime($user['joined_date'])) ?></p>
        </div>
    </div>

    <!-- RIGHT: STUDY STATS -->
    <div class="profile-content">

        <h3>Today's Progress</h3>
        <div class="stats-row">
            <div class="stat-box">
                <h3><?= $stats['daily_quiz_score'] ?? 0 ?></h3>
                <p>Daily Quiz Score</p>
            </div>
            <div class="stat-box">
                <h3><?= $stats['notes_completed'] ?? 0 ?></h3>
                <p>Notes Completed</p>
            </div>
        </div>

        <!-- Optional: Other Study Metrics -->
        <div class="activity-box">
            <h3>Study Activity</h3>
            <ul>
                <li>Math Practice Completed ✅</li>
                <li>Physics Notes Reviewed ✅</li>
                <li>Chemistry Quiz Taken ✅</li>
                <li>Economics Assignment Uploaded ✅</li>
            </ul>
        </div>

    </div>
</section>
</body>
</html>
