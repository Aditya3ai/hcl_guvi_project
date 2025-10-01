<?php
header('Content-Type: application/json');
require 'vendor/autoload.php'; // Redis

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// Get token from headers
$headers = getallheaders();
if(!isset($headers['Authorization'])){
    echo json_encode(['status'=>'error','message'=>'Unauthorized']);
    exit;
}
$token = $headers['Authorization'];

// Validate token
$user_id = $redis->get("session_$token");
if(!$user_id){
    echo json_encode(['status'=>'error','message'=>'Session expired']);
    exit;
}

// Get POST data
$oldPass = $_POST['oldPass'];
$newPass = $_POST['newPass'];

// Check old password in MySQL
$mysqli = new mysqli("localhost", "root", "", "internship_db");
$stmt = $mysqli->prepare("SELECT password FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($hashedPass);
$stmt->fetch();
$stmt->close();

if(!password_verify($oldPass, $hashedPass)){
    echo json_encode(['status'=>'error','message'=>'Current password is incorrect']);
    $mysqli->close();
    exit;
}

// Update password
$newHashed = password_hash($newPass, PASSWORD_BCRYPT);
$stmt = $mysqli->prepare("UPDATE users SET password=? WHERE id=?");
$stmt->bind_param("si", $newHashed, $user_id);
if($stmt->execute()){
    echo json_encode(['status'=>'success','message'=>'Password changed successfully']);
} else {
    echo json_encode(['status'=>'error','message'=>'Failed to change password']);
}
$stmt->close();
$mysqli->close();
?>
