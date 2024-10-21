<?php
session_start();
include("../Auth/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST["csrf_token"];
    echo $csrf_token;
    if (!empty($csrf_token) && hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        
        $userProvOption = $_POST["userProvOption"];
        $regName = htmlspecialchars(trim($_POST["regName"]));
        $regSurname = htmlspecialchars(trim($_POST["regSurname"]));
        $regEmail = htmlspecialchars(trim($_POST["regEmail"]));
        $regPass = htmlspecialchars(trim($_POST["regPass"]));
        $hashedPass = password_hash($regPass, PASSWORD_DEFAULT); // Hash the password
        echo $userProvOption . "\n";
        echo $regName . "\n";
        echo $regSurname . "\n";
        echo $regEmail . "\n";
        echo $regPass . "\n";

        if ($userProvOption === "Provider") {

            echo "Youre the provider";
            //insert in provider db
            $providerId = uniqid("prid-");
            $stmt = $conn->prepare("INSERT INTO `provider` (`provider_id`, `position`, `provider_name`, `provider_surname`, `email`, `password`) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $providerId, $userProvOption, $regName, $regSurname, $regEmail, $hashedPass);
            if ($stmt->execute()) {
                $_SESSION['providerId'] = $providerId;
                $_SESSION['provider'] = $userProvOption;
            } else {
                die("Database error: " . $conn->error);
            }

        } elseif ($userProvOption === "Client") {
            echo "Youre the Client";
            //insert in user db
            $clientId = uniqid("clid-");
            $stmt = $conn->prepare("INSERT INTO `client` (`client_id`, `position`, `client_name`, `client_surname`, `email`, `password`) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $clientId, $userProvOption, $regName, $regSurname, $regEmail, $hashedPass);
            if ($stmt->execute()) {
                $_SESSION['clientId'] = $clientId;
                $_SESSION['provider'] = $userProvOption;
            } else {
                die("Database error: " . $conn->error);
            }

        }
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Regenerate token after successful form submission
        

    } else {
        echo("CSRF token mismatch");
    }

} else {
    echo("Invalid request method");
}
