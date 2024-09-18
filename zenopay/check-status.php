<?php
function checkOrderStatus($order_id) {
    // The endpoint URL where the request will be sent
    $endpointUrl = "https://api.zeno.africa/order-status";

    // Data to be sent in the POST request
    $postData = [
        'check_status' => 1,
        'order_id' => $order_id,
        'api_key' => 'reyfyfufu',
        'secret_key' => 'YOUR SECRET KEY '
    ];

    // Initialize cURL
    $ch = curl_init($endpointUrl);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($ch, CURLOPT_POST, true); // Send as POST request
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData)); // Add POST fields

    // Execute the request and get the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo json_encode([
            "status" => "error",
            "message" => 'cURL error: ' . curl_error($ch)
        ]);
        curl_close($ch);
        return false;
    } else {
        // Decode the JSON response
        $responseData = json_decode($response, true);

        // Format the response to match the desired structure
        if ($responseData['status'] === 'success') {
            echo json_encode([
                "status" => "success",
                "order_id" => $responseData['order_id'],
                "message" => $responseData['message'],
                "payment_status" => $responseData['payment_status']
            ]);
            curl_close($ch);
            return true;
        } else {
            echo json_encode([
                "status" => "error",
                "message" => $responseData['message']
            ]);
            curl_close($ch);
            return false;
        }
    }
}

?>