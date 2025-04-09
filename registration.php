<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $age = htmlspecialchars(trim($_POST['age']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $facebook = htmlspecialchars(trim($_POST['facebook']));
    $instagram = htmlspecialchars(trim($_POST['instagram']));
    $linkedin = htmlspecialchars(trim($_POST['linkedin']));

    $imagePath = "";
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imagePath = $targetDir . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $imagePath);
    }

    $cvPath = "";
    if (isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] == 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $cvPath = $targetDir . basename($_FILES['cv_file']['name']);
        move_uploaded_file($_FILES['cv_file']['tmp_name'], $cvPath);
    }

    $userData = [
        'name' => $name,
        'age' => $age,
        'phone' => $phone,
        'address' => $address,
        'email' => $email,
        'password' => $password,
        'image' => $imagePath,
        'cv' => $cvPath,
        'facebook' => $facebook,
        'instagram' => $instagram,
        'linkedin' => $linkedin
    ];

    $file = 'users.json';
    $users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $users[] = $userData;

    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
    echo "<p>Registration successful! You can now log in.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Register to My Digital Portal</h1>
    <hr>
    <form method="post" action="registration.php" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Enter your name" required>
        <input type="number" name="age" placeholder="Enter your age" required>
        <input type="text" name="phone" placeholder="Enter your phone number" required>
        <input type="text" name="address" placeholder="Enter your address" required>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <label for="profile_image">Upload Profile Picture (Optional):</label>
        <input type="file" name="profile_image" id="profile_image" accept="image/*">
        <label for="cv_file">Upload CV (PDF) (Optional):</label>
        <input type="file" name="cv_file" id="cv_file" accept=".pdf">
        <input type="text" name="facebook" placeholder="Enter your Facebook profile link">
        <input type="text" name="instagram" placeholder="Enter your Instagram profile link">
        <input type="text" name="linkedin" placeholder="Enter your LinkedIn profile link">
        <input type="submit" value="Register">
    </form>
    <div style="text-align: center; margin-top: 20px;">
        <a href="<?= isset($_SESSION['name']) ? 'userprofile.php' : 'index.php' ?>">
            <button class="calc-button">Back to Login</button>
        </a>
    </div>
</body>

</html>