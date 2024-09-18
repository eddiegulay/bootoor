<?php
// update_phone.php

include 'connection/db.php';


$input = file_get_contents('php://input');
$data = json_decode($input, true)??$_SERVER['REQUEST_METHOD'];


if (isset($data['chat_id'])) {
    $chatId = $data['chat_id'];
    $phoneNumber = $data['confirmations_2'];

    error_log(Json_encode($data));

    // Update user phone number
    $stmt = $conn->prepare("UPDATE conversation_flow SET phoneNumber = ? WHERE chatId = ?");
    $stmt->execute([$phoneNumber, $chatId]);

    echo json_encode(['text' => 'We have sent notification to confirm payment', 'message' => 'Phone number updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
