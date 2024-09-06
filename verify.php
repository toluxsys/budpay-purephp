<?php

/**
 * Verify a payment using the payment gateway API.
 *
 * @param string $apiKey Payment gateway API key.
 * @param string $apiSecret Payment gateway API secret.
 * @param string $transactionId The transaction ID of the payment to verify.
 * @return array|string The response from the API or an error message.
 */
function verifyPayment($secretKey, $transactionId) {
    // URL to which the API request will be sent
    $apiUrl = 'https://api.budpay.com/api/v2/transaction/verify/' . $transactionId;

    try {
        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set the necessary options for cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' .$secretKey,
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

?>
