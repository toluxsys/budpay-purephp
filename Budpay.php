<?php

/**
 * Process a payment using the payment gateway API.
 *
 * @param string $apiKey Payment gateway API key.
 * @param string $apiSecret Payment gateway API secret.
 * @param float $amount Amount to be charged (in smallest currency unit, e.g., cents for USD).
 * @param string $currency Currency code (e.g., 'USD').
 * @param string $description Description of the payment.
 * @param string $customerName Customer's name.
 * @param string $customerEmail Customer's email.
 * @return array|string The response from the API or an error message.
 */
function processPayment( $secretKey, $amount, $callback, $customerName, $customerEmail) {
    // URL to which the API request will be sent
    $apiUrl = 'https://api.budpay.com/api/v2/transaction/initialize';

    // Data to be sent in the API request
    $data = [
        'amount' => $amount,
        'callback' => $callback,
            'name' => $customerName,
            'email' => $customerEmail,
    ];

    // Convert the data array to JSON format
    $jsonData = json_encode($data);

    try {
        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set the necessary options for cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Basic '. $secretKey,
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

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

function createBudPayPaymentLink($secretKey, $amount, $currency, $name, $description, $redirectUrl) {
    // BudPay API endpoint for creating a payment link
    $apiUrl = 'https://api.budpay.com/api/v2/create_payment_link';

    // Data to send in the POST request
    $postData = [
        'amount' => $amount,
        'currency' => $currency,
        'name' => $name,
        'description' => $description,
        'redirect' => $redirectUrl,
    ];

    try {
        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set the necessary options for cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $secretKey,
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

function banklist($secretKey) {
    // Correct URL to which the API request will be sent
    $apiUrl = 'https://api.budpay.com/api/v2/bank_list/NGN';

    try {
        // Initialize cURL session
        $ch = curl_init();

        // Set the necessary options for cURL
        curl_setopt($ch, CURLOPT_URL, $apiUrl); // Set the API URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $secretKey, // Use Bearer for authorization
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

function validateaccountnumber($secretKey, $bankcode,$accountnumber) {
    // BudPay API endpoint for creating a payment link
    $apiUrl = 'https://api.budpay.com/api/v2/account_name_verify';

    // Data to send in the POST request
    $postData = [
        'bank_code' => $bankcode,
        'account_number' => $accountnumber,
    ];

    try {
        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set the necessary options for cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $secretKey,
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
function Singlepayout($secretKey, $signatureHMACSHA512, $address, $bankcode, $accountnumber, $name, $currency, $bankname, $narration, $amount) {
    // BudPay API endpoint for single payout
    $apiUrl = 'https://api.budpay.com/api/v2/bank_transfer';

    // Data to send in the POST request
    $postData = [
        'bank_code' => $bankcode,
        'account_number' => $accountnumber,
        'bank_name' => $bankname,
        'amount' => $amount,
        'narration' => $narration,
        'currency' => $currency,
        'meta_data' => [
            'sender_name' => $name,
            'sender_address' => $address
        ]
    ];

    try {
        // Initialize cURL session
        $ch = curl_init();

        // Set the necessary options for cURL
        curl_setopt($ch, CURLOPT_URL, $apiUrl); // Set the API URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Specify that this is a POST request
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $secretKey,
            'Encryption: ' . $signatureHMACSHA512, // Add HMAC SHA-512 signature for encryption

            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData)); // Encode the data as JSON

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

function bulkBankTransfer($secretKey, $signatureHMACSHA512, $currency, $transfers) {
    // BudPay API endpoint for bulk bank transfer
    $apiUrl = 'https://api.budpay.com/api/v2/bulk_bank_transfer';

    // Data to be sent in the POST request
    $postData = [
        'currency' => $currency,
        'transfers' => $transfers
    ];

    try {
        // Initialize cURL session
        $ch = curl_init();

        // Set the necessary options for cURL
        curl_setopt($ch, CURLOPT_URL, $apiUrl); // Set the API URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true); // Specify that this is a POST request
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $secretKey, // Add the secret key in Authorization header
            'Encryption: ' . $signatureHMACSHA512, // Add HMAC SHA-512 signature for encryption
            'Content-Type: application/json', // Set the content type to JSON
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData)); // Encode the data as JSON

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

function fetchPayoutStatus($secretKey, $reference) {
    // BudPay API endpoint for fetching payout status by reference
    $apiUrl = 'https://api.budpay.com/api/v2/payout/' . $reference;

    try {
        // Initialize cURL session
        $ch = curl_init();

        // Set the necessary options for cURL
        curl_setopt($ch, CURLOPT_URL, $apiUrl); // Set the API URL with the reference
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $secretKey, // Add the secret key in Authorization header
            'Content-Type: application/json', // Set the content type to JSON
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); // Use GET method

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

function fetchWalletBalance($secretKey, $currency) {
    // BudPay API endpoint for fetching wallet balance by currency
    $apiUrl = 'https://api.budpay.com/api/v2/wallet_balance/' . $currency;

    try {
        // Initialize cURL session
        $ch = curl_init();

        // Set the necessary options for cURL
        curl_setopt($ch, CURLOPT_URL, $apiUrl); // Set the API URL with the currency
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $secretKey, // Add the secret key in Authorization header
            'Content-Type: application/json', // Set the content type to JSON
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); // Use GET method

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
