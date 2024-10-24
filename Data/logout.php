<?php
session_start();  // Start the session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Optionally, clear the session cookie if it's set
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Ensure no other output happens before sending JSON response
header('Content-Type: application/json');
echo json_encode(['status' => 'success']);
exit();
