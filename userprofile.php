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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body class="bg-light">
    <header class="bg-primary text-white text-center py-3 d-flex justify-content-center align-items-center gap-3">
        <h1 class="h3 mb-0">User Profile</h1>
        <img src="images/mydigitalprofile-logo.png" alt="My Digital Profile Logo" class="img-fluid rounded-circle" style="max-width: 50px;">
    </header>
    <div class="container mt-4">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <?php if (!empty($user['image'])): ?>
                            <img src="<?= htmlspecialchars($user['image']) ?>" alt="Profile Image" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
                        <?php endif; ?>
                        <h5 class="card-title"><?= htmlspecialchars($user['name']) ?></h5>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="calc.php" class="btn btn-secondary d-flex align-items-center gap-2">
                                <i class="bi bi-calculator"></i> Calculator
                            </a>
                            <form action="userprofile.php" method="post" class="d-inline">
                                <button type="submit" name="logout" class="btn btn-danger d-flex align-items-center gap-2">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mt-3 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Social Media</h6>
                        <div class="d-flex flex-column gap-2">
                            <?php if (!empty($user['facebook'])): ?>
                                <a href="<?= htmlspecialchars($user['facebook']) ?>" target="_blank" class="btn btn-primary d-flex align-items-center gap-2 rounded-pill shadow-sm">
                                    <img src="images/facebook-logo.png" alt="Facebook" style="width: 20px; height: 20px;">
                                    <span>Facebook</span>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($user['instagram'])): ?>
                                <a href="<?= htmlspecialchars($user['instagram']) ?>" target="_blank" class="btn d-flex align-items-center gap-2 rounded-pill shadow-sm" style="background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); color: white;">
                                    <img src="images/instagram-logo.png" alt="Instagram" style="width: 20px; height: 20px;">
                                    <span>Instagram</span>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($user['linkedin'])): ?>
                                <a href="<?= htmlspecialchars($user['linkedin']) ?>" target="_blank" class="btn btn-info d-flex align-items-center gap-2 rounded-pill shadow-sm">
                                    <img src="images/linkedin-logo.png" alt="LinkedIn" style="width: 20px; height: 20px;">
                                    <span>LinkedIn</span>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($user['github'])): ?>
                                <a href="<?= htmlspecialchars($user['github']) ?>" target="_blank" class="btn btn-dark d-flex align-items-center gap-2 rounded-pill shadow-sm">
                                    <img src="images/github-logo.png" alt="GitHub" style="width: 20px; height: 20px;">
                                    <span>GitHub</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Profile Details</h5>
                        <hr>
                        <p><strong>Full Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
                        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($user['date_of_birth']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                        <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></p>
                        <p><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></p>
                        <div class="text-end">
                            <a href="editprofile.php" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
                <?php if (!empty($user['cv'])): ?>
                    <div class="card mt-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Curriculum Vitae (CV)</h5>
                            <hr>
                            <iframe src="<?= htmlspecialchars($user['cv']) ?>" class="w-100" style="height: 500px; border: none;"></iframe>
                            <div class="text-end mt-3">
                                <a href="<?= htmlspecialchars($user['cv']) ?>" target="_blank" class="btn btn-secondary">Download CV</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="mt-3 d-flex justify-content-center gap-3">
                    <form action="userprofile.php" method="post" class="d-inline">
                        <button type="submit" name="remove_user" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to remove your account? This action cannot be undone.');">
                            <i class="bi bi-trash"></i> Remove User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>