<?php
require 'db_config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Digital Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body class="bg-light">
    <header class="bg-primary text-white text-center py-3 d-flex justify-content-center align-items-center gap-3">
        <h1 class="h3 mb-0"><a href="index.php" class="text-white text-decoration-none">My Digital Profile</a></h1>
        <img src="images/mydigitalprofile-logo.png" alt="My Digital Profile Logo" class="img-fluid rounded-circle" style="max-width: 50px;">
    </header>
    <div class="container mt-4">
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
            <div class="card shadow-sm mx-auto" style="max-width: 400px;">
                <div class="card-body">
                    <form action="index.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="login" class="btn btn-primary">Log In</button>
                            <a href="registration.php" class="btn btn-secondary">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        <?php else : ?>
            <form action="index.php" method="post" class="text-center">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>