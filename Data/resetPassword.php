<?php
session_start();
// $userEmail = $_POST["userEmail"];
// echo($userEmail);
// Ensure the database connection is established
// Example: $conn = new mysqli("hostname", "username", "password", "database_name");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST["csrf_token"];
    

    if (!empty($csrf_token) && hash_equals($_SESSION['csrf_token'], $csrf_token)) {
       
        
        $confirmPassword = $_POST["confirmPassword"];
        $userEmail = $_POST["userEmail"];
     
        echo($userEmail);
        // Hash the password before updating
        $hashedPass = password_hash($confirmPassword, PASSWORD_DEFAULT);
        
        // Update the password in the client table where the email matches
        $stmt = $conn->prepare("UPDATE `client` SET `password` = ? WHERE `email` = ?");
        $stmt->bind_param("ss", $hashedPass, $userEmail);

        if ($stmt->execute()) {
            echo "Password updated successfully.";
        } else {
            die("Database error: " . $stmt->error);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid CSRF token.";
    }


}
