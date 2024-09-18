<?php
// check_status.php

include 'connection/db.php';
include 'zenopay/check-status.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true) ?? $_SERVER['REQUEST_METHOD'];


if (isset($data['chat_id'])) {
    $chatId = $data['chat_id'];

    $q = "SELECT * FROM conversation_flow WHERE chatId = ?";
    $stmt = $conn->prepare($q);
    $stmt->execute([$chatId]);
    $conversation = $stmt->fetch();

    if (!$conversation) {
        $response_message = "Kuna tatizo limetokea kwenye uchakaji wa taarifa za malipo tafadhali jaribu tena";
    }

    $order_id = $conversation['order_id'];
    if (!$order_id || empty($order_id)) {
        $response_message = "Kuna tatizo limetokea kwenye uchakaji wa taarifa za malipo tafadhali jaribu tena";
    }

    $result = checkOrderStatus($order_id);
    if ($result) {
        $response_message = "Malipo yako yamefanikiwa, Ahsante kwa kutumia ChapCash";
    } else {
        $response_message = "Malipo yako hayajakamilika, tafadhali jaribu tena.";
    }

    error_log(json_encode($data));

} else {
    error_log(json_encode(['status' => 'error', 'message' => 'Invalid request']));
}
?>