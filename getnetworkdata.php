<?php

// Your BudPay API secret key
$secretKey = 'YOUR_SECRET_KEY';

// Call the getBudPayInternetDetails function
$response = getBudPayInternetDetails($secretKey);

// Check the response
if (is_array($response)) {
    if (isset($response['status']) && $response['status'] === 'success') {
        // Process and display the internet service details

        return$response['data'];
    } else {
        return 'Failed to retrieve internet service details: ' . $response['message'];
    }
} else {
    return 'Error: ' . $response;
}

?>
