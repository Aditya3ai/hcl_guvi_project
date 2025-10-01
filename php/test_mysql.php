<?php
$host = "localhost";
$db   = "internship_db";
$user = "intern_user";   // MySQL username
$pass = "Ramu1234";      // Password you set

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "MySQL connected successfully!";
?>
