<?php
// update_amount.php

include 'connection/db.php';



$input = file_get_contents('php://input');
$data = json_decode($input, true) ?? $_SERVER['REQUEST_METHOD'];

if (isset($data['chat_id'])) {
    $chatId = $data['chat_id'];
    $amount = $data['number_ya_sender_bank'];
    $receiver = $data['banks'];
    $bank_details = $data['taarifa_za_bank'];

    error_log(json_encode($data));

    // Update payment amount
    $stmt = $conn->prepare("UPDATE conversation_flow SET amount = ? WHERE chatId = ?");
    $stmt->execute([$amount, $chatId]);

    $amount_rate = $amount * 0.1;

    $response_message = "Ingiza namba ya simu kutuma kiasi $amount /- kwa makato TZS $amount_rate /-  kwenda kwa $receiver Mwenye taarifa za benki zifuatazo: $bank_details";

    echo json_encode(['text' => $response_message, 'message' => 'Amount updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>