<?php

/**
 * Get Internet Service Details from BudPay API.
 *
 * @param string $secretKey Your BudPay API secret key.
 * @return array|string The response from the API or an error message.
 */
function getBudPayInternetDetails($secretKey) {
    // BudPay API endpoint for getting internet service details
    $apiUrl = 'https://api.budpay.com/api/v2/internet';

    try {
        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set the necessary options for cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $secretKey,
            'Content-Type: application/json',
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }

        // Close the cURL session
        curl_close($ch);

        // Decode the response from JSON to an array
        $responseData = json_decode($response, true);

        // Return the API response
        return $responseData;

    } catch (Exception $e) {
        // Return the error message
        return 'Error: ' . $e->getMessage();
    }
}

function getBudPayInternetPlans($secretKey, $provider) {
    // BudPay API endpoint for getting internet plans for a specific provider
    $apiUrl = 'https://api.budpay.com/api/v2/internet/plans/' . urlencode($provider);

    try {
        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set the necessary options for cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $secretKey,
            'Content-Type: application/json',
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }

        // Close the cURL session
        curl_close($ch);

        // Decode the response from JSON to an array
        $responseData = json_decode($response, true);

        // Return the API response
        return $responseData;

    } catch (Exception $e) {
        // Return the error message
        return 'Error: ' . $e->getMessage();
    }
}

function budPayPurchaseDataPlan($secretKey, $provider, $number, $planId, $reference, $signatureHMACSHA512) {
    // BudPay API endpoint for purchasing internet data
    $apiUrl = 'https://api.budpay.com/api/v2/internet/data';

    // Data to send in the POST request
    $postData = [
        'provider' => $provider,
        'number' => $number,
        'plan_id' => $planId,
        'reference' => $reference,
    ];

    try {
        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set the necessary options for cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $secretKey,
            'Encryption: ' . $signatureHMACSHA512,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }

        // Close the cURL session
        curl_close($ch);

        // Decode the response from JSON to an array
        $responseData = json_decode($response, true);

        // Return the API response
        return $responseData;

    } catch (Exception $e) {
        // Return the error message
        return 'Error: ' . $e->getMessage();
    }
}

?>