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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $date_of_birth = htmlspecialchars(trim($_POST['date_of_birth']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    $facebook = htmlspecialchars(trim($_POST['facebook']));
    $instagram = htmlspecialchars(trim($_POST['instagram']));
    $linkedin = htmlspecialchars(trim($_POST['linkedin']));
    $github = htmlspecialchars(trim($_POST['github']));

    $imagePath = $user['image'];
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imagePath = $targetDir . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $imagePath);
    }

    $cvPath = $user['cv'];
    if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] == 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $cvPath = $targetDir . basename($_FILES['cv_file']['name']);
        move_uploaded_file($_FILES['cv_file']['tmp_name'], $cvPath);
    }

    $stmt = $pdo->prepare("UPDATE users SET name = :name, date_of_birth = :date_of_birth, phone = :phone, address = :address, 
                           image = :image, cv = :cv, facebook = :facebook, instagram = :instagram, linkedin = :linkedin, github = :github 
                           WHERE email = :email");
    $stmt->execute([
        ':name' => $name,
        ':date_of_birth' => $date_of_birth,
        ':phone' => $phone,
        ':address' => $address,
        ':image' => $imagePath,
        ':cv' => $cvPath,
        ':facebook' => $facebook,
        ':instagram' => $instagram,
        ':linkedin' => $linkedin,
        ':github' => $github,
        ':email' => $_SESSION['email']
    ]);

    header("Location: userprofile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body class="bg-light">
    <header class="bg-primary text-white text-center py-3 d-flex justify-content-center align-items-center gap-3">
        <h1 class="h3 mb-0">Edit Profile</h1>
        <img src="images/mydigitalprofile-logo.png" alt="My Digital Profile Logo" class="img-fluid rounded-circle" style="max-width: 50px;">
    </header>
    <div class="container mt-4">
        <form method="post" action="editprofile.php" enctype="multipart/form-data" class="edit-profile-form">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="<?= htmlspecialchars($user['date_of_birth']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="<?= htmlspecialchars($user['address']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="profile_image" class="form-label">Upload Profile Picture (Optional)</label>
                <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="cv_file" class="form-label">Upload CV (PDF) (Optional)</label>
                <input type="file" name="cv_file" id="cv_file" class="form-control" accept=".pdf">
            </div>
            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook Profile Link</label>
                <input type="text" name="facebook" id="facebook" class="form-control" value="<?= htmlspecialchars($user['facebook']) ?>">
            </div>
            <div class="mb-3">
                <label for="instagram" class="form-label">Instagram Profile Link</label>
                <input type="text" name="instagram" id="instagram" class="form-control" value="<?= htmlspecialchars($user['instagram']) ?>">
            </div>
            <div class="mb-3">
                <label for="linkedin" class="form-label">LinkedIn Profile Link</label>
                <input type="text" name="linkedin" id="linkedin" class="form-control" value="<?= htmlspecialchars($user['linkedin']) ?>">
            </div>
            <div class="mb-3">
                <label for="github" class="form-label">GitHub Profile Link</label>
                <input type="text" name="github" id="github" class="form-control" value="<?= htmlspecialchars($user['github']) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>

</html>