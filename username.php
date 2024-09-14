<?php
include("connection/db.php");


// receive incoming json input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Log the input for debugging
error_log($input);


// log details to db with $conn
/**
 * Conversation flow has
 * id
 * chatId
 * name
 * country
 * amount
 * phoneNumber
 */


$SQL_QUERY = "UPDATE TABLE conversation_flow SET username=" . $data['user_name'] . "WHERE chatId=" . $data['chat_id'];
$conn->query($SQL_QUERY);


$response = ["text" => $data['user_name'] . " now we know where you want to send money?"];

// Output JSON response
header('Content-Type: application/json');
echo json_encode($response);