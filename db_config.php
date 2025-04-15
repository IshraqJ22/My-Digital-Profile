<?php
$host = ''; // Use your hostname here (Usually localhost)
$dbname = 'mydigitalprofile';
$username = ''; // Use your username for database (Usually named root)
$password = ''; // Replace with your actual password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
 
