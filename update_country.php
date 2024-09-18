<?php
// update_country.php

include 'connection/db.php';


$input = file_get_contents('php://input');
$data = json_decode($input, true)??$_SERVER['REQUEST_METHOD'];

if (isset($data['chat_id'])) {
    $chatId = $data['chat_id'];
    $country = $data['choice_3'];

    error_log(Json_encode($data));

    // Update user country
    $stmt = $conn->prepare("UPDATE conversation_flow SET country = ? WHERE chatId = ?");
    $stmt->execute([$country, $chatId]);

    echo json_encode(['status' => 'success', 'message' => 'Country updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
