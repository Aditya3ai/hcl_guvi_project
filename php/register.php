<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "root";     
$pass = "";         
$db   = "hcl_guvi"; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(["status"=>"error","message"=>"DB Connection failed: ".$conn->connect_error]);
    exit;
}

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$age      = isset($_POST['age']) && $_POST['age'] !== '' ? intval($_POST['age']) : NULL;
$dob      = isset($_POST['dob']) && $_POST['dob'] !== '' ? $_POST['dob'] : NULL;
$contact  = isset($_POST['contact']) ? trim($_POST['contact']) : NULL;

if(empty($username) || empty($email) || empty($password)){
    echo json_encode(["status"=>"error","message"=>"Username, Email, and Password are required."]);
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, email, password, age, dob, contact) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiss", $username, $email, $hashed_password, $age, $dob, $contact);

if($stmt->execute()){
    echo json_encode(["status"=>"success","message"=>"Registration successful!"]);
} else {
    if($conn->errno == 1062){
        echo json_encode(["status"=>"error","message"=>"Username or Email already exists."]);
    } else {
        echo json_encode(["status"=>"error","message"=>"Database Error: ".$stmt->error]);
    }
}

$stmt->close();
$conn->close();
?>
