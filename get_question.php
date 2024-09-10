<?php
include 'config.php';

$query = "
    SELECT q.question_id, q.question_text, q.difficulty, a.answer_id, a.answer_text, a.is_correct
    FROM Questions q
    JOIN Answers a ON q.question_id = a.question_id
";

$stmt = $conn->prepare($query);
$stmt->execute();

$questions = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $question_id = $row['question_id'];

    if (isset($questions[$question_id])) {
        $questions[$question_id]['answers'][] = [
            'answer_id' => $row['answer_id'],
            'answer_text' => $row['answer_text'],
            'is_correct' => $row['is_correct'] == 1 ? true : false
        ];
    } else {
        $questions[$question_id] = [
            'question_text' => $row['question_text'],
            'difficulty' => $row['difficulty'],
            'answers' => [
                [
                    'answer_id' => $row['answer_id'],
                    'answer_text' => $row['answer_text'],
                    'is_correct' => $row['is_correct'] == 1 ? true : false
                ]
            ]
        ];
    }
}

header('Content-Type: application/json; charset=utf-8');

$questions = array_values($questions);

echo json_encode($questions, JSON_UNESCAPED_UNICODE);
?>
