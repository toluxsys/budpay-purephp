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
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $reference = isset($_POST['reference']) ? $_POST['reference'] : '';
    $type = isset($_POST['typ']) ? $_POST['type'] : '';

    // Call the budPayPurchaseDataPlan function
    $response = payBudPayElecricityPay($secretKey, $signatureHMACSHA512, $provider, $number, $amount, $reference, $type);
    return $response;
} else {
    return 'No data submitted.';
}

?>
