<?php
// index.php

include 'connection/db.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true)??$_SERVER['REQUEST_METHOD'];


if (isset($data['chat_id'])) {
    $chatId = $data['chat_id'];

    error_log(Json_encode($data));
    // Check if chatId already exists
    $stmt = $conn->prepare("SELECT * FROM conversation_flow WHERE chatId = ?");
    $stmt->execute([$chatId]);
    $user = $stmt->fetch();

    if (!$user) {
        // Insert new chatId if not exists
        $stmt = $conn->prepare("INSERT INTO conversation_flow (chatId) VALUES (?)");
        $stmt->execute([$chatId]);
    } else {
        error_log( json_encode(['status' => 'exists', 'message' => 'User already exists']));
    }
} else {
    error_log( json_encode(['status' => 'error', 'message' => 'Invalid request']));
}
?>
