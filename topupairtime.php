<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Your BudPay API secret key
    $secretKey = 'YOUR_SECRET_KEY';

// The HMAC-SHA-512 signature for encryption (Replace with your actual signature)
    $signatureHMACSHA512 = 'YOUR_SIGNATURE_HMAC_SHA_512';

// Airtime Top-up Details
    $provider = htmlspecialchars($_POST['provider']); // Airtime provider
    $number = htmlspecialchars($_POST['number']); // Phone number to top-up
    $amount = htmlspecialchars($_POST['amount']); // Amount to top-up (in smallest currency unit)
    $reference = htmlspecialchars($_POST['refid']); // Unique transaction reference

// Call the budPayAirtimeTopup function
    $response = budPayAirtimeTopup($secretKey, $provider, $number, $amount, $reference, $signatureHMACSHA512);

// Check the response
    if (is_array($response)) {
        if (isset($response['status']) && $response['status'] === 'success') {
            echo 'Airtime top-up successful: ' . $response['data']['transaction_id'];
        } else {
            echo 'Failed to perform airtime top-up: ' . $response['message'];
        }
    } else {
        echo 'Error: ' . $response;
    }
}
?>
