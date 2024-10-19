<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
    $CSRFtoken = $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // 32-byte token
} else {
    $CSRFtoken = $_SESSION['csrf_token'];
}
$userEmail = $_SESSION["userEmail"];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Expert Finder</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>
    <main class="p-2 bg-dark d-flex justify-content-center align-items-center">
        <div class="form-wrapper">
            <div class="logo text-white text-center mb-4">
                <h1 class="fw-bold">Expert Finder</h1>
            </div>
            <p type="text" class="textForm" for="floatingInput">One uppercase letter, one lowercase letter,
                one
                number, one
                special character, and a minimum length of 8 characters </p>
            <form id="formEmailReset">

                <div class="form-floating mb-3">

                    <input type="hidden" id="csrf_token" name="csrf_token"
                        value="<?php echo $CSRFtoken ?>">
                    <input type="hidden" id="userEmail" name="userEmail"
                        value="<?php echo $userEmail ?>">

                    <input type="password" class="form-control" id="Password" placeholder="name@example.com">
                    <label for="floatingInput">Password*</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="confirmPassword" placeholder="name@example.com">
                    <label for="floatingInput">Confirm Password*</label>
                </div>
                <div class="d-grid mb-3">
                    <button id="resetPassword" class="btn btn-primary">Reset</button>
                </div>
                <div class="link mb-3 text-center text-white">
                    <a href="./login.php">Cancel</a>
                </div>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/resetPass.js"></script>
</body>

</html>