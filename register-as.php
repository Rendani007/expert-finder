<?php  
session_start();

if (empty($_SESSION['csrf_token'])) {
    // $selectedOption = $_SESSION['selectedOption'];
    $CSRFtoken = $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // 32-byte token
} else {
    $CSRFtoken = $_SESSION['csrf_token'];

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Expert Finder</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet" crossorigin="anonymous">
  </head>
  <body>
    <main class="p-2 bg-dark d-flex justify-content-center align-items-center">
        <div class="form-wrapper">
            <div class="logo text-white text-center mb-4">
                <h1 class="fw-bold">Expert Finder</h1>
            </div>
            <form id="userReg" enctype="multipart/form-data">
                <div class="row mb-3 g-1">
                    <div class="col-md-6">
                    <input type="hidden" id="csrf_token" name="csrf_token"
                    value="<?php echo $CSRFtoken ?>">
                        <input type="radio" class="btn-check" name="options-base" id="option1" autocomplete="off" value="Provider">
                        <label class="btn btn-outline-primary" for="option1">I'm a service provider looking for clients</label>
                    </div>
                    <div class="col-md-6">
                        <input type="radio" class="btn-check" name="options-base" id="option2" autocomplete="off" value="Client">
                        <label class="btn btn-outline-primary" for="option2">I'm a user looking for a service provider</label>
                    </div>
                </div>
                
                <div class="d-grid mb-3">
                    <button id="signUpType" class="btn btn-primary">Apply</button>
                </div>
                <div class="link mb-3 text-center text-white">
                    <p>Already have an account? <a href="/login.php">Sign In</a></p>
                </div>
            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   
    <script src="./assets/js/userOrProvider.js"></script>
</body>
</html>