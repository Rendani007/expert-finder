<?php
session_start();
include '../Auth/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST["csrf_token"];

    if (!empty($csrf_token) && hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        $confirmPassword = $_POST["confirmPassword"];
        $userEmail = $_POST["userEmail"];

        function validateUser($conn, $emailInput, $dbTable)
        {
            // Prepare a statement to find the user by email in the specified table
            $stmt = $conn->prepare("SELECT `email`, `position` FROM `$dbTable` WHERE `email` = ?");
            if (!$stmt) {
                die("Error preparing statement: " . $conn->error);  // Debug: Check if statement is prepared correctly
            }
            $stmt->bind_param("s", $emailInput);

            if($stmt->execute()){
                $stmt->store_result();
                if($stmt->num_rows > 0){
                    $stmt->bind_result($userEmail, $position);
                    if($stmt->fetch()){
                        return [
                            'email' => $userEmail,
                            'position' => $position
                        ];
                    }
                }
            }
            $stmt->close();
            return null;  // Return null if user not found
        }

        // Check the client table
        $userData = validateUser($conn, $userEmail, 'client');

        // If not found in client, check provider
        if (!$userData) {
            $userData = validateUser($conn, $userEmail, 'provider');
        }

        if ($userData) {
            // Hash the password before updating
            $hashedPass = password_hash($confirmPassword, PASSWORD_DEFAULT);

            // Determine which table to update based on user position
            $tableToUpdate = $userData['position'] === "Client" ? 'client' : 'provider';

            // Prepare the update statement
            $stmt = $conn->prepare("UPDATE `$tableToUpdate` SET `password` = ? WHERE `email` = ?");
            $stmt->bind_param("ss", $hashedPass, $userData['email']);

            if ($stmt->execute()) {
                echo "Password updated successfully for " . $userData['position'];
            } else {
                die("Database error: " . $stmt->error);
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "User not found.";
        }
    } else {
        echo "Invalid CSRF token.";
    }
}
