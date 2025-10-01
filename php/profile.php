<?php
session_start();
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION['user_id'])){
    echo json_encode(['status'=>'error','message'=>'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

$host = "localhost";
$user = "root";
$pass = "";
$db   = "hcl_guvi";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode(['status'=>'error','message'=>'DB Connection failed: '.$conn->connect_error]);
    exit;
}

// Fetch profile data (GET)
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $stmt = $conn->prepare("SELECT username, age, dob, contact FROM users WHERE id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($username, $age, $dob, $contact);
    $stmt->fetch();
    $stmt->close();

    $data = [
        'username' => $username,
        'age' => $age,
        'dob' => $dob,
        'contact' => $contact,
        'profilePic' => 'uploads/default.png' // optional placeholder
    ];

    echo json_encode(['status'=>'success','data'=>$data]);
    $conn->close();
    exit;
}

// Update profile (POST)
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $age = isset($_POST['age']) && $_POST['age'] !== '' ? intval($_POST['age']) : NULL;
    $dob = isset($_POST['dob']) && $_POST['dob'] !== '' ? $_POST['dob'] : NULL;
    $contact = isset($_POST['contact']) ? trim($_POST['contact']) : NULL;

    $stmt = $conn->prepare("UPDATE users SET age=?, dob=?, contact=? WHERE id=?");
    $stmt->bind_param("issi", $age, $dob, $contact, $user_id);
    if($stmt->execute()){
        echo json_encode(['status'=>'success','message'=>'Profile updated']);
    } else {
        echo json_encode(['status'=>'error','message'=>'Update failed: '.$stmt->error]);
    }
    $stmt->close();
    $conn->close();
    exit;
}
?>
