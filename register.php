<!doctype html>
<html lang="en">
<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
   
    $CSRFtoken = $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // 32-byte token
} else {
    $selectedOption = $_SESSION['selectedOption'];
    $CSRFtoken = $_SESSION['csrf_token'];

}

include "./head.php";


?>

<body>
    <main class="p-2 bg-dark d-flex justify-content-center align-items-center">
        <div class="form-wrapper">
            <div class="logo text-white text-center mb-4">
                <h1 class="fw-bold">Expert Finder</h1>
            </div>
            <form id="userProviderForm" enctype="multipart/form-data">
                <div class="row g-1">
                    <div class="col-md-6 form-floating mb-3">
                    <input type="hidden" class="form-control" id="userProvOption"
                            value="<?php echo $selectedOption ?>"
                            placeholder="userProvOption">
                        <input type="" id="csrf_token" name="csrf_token"
                            value="<?php echo $CSRFtoken ?>">

                        
                        <input type="text" class="form-control" id="regName" placeholder="Name" required>
                        <label for="floatingInput">Name</label>
                    </div>
                    <div class="col-md-6 form-floating mb-3">
                        <input type="text" class="form-control" id="regSurname" placeholder="Surname" required>
                        <label for="floatingInput">Surname</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="regEmail" placeholder="name@example.com" required>
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="regPass" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="regResetPass" placeholder="Confirm Password">
                    <label for="floatingPassword">Repeat Password</label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label text-white" for="flexCheckDefault">
                        I have read and agree to the terms
                    </label>
                </div>
                <div class="d-grid mb-3">
                    <button id="signIn" class="btn btn-primary">Sign Up</button>
                </div>
                <div class="link mb-3 text-center text-white">
                    <p>Already have an account? <a href="login.php">Sign In</a></p>
                </div>
            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="./assets/js/userProviderReg.js"></script>

</body>

</html>