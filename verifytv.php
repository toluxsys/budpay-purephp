<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['provider']) && !empty($_GET['provider'])  && !empty($_GET['number'])) {
        $secretKey = 'YOUR_SECRET_KEY'; // Replace with your actual secret key
        $provider = $_GET['provider'];
        $number= $_GET['number'];

        //a Get TV packages based on provider
        $response = getBudPayVerifyTv($secretKey, $provider, $number);

        // Check if the response was successful
        if (isset($response['success']) && $response['success'] === true) {
            // Output the package data
            header('Content-Type: application/json');
            return json_encode($response['data']);
        } else {
            // Output error message
            header('Content-Type: application/json');
            return json_encode(['error' => $response['message']]);
        }
    } else {
        // Output error if provider is not specified
        header('Content-Type: application/json');
        return json_encode(['error' => 'Provider parameter is required']);
    }
} else {
    // Handle non-GET requests
    header('Content-Type: application/json');
    return json_encode(['error' => 'Invalid request method']);
}

?>