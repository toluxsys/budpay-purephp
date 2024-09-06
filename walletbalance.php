<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $secretKey = 'YOUR_SECRET_KEY';
    $currency = 'NGN'; // For example, NGN for Nigerian Naira

// Call the function and print the response
    $response = fetchWalletBalance($secretKey, $currency);
    return $response;
} else {
    // Handle non-GET requests
    header('Content-Type: application/json');
    return json_encode(['error' => 'Invalid request method']);
}

?>