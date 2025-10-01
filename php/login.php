<?php
session_start();
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "root";
$pass = "";
$db   = "hcl_guvi";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode(['status'=>'error','message'=>'DB Connection failed: '.$conn->connect_error]);
    exit;
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if(empty($email) || empty($password)){
    echo json_encode(['status'=>'error','message'=>'Email and Password required']);
    exit;
}

$stmt = $conn->prepare("SELECT id, password FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($user_id, $hashed_pass);

if($stmt->num_rows == 0){
    echo json_encode(['status'=>'error','message'=>'Invalid email or password']);
    $stmt->close();
    $conn->close();
    exit;
}

$stmt->fetch();

if(!password_verify($password, $hashed_pass)){
    echo json_encode(['status'=>'error','message'=>'Invalid email or password']);
    $stmt->close();
    $conn->close();
    exit;
}

// Login successful, store session
$_SESSION['user_id'] = $user_id;

echo json_encode(['status'=>'success','message'=>'Login successful']);

$stmt->close();
$conn->close();
?>
