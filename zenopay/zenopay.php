<?php

$url = "https://api.zeno.africa";


function logError($message)
{
    file_put_contents('error_log.txt', $message . "\n", FILE_APPEND);
}


function make_payment($phone_number, $amount)
{
    global $url;
    $orderData = [
        'create_order' => 1,
        'buyer_email' => 'sikmrimi@gmail.com',
        'buyer_name' => 'chapcash',
        'buyer_phone' => $phone_number,
        'amount' => (int) $amount,
        'account_id' => 'zp57597',
        'api_key' => NULL,
        'secret_key' => NULL
    ];

    $queryString = http_build_query($orderData);
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $queryString,
        ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        logError("Error: Unable to connect to the API endpoint.");
    }
    error_log( $response);
    return json_decode($response);
}
