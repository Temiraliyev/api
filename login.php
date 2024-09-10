<?php
include 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'];
$password = $data['password'];

$query = "SELECT * FROM Users WHERE email = :email";
$stmt = $conn->prepare($query);
$stmt->execute([':email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    echo json_encode(['status' => 'success', 'message' => 'Login successful', 'user_id' => $user['user_id']]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
}
?>
