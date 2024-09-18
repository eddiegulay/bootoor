<?php
// update_phone.php

include 'connection/db.php';
include 'zenopay/zenopay.php';


$input = file_get_contents('php://input');
$data = json_decode($input, true) ?? $_SERVER['REQUEST_METHOD'];


if (isset($data['chat_id'])) {
    $chatId = $data['chat_id'];
    $phoneNumber = $data['confirmations_2'];
    $amount = $data['number_ya_sender_bank'];

    error_log(Json_encode($data));

    // Update user phone number
    $stmt = $conn->prepare("UPDATE conversation_flow SET phoneNumber = ? WHERE chatId = ?");
    $stmt->execute([$phoneNumber, $chatId]);

    $status = make_payment($phoneNumber, $amount);

    if ($status->status == 'success') {
        $response_message = "Utapokea ujumbe wa kuthibitisha malipo. Ingiza PIN yako kukamilisha malipo.";

        $order_id = $status->order_id;

        $stmt = $conn->prepare("UPDATE conversation_flow SET order_id = ? WHERE chatId = ?");
        $stmt->execute([$order_id, $chatId]);
    } else {
        $response_message = "Malipo yameshindikana. Tafadhali jaribu tena.";
    }

    echo json_encode(['text' => $response_message, 'message' => 'Phone number updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>