<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Capture the form data
    $secretKey = 'your_api_secret_key'; // Set your payment gateway API secret key here
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $redirectUrl = 'https://your_redirect_link';

    $amount = intval($_POST['amount']) * 100; // Convert amount to cents

// Your BudPay API secret key
    $secretKey = 'YOUR_SECRET_KEY';

    $currency = 'NGN';
    $description = 'my description';

// Call the createBudPayPaymentLink function
    $response = createBudPayPaymentLink($secretKey, $amount, $currency, $name, $description, $redirectUrl);

// Check the response
    if (is_array($response)) {
        if (isset($response['status']) && $response['status'] === 'success') {
            $paymentLink = $response['data']['payment_link'];
            echo "Payment link created successfully: <a href=\"$paymentLink\">$paymentLink</a>";
        } else {
            echo 'Failed to create payment link: ' . $response['message'];
        }
    } else {
        echo 'Error: ' . $response;
    }

}
?>
