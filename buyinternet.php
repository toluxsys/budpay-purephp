<?php
// Your BudPay API secret key
$secretKey = 'YOUR_SECRET_KEY';

// The HMAC-SHA-512 signature for encryption (Replace with your actual signature)
$signatureHMACSHA512 = 'YOUR_SIGNATURE_HMAC_SHA_512';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $provider = isset($_POST['provider']) ? $_POST['provider'] : '';
    $number = isset($_POST['number']) ? $_POST['number'] : '';
    $planId = isset($_POST['planId']) ? $_POST['planId'] : '';
    $reference = isset($_POST['reference']) ? $_POST['reference'] : '';

    // Call the budPayPurchaseDataPlan function
    $response = budPayPurchaseDataPlan($secretKey, $provider, $number, $planId, $reference, $signatureHMACSHA512);

    // Check the response
    if (is_array($response)) {
        if (isset($response['status']) && $response['status'] === 'success') {
            return 'Data purchase successful: ' . $response['data']['transaction_id'];
        } else {
            return 'Failed to purchase data: ' . $response['message'];
        }
    } else {
        echo 'Error: ' . $response;
    }
} else {
    echo 'No data submitted.';
}

?>
