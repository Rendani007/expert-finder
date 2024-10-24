<?php

session_start();

// Adjust the path to include the connection file
include '../Auth/connect.php';  // Modify this based on the actual location of your script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST["csrf_token"];

    if (!empty($csrf_token) && hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        $emailInput = $_POST["emailInput"];
        $password = $_POST["password"];


        // Function to validate email and password against a given table
        function validateUser($conn, $emailInput, $password, $tableName)
        {
            echo "Checking in table: " . $tableName . "<br>\n";  // Debug: Which table is being checked
            
            // Prepare a statement to find the user by email in the specified table
            $stmt = $conn->prepare("SELECT `email`, `password`, `position` FROM `$tableName` WHERE `email` = ?");
            if (!$stmt) {
                die("Error preparing statement: " . $conn->error);  // Debug: Check if statement is prepared correctly
            }
            $stmt->bind_param("s", $emailInput);

            // Execute the statement
            if ($stmt->execute()) {
                $stmt->store_result();  // Store result set
                if ($stmt->num_rows > 0) {
                    echo "Yes user found in table: $tableName<br>\n";
                    // Bind result variables
                    $stmt->bind_result($userEmail, $storedPasswordHash, $position);

                    // Fetch the result
                    if ($stmt->fetch()) {
                        echo "Fetched data: " . $userEmail . ", " . $position . "<br>\n";  // Debug: Show fetched data

                        // Verify the entered password against the stored hash
                        if (password_verify($password, $storedPasswordHash)) {
                            echo "Password verification passed<br> \n";  // Debug: Password verification success
                            return [
                                'email' => $userEmail,
                                'position' => $position
                            ];
                        } else {
                            echo "Password verification failed<br>\n";  // Debug: Password verification failed
                        }
                    }
                } else {
                    echo "No user found in table: $tableName<br>\n";  // Debug: No user found in the table
                }
            } else {
                echo "Error executing query: " . $stmt->error ."\n";  // Debug: Query execution error
            }
            return false; // Return false if no match found
        }

        // Check the client table first
        $userData = validateUser($conn, $emailInput, $password, 'client');

        if ($userData && $userData['position'] === "Client") {
            echo "You are the: " . $userData['position'];
                $position = $userData['position'];
                //session
                $_SESSION["position"] = $position;
        } else {
            // If not found in the client table, check the provider table
            $userData = validateUser($conn, $emailInput, $password, 'provider');

            if ($userData && $userData['position'] === "Provider") {
                echo "You are the: " . $userData['position'];
                $position = $userData['position'];
                //session
                $_SESSION["position"] = $position;
            } else {
                // No match in either table
                echo "Invalid email or password.\n";
            }
        }
    } else {
        echo "Invalid CSRF token.\n";
    }
}
