<?php
session_start();
$position = $_SESSION["position"];
if (!isset($position)) {
    // If 'selectedOption' is not set, redirect to 'login.php'
    header("Location: http://localhost/login.php");
    exit(); // Stop further execution of the script
}
print_r("User: ". $position);
?>

<!doctype html>
<html lang="en">
<?php
        include "./head.php";
?>

<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php
    include "./header.php";
include "./home.php";

?>

<script src="./assets/js/logout.js"></script>
</body>

</html>