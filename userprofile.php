<?php
require 'db_config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute([':email' => $_SESSION['email']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    if (isset($_POST['remove_user'])) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE email = :email");
        $stmt->execute([':email' => $_SESSION['email']]);

        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <img src="images/mydigitalprofile-logo.png" alt="My Digital Profile Logo" class="website-logo">
        <h1>User Profile</h1>
    </header>
    <div class="profile-container">
        <h1>Welcome, <?= htmlspecialchars($user['name']) ?>!</h1>
        <hr>
        <div class="profile-details">
            <?php if (!empty($user['image'])): ?>
                <img src="<?= htmlspecialchars($user['image']) ?>" alt="Profile Image">
            <?php endif; ?>
            <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
            <p><strong>Date of Birth:</strong> <?= htmlspecialchars($user['date_of_birth']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <?php if (!empty($user['cv'])): ?>
                <p><strong>CV Information:</strong></p>
                <iframe src="<?= htmlspecialchars($user['cv']) ?>" class="cv-iframe"></iframe>
            <?php endif; ?>
        </div>
        <hr>
        <h2>Social media links:</h2>
        <div class="contact-info">
            <?php if (!empty($user['facebook'])): ?>
                <a href="<?= htmlspecialchars($user['facebook']) ?>" target="_blank">
                    <button class="facebook-button">
                        <img src="images/facebook-logo.png" alt="Facebook">
                        <strong>Facebook</strong>
                    </button>
                </a>
            <?php endif; ?>
            <?php if (!empty($user['instagram'])): ?>
                <a href="<?= htmlspecialchars($user['instagram']) ?>" target="_blank">
                    <button class="instagram-button">
                        <img src="images/instagram-logo.png" alt="Instagram">
                        <strong>Instagram</strong>
                    </button>
                </a>
            <?php endif; ?>
            <?php if (!empty($user['linkedin'])): ?>
                <a href="<?= htmlspecialchars($user['linkedin']) ?>" target="_blank">
                    <button class="linkedin-button">
                        <img src="images/linkedin-logo.png" alt="LinkedIn">
                        <strong>LinkedIn</strong>
                    </button>
                </a>
            <?php endif; ?>
            <?php if (!empty($user['github'])): ?>
                <a href="<?= htmlspecialchars($user['github']) ?>" target="_blank">
                    <button class="github-button">
                        <img src="images/github-logo.png" alt="GitHub">
                        <strong>GitHub</strong>
                    </button>
                </a>
            <?php endif; ?>
        </div>
        <hr>
        <div class="profile-actions">
            <form action="userprofile.php" method="post">
                <?php if (!empty($user['cv'])): ?>
                    <a href="<?= htmlspecialchars($user['cv']) ?>" target="_blank">
                        <button type="button" class="cv-button">Download My CV</button>
                    </a>
                <?php endif; ?>
                <a href="calc.php">
                    <button type="button" class="calc-button">
                        <img src="images/calculator-logo.png" alt="Calculator" class="button-logo">
                        Calculator
                    </button>
                </a>
                <a href="editprofile.php">
                    <button type="button" class="edit-profile-button">
                        Edit Profile
                    </button>
                </a>
                <button type="submit" name="logout" class="logout-button">
                    <img src="images/logout-logo.png" alt="Logout" class="button-logo">
                    Logout
                </button>
                <button type="submit" name="remove_user" class="remove-user-button" onclick="return confirm('Are you sure you want to remove your account? This action cannot be undone.');">Remove User</button>
            </form>
        </div>
    </div>
</body>

</html>