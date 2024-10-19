<?php
session_start();
$selectedOption = $_SESSION['selectedOption'];
$provider_position = $_SESSION['provider'];
$userType = $_SESSION["user_type"];
$position = $_SESSION["position"];

if (!isset($selectedOption)) {
    // If 'selectedOption' is not set, redirect to 'login.php'
    header("Location: http://localhost/login.php");
    exit(); // Stop further execution of the script
}
if (!isset($provider_position)) {
    // If 'selectedOption' is not set, redirect to 'login.php'
    header("Location: http://localhost/login.php");
    exit(); // Stop further execution of the script
}
if (!isset($userType)) {
    // If 'selectedOption' is not set, redirect to 'login.php'
    header("Location: http://localhost/login.php");
    exit(); // Stop further execution of the script
}
