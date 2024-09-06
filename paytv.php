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
    $code = isset($_POST['code']) ? $_POST['planId'] : '';
    $reference = isset($_POST['reference']) ? $_POST['reference'] : '';

    // Call the budPayPurchaseDataPlan function
    $response = payBudPayTvPackage($secretKey, $signatureHMACSHA512, $provider, $number, $code, $reference);
    return $response;
} else {
    return 'No data submitted.';
}

?>
