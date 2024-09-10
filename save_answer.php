<?php
include 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$question_id = $data['question_id'];
$answer_id = $data['answer_id'];

$query = "INSERT INTO User_Answers (user_id, question_id, answer_id) VALUES (:user_id, :question_id, :answer_id)";
$stmt = $conn->prepare($query);

if ($stmt->execute([':user_id' => $user_id, ':question_id' => $question_id, ':answer_id' => $answer_id])) {
    echo json_encode(['status' => 'success', 'message' => 'Answer saved successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to save answer']);
}
?>
