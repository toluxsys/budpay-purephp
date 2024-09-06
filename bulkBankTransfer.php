<?php
// Your BudPay API secret key
$secretKey = 'YOUR_SECRET_KEY';

// The HMAC-SHA-512 signature for encryption (Replace with your actual signature)
$signatureHMACSHA512 = 'YOUR_SIGNATURE_HMAC_SHA_512';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $transfers['bank_code'] = isset($_POST['bankcode']) ? $_POST['bankcode'] : '';
    $transfers['account_number'] = isset($_POST['number']) ? $_POST['number'] : '';
    $transfers['bank_name'] = isset($_POST['bankname']) ? $_POST['bankname'] : '';
    $transfers['amount'] = isset($_POST['amount']) ? $_POST['amount'] : '';
    $transfers['narration'] = isset($_POST['narration']) ? $_POST['narration'] : '';
    $currency = isset($_POST['currency']) ? $_POST['currency'] : '';

    // Call the budPayPurchaseDataPlan function
    $response = bulkBankTransfer($secretKey, $signatureHMACSHA512,$currency, $transfers);
    return $response;
} else {
    return 'No data submitted.';
}

?>
