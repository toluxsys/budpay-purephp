<?php

// Include or require the function definition for processPayment
// require 'payment_functions.php'; // Uncomment and adjust if functions are in a separate file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the form data
    $secretKey = 'your_api_secret_key'; // Set your payment gateway API secret key here
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $callback = htmlspecialchars($_POST['callback']);
    $amount = intval($_POST['amount']) * 100; // Convert amount to cents

    // Payment details
    $currency = 'NGN';
    $description = 'Payment for Order #1234';

    // Call the processPayment function
    $response = processPayment($secretKey, $amount, $currency, $callback, $name, $email);

    // Check the response
    if (is_array($response)) {
        if (isset($response['status']) && $response['status'] === 'true') {
            $transactionId = $response['data']['reference'];

            // Redirect to verify_payment.php with the transaction ID
            header("Location: verify_payment.php?transaction_id=$transactionId");
            exit();
        } else {
            echo 'Payment failed: ' . $response['message'];
        }
    } else {
        echo 'Payment failed: ' . $response;
    }
} else {
    // If the form was not submitted, redirect back to the form or display an error
    header('Location: payment_form.html');
    exit();
}

?>
