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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <img src="images/mydigitalprofile-logo.png" alt="My Digital Profile Logo" class="website-logo">
        <h1>Edit Profile</h1>
    </header>
    <form method="post" action="editprofile.php" enctype="multipart/form-data">
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" placeholder="Enter your name" required>
        <input type="date" name="date_of_birth" value="<?= htmlspecialchars($user['date_of_birth']) ?>" placeholder="Enter your date of birth" required>
        <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" placeholder="Enter your phone number" required>
        <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" placeholder="Enter your address" required>
        <label for="profile_image">Upload Profile Picture (Optional):</label>
        <input type="file" name="profile_image" id="profile_image" accept="image/*">
        <label for="cv_file">Upload CV (PDF) (Optional):</label>
        <input type="file" name="cv_file" id="cv_file" accept=".pdf">
        <input type="text" name="facebook" value="<?= htmlspecialchars($user['facebook']) ?>" placeholder="Enter your Facebook profile link">
        <input type="text" name="instagram" value="<?= htmlspecialchars($user['instagram']) ?>" placeholder="Enter your Instagram profile link">
        <input type="text" name="linkedin" value="<?= htmlspecialchars($user['linkedin']) ?>" placeholder="Enter your LinkedIn profile link">
        <input type="text" name="github" value="<?= htmlspecialchars($user['github']) ?>" placeholder="Enter your GitHub profile link">
        <input type="submit" value="Save Changes">
    </form>
</body>

</html>