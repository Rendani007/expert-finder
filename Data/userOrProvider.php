<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST["csrf_token"];
    if (!empty($csrf_token) && hash_equals($_SESSION['csrf_token'], $csrf_token)) {

        $selectedOption = $_POST["selectedOption"];


        $_SESSION['selectedOption'] = $selectedOption;


    } else {
        echo("CSRF token mismatch");
    }

} else {
    echo("Invalid request method");
}
