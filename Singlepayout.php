<?php
// Your BudPay API secret key
$secretKey = 'YOUR_SECRET_KEY';

// The HMAC-SHA-512 signature for encryption (Replace with your actual signature)
$signatureHMACSHA512 = 'YOUR_SIGNATURE_HMAC_SHA_512';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $bankcode = isset($_POST['bankcode']) ? $_POST['bankcode'] : '';
    $accountnumber = isset($_POST['number']) ? $_POST['number'] : '';
    $bankname = isset($_POST['bankname']) ? $_POST['bankname'] : '';
    $narration = isset($_POST['narration']) ? $_POST['narration'] : '';
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $currency = isset($_POST['currency']) ? $_POST['currency'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';

    // Call the budPayPurchaseDataPlan function
    $response = Singlepayout($secretKey, $signatureHMACSHA512, $address, $name, $currency, $amount, $bankcode, $accountnumber, $bankname, $narration);
    return $response;
} else {
    return 'No data submitted.';
}

?>
