<?php

/**
 * Get Airtime Details from BudPay API.
 *
 * @param string $secretKey Your BudPay API secret key.
 * @return array|string The response from the API or an error message.
 */
function getBudPayAirtimeDetails($secretKey) {
    // BudPay API endpoint for getting airtime details
    $apiUrl = 'https://api.budpay.com/api/v2/airtime';

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

function budPayAirtimeTopup($secretKey, $provider, $number, $amount, $reference, $signatureHMACSHA512) {
    // BudPay API endpoint for airtime top-up
    $apiUrl = 'https://api.budpay.com/api/v2/airtime/topup';

    // Data to send in the POST request
    $postData = [
        'provider' => $provider,
        'number' => $number,
        'amount' => $amount,
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
