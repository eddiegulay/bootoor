<?php
include("connection/db.php");

$countries = [
    1 => "Tanzania",
    2 => "India",
];

// receive incoming json input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Log the input for debugging
error_log($input);

/**
 * Conversation flow has
 * id
 * chatId
 * name
 * country
 * amount
 * phoneNumber
 */
// now we are filling data with incoming chatID


$SQL_QUERY = "UPDATE TABLE conversation_flow SET country=" . $countries[$data['capture_name']] . "WHERE chatId=" . $data['chat_id'];
$conn->query($SQL_QUERY);

$response = ["text" => "What's your name?"];

// Output JSON response
header('Content-Type: application/json');
echo json_encode($response);