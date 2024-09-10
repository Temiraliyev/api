<?php
include 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_BCRYPT);

$query = "INSERT INTO Users (username, email, password) VALUES (:username, :email, :password)";
$stmt = $conn->prepare($query);

if ($stmt->execute([':username' => $username, ':email' => $email, ':password' => $password])) {
    echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User registration failed']);
}
?>
