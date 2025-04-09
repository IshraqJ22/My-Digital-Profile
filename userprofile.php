<?php
session_start();
if (!isset($_SESSION['name'])) {
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
        $file = 'users.json';
        if (file_exists($file)) {
            $users = json_decode(file_get_contents($file), true);
            $updatedUsers = array_filter($users, function ($user) {
                return $user['email'] !== $_SESSION['email'];
            });
            file_put_contents($file, json_encode(array_values($updatedUsers), JSON_PRETTY_PRINT));
        }

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
    <div class="profile-container">
        <h1>Welcome, <?= htmlspecialchars($_SESSION['name']) ?>!</h1>
        <hr>
        <div class="profile-details">
            <?php if (!empty($_SESSION['image'])): ?>
                <img src="<?= htmlspecialchars($_SESSION['image']) ?>" alt="Profile Image" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 20px;">
            <?php endif; ?>
            <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['name']) ?></p>
            <p><strong>Age:</strong> <?= htmlspecialchars($_SESSION['age']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($_SESSION['phone']) ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($_SESSION['address']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
            <p><strong>CV Information:</strong></p>
            <?php if (!empty($_SESSION['cv'])): ?>
                <iframe src="<?= htmlspecialchars($_SESSION['cv']) ?>" style="width: 100%; height: 500px; border: 1px solid #ccc;"></iframe>
            <?php endif; ?>
        </div>
        <hr>
        <h2>Social media links:</h2>
        <div class="contact-info">
            <?php if (!empty($_SESSION['facebook'])): ?>
                <a href="<?= htmlspecialchars($_SESSION['facebook']) ?>" target="_blank">
                    <button class="facebook-button">
                        <img src="images/facebook-logo.png" alt="Facebook">
                        <strong>Facebook Profile</strong>
                    </button>
                </a>
            <?php endif; ?>
            <br>
            <?php if (!empty($_SESSION['instagram'])): ?>
                <a href="<?= htmlspecialchars($_SESSION['instagram']) ?>" target="_blank">
                    <button class="instagram-button">
                        <img src="images/instagram-logo.png" alt="Instagram">
                        <strong>Instagram Profile</strong>
                    </button>
                </a>
            <?php endif; ?>
            <br>
            <?php if (!empty($_SESSION['linkedin'])): ?>
                <a href="<?= htmlspecialchars($_SESSION['linkedin']) ?>" target="_blank">
                    <button class="linkedin-button">
                        <img src="images/linkedin-logo.png" alt="LinkedIn">
                        <strong>LinkedIn Profile</strong>
                    </button>
                </a>
            <?php endif; ?>
        </div>
        <hr>
        <div class="profile-actions" style="text-align: center; margin-top: 20px;">
            <form action="userprofile.php" method="post" style="margin-top: 10px; display: inline;">
                <?php if (!empty($_SESSION['cv'])): ?>
                    <a href="<?= htmlspecialchars($_SESSION['cv']) ?>" target="_blank"><button type="button" class="cv-button">View My CV</button></a><br>
                <?php endif; ?>
                <a href="calc.php"><button type="button" class="calc-button">Calculator</button></a><br>
                <button type="submit" name="logout" class="logout-button">Logout</button>
                <button type="submit" name="remove_user" class="remove-user-button" onclick="return confirm('Are you sure you want to remove your account? This action cannot be undone.');">Remove User</button>
            </form>
        </div>
    </div>
</body>

</html>