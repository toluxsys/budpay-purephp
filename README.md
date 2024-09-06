# Budpay_PurePHP
paymentlink.php: This script handles the creation of payment links using BudPay's API. Users can fill out a form with the necessary payment details, and the script will generate a payment link that redirects users to BudPay's payment page.

processPayment.php: This script is responsible for processing payments. It captures the payment details, sends them to BudPay's API, and then redirects the user to the payment verification page.

verify.php: This script verifies the payment status after the payment process is completed. It confirms whether the transaction was successful and can be used to update the order status in your system.

Usage
1. Create Payment Link
   To create a payment link, users will interact with the paymentlink.php script.

Form Fields:

    (i).name: The name of the payer.
    (ii).amount: The amount to be charged (in NGN).
    (iii).description: A brief description of the payment.
    (iv).redirectUrl: The URL to redirect the user after the payment is completed.
    (v).Process:

    (vi).Fill in the form and submit it.
The script will generate a payment link and display it to the user.
2. Process Payment
   The processPayment.php script handles the actual payment process.

        Flow:
        (i).Capture the payment details from the form submission.
        (ii).Send the details to BudPay's API.
        (iii).Redirect the user to the payment verification page with the transaction ID.
   3. Verify Payment
      After the payment process, the verify.php script will be used to confirm the payment status.

            Flow:
            (i).The script checks the transaction ID passed from the processPayment.php.
            (ii).It verifies the payment status with BudPay.
            (iii).It displays a success or failure message based on the verification.
Installation
Set Up Your Environment:

Ensure your server has PHP installed.
Obtain your BudPay API secret key from your BudPay dashboard.
Configuration:

Open each script and replace 'YOUR_SECRET_KEY' with your actual BudPay API secret key.
File Structure:

Ensure that all PHP scripts are placed in the appropriate directories on your server.
Permissions:

Ensure your web server has the correct permissions to execute the PHP scripts.
Running the Scripts
Access the Form:

Navigate to the paymentlink.php file in your browser.
Fill out the form with the required details and submit it.
Follow the Payment Process:

Upon submission, you will be provided with a payment link.
Click the link to proceed with the payment.
Verify Payment:

After the payment, you will be redirected to verify.php, where the payment status will be confirmed.
Error Handling
Ensure that all required form fields are filled out correctly before submission.
If the API returns an error, it will be displayed on the page.
Check the server logs for any additional errors if the scripts do not behave as expected.
License
This project is licensed under the MIT License - see the LICENSE file for details.

