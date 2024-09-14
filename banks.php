<?php
include("connection/db.php");


// receive incoming json input
$input = file_get_contents('php://input');
$data = json_decode($input, true);


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

$SQL_QUERY = "INSERT INTO conversation_flow (chatId) VALUES ('" . $data['chat_id'] . "')";
$conn->query($SQL_QUERY);

$response = [
    "send_reply_button" => [
        "type" => "button",
        "body" => ["text" => "Choose your seat"],
        "action" => [
            "buttons" => [
                [
                    "type" => "reply",
                    "reply" => [
                        "id" => "1",
                        "title" => "Tanzania"
                    ]
                ],
                [
                    "type" => "reply",
                    "reply" => [
                        "id" => "2",
                        "title" => "India"
                    ]
                ]
            ]
        ]
    ]
];


echo json_encode($response);