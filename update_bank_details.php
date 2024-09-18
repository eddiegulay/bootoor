<?php
// update_name.php

include 'connection/db.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true)??$_SERVER['REQUEST_METHOD'];


if (isset($data['chat_id'])) {
    $chatId = $data['chat_id'];
    $bank_details = $data['taarifa_za_bank'];

    error_log(json_encode($data));

    // Update user name
    $stmt = $conn->prepare("UPDATE conversation_flow SET bank_details = ? WHERE chatId = ?");
    $stmt->execute([$bank_details, $chatId]);

    echo json_encode(['status' => 'success', 'message' => 'Bank Details updated']);
} else {
    error_log(json_encode(['status' => 'error', 'message' => 'Invalid request']));
}
?>
