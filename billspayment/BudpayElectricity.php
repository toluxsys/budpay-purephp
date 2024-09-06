<?php
/**
 * Function to make a GET request to the BudPay API
 *
 * @param string $secretKey Your BudPay API secret key
 * @return array|string The response from the API or an error message
 */
function getBudPayElectricityData($secretKey) {
    $url = 'https://api.budpay.com/api/v2/electricity';

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $secretKey,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    // Execute cURL session
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return 'cURL Error: ' . $error;
    }

    // Close cURL session
    curl_close($ch);

    // Decode JSON response
    $decodedResponse = json_decode($response, true);

    // Check if JSON decoding was successful
    if (json_last_error() === JSON_ERROR_NONE) {
        return $decodedResponse;
    } else {
        return 'JSON Decode Error: ' . json_last_error_msg();
    }
}



function getBudPayVerifyElectricity($secretKey, $provider, $number, $type) {
    $url = 'https://api.budpay.com/api/v2/electricity/validate';
    $data = [
        'provider' => $provider,
        'number' => $number,
        'type' => $type
    ];

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $secretKey,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));


    // Execute cURL session
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return 'cURL Error: ' . $error;
    }

    // Close cURL session
    curl_close($ch);

    // Decode JSON response
    $decodedResponse = json_decode($response, true);

    // Check if JSON decoding was successful
    if (json_last_error() === JSON_ERROR_NONE) {
        return $decodedResponse;
    } else {
        return 'JSON Decode Error: ' . json_last_error_msg();
    }
}

function payBudPayElecricityPay($secretKey, $signatureHMACSHA512, $provider, $number, $amount, $reference, $type) {
    $url = 'https://api.budpay.com/api/v2/electricity/recharge';

    // Prepare the data to send in the request
    $data = [
        'provider' => $provider,
        'number' => $number,
        'amount' => $amount,
        'reference' => $reference,
        'type' => $type
    ];

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $secretKey,
        'Encryption: ' . $signatureHMACSHA512,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute cURL session
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return 'cURL Error: ' . $error;
    }

    // Close cURL session
    curl_close($ch);

    // Decode JSON response
    $decodedResponse = json_decode($response, true);

    // Check if JSON decoding was successful
    if (json_last_error() === JSON_ERROR_NONE) {
        return $decodedResponse;
    } else {
        return 'JSON Decode Error: ' . json_last_error_msg();
    }
}


?>
