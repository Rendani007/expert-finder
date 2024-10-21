<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST["csrf_token"];
    $emailInput = filter_var($_POST["emailInput"], FILTER_SANITIZE_EMAIL);  // Sanitize email input

    // CSRF Token Verification (ensure you've set and checked this elsewhere in your application)
    if ($csrf_token !== $_SESSION['csrf_token']) {
        die('CSRF token validation failed');
    }

    // env
    require __DIR__ . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $apiKey = getenv('SENDINBLUE_API_KEY');


    // Prepare the email data
    $data = array(
        "sender" => array("name" => "Expert Finder", "email" => "finder@domain.com"),
        "to" => array(
            array("email" => $emailInput)
        ),
        "subject" => "Password Reset Request",
        "htmlContent" => "<html><body><p>Click the link below to reset your password:</p><a href='http://localhost/resset-password.php'>Reset Password</a></body></html>"
    );

    // Initialize cURL
    $ch = curl_init('https://api.brevo.com/v3/smtp/email');

    // Set cURL options
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'api-key: ' . $apiKey,
        'Content-Type: application/json'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo 'Email sent successfully!';
    }
    // $_SESSION["userEmail"] = $emailInput;
    // Close cURL
    curl_close($ch);
}
