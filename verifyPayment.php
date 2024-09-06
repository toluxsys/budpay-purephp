<?php

// Include or require the function definition for verifyPayment
// require 'payment_functions.php'; // Uncomment and adjust if functions are in a separate file

// Check if the transaction ID is provided
if (isset($_GET['transaction_id'])) {
    $transactionId = htmlspecialchars($_GET['transaction_id']);
    $secretKey = 'your_api_secret_key'; // Set your payment gateway API secret key here

    // Call the verifyPayment function
    $response = verifyPayment($secretKey, $transactionId);

    // Check the response
    if (is_array($response) && isset($response['status'])) {
        if ($response['status'] === 'true') {
            echo 'Payment verification successful! Transaction ID: ' . $response['data']['reference'];
            // Additional logic here (e.g., update order status in the database, send a confirmation email, etc.)
        } else {
            echo 'Payment verification failed: ' . $response['message'];
        }
    } else {
        echo 'Error: ' . $response;
    }
} else {
    echo 'Transaction ID not provided.';
    // You may want to redirect back to the payment page or an error page
    // header('Location: error_page.html');
    // exit();
}

?>
