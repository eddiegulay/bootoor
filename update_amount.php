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

    // Fee structure based on the image
    function getFee($amount) {
        if ($amount <= 100000) {
            return 5000;
        } elseif ($amount <= 200000) {
            return 8000;
        } elseif ($amount <= 300000) {
            return 10000;
        } elseif ($amount <= 400000) {
            return 12000;
        } elseif ($amount <= 500000) {
            return 15000;
        } elseif ($amount <= 600000) {
            return 17000;
        } elseif ($amount <= 700000) {
            return 20000;
        } elseif ($amount <= 800000) {
            return 22000;
        } elseif ($amount <= 900000) {
            return 25000;
        } elseif ($amount <= 1000000) {
            return 30000;
        } else {
            return 0; // No fee if above the max amount
        }
    }

    // Get the applicable fee based on the amount
    $fee = getFee($amount);

    // Update payment amount in the database
    $stmt = $conn->prepare("UPDATE conversation_flow SET amount = ? WHERE chatId = ?");
    $stmt->execute([$amount, $chatId]);

    // Create response message
    $response_message = "Ingiza namba ya simu kutuma kiasi TZS $amount /- kwa makato TZS $fee /- kwenda kwa $receiver Mwenye taarifa za benki zifuatazo: $bank_details";

    // Send JSON response
    echo json_encode(['text' => $response_message, 'message' => 'Amount updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
