<?php
// update_name.php

include 'connection/db.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true)??$_SERVER['REQUEST_METHOD'];


if (isset($data['chat_id'])) {
    $chatId = $data['chat_id'];
    $name = $data['banks'];

    // Update user name
    $stmt = $conn->prepare("UPDATE conversation_flow SET name = ? WHERE chatId = ?");
    $stmt->execute([$name, $chatId]);

    echo json_encode(['status' => 'success', 'message' => 'Name updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
