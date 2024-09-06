<?php

// Your BudPay API secret key
$secretKey = 'YOUR_SECRET_KEY';

// Check if the provider is passed via the GET request
if (isset($_GET['provider'])) {
    $provider = $_GET['provider'];
} else {
    die('Error: Provider not specified. Please provide a provider in the URL as ?provider=PROVIDER_NAME');
}

// Call the getBudPayInternetPlans function
$response = getBudPayInternetPlans($secretKey, $provider);

// Check the response
if (is_array($response)) {
    if (isset($response['status']) && $response['status'] === 'success') {
        // Process and display the internet plans for the provider
        return$response['data'];
    } else {
        return 'Failed to retrieve internet plans: ' . $response['message'];
    }
} else {
    return 'Error: ' . $response;
}

?>
