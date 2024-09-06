<?php


// Your BudPay API secret key
$secretKey = 'YOUR_SECRET_KEY';

// Call the getBudPayAirtimeDetails function
$response = getBudPayAirtimeDetails($secretKey);

// Check the response
if (is_array($response)) {
    if (isset($response['status']) && $response['status'] === 'success') {
        // Process and display the airtime details

        return$response['data'];
    } else {
        return 'Failed to retrieve airtime details: ' . $response['message'];
    }
} else {
    return 'Error: ' . $response;
}


