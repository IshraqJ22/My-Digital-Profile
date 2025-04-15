<?php
require 'db_config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> My Digital Profile</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <img src="images/mydigitalprofile-logo.png" alt="My Digital Profile Logo" class="website-logo">
        <h1><a href="index.php" style="text-decoration: none; color: inherit;">My Digital Profile</a></h1>
    </header>
    <hr>
    <?php
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['date_of_birth'] = $user['date_of_birth'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['address'] = $user['address'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['image'] = $user['image'];
            $_SESSION['cv'] = $user['cv'];
            $_SESSION['facebook'] = $user['facebook'];
            $_SESSION['instagram'] = $user['instagram'];
            $_SESSION['linkedin'] = $user['linkedin'];
            $_SESSION['github'] = $user['github'];
            header("Location: userprofile.php");
            exit();
        } else {
            echo "<p style='color: red;'>Invalid email or password!</p>";
        }
    }
    ?>

    <?php if (!isset($_SESSION['name'])) : ?>
        <div class="centered-container">
            <form action="index.php" method="post" style="text-align: center;">
                <input type="email" name="email" placeholder="Enter your email" value="" required>
                <input type="password" name="password" placeholder="Enter your password" value="" required>
                <div style="margin-top: 10px;">
                    <input type="submit" name="login" value="Log In" class="cv-button">
                    <a href="registration.php" style="text-decoration: none;">
                        <button type="button" class="cv-button">Register</button>
                    </a>
                </div>
            </form>
        </div>
    <?php else : ?>
        <form action="index.php" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
        <hr>
    <?php endif; ?>
</body>

</html>