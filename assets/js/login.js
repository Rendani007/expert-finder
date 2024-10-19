(function ($) {
    $(document).ready(function () {
        $("#signIn").click(function (event) {
            event.preventDefault();

            let csrf_token = $("#csrf_token").val();  // Added $() to correctly select the element
            let emailInput = $("#email").val();       // Added $() to correctly select the element
            let password = $("#password").val();       // Added $() to correctly select the element
            let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{4,}$/;

            if (emailRegex.test(emailInput)) {   // Uncomment and check if email format is correct
                if (passwordRegex.test(password)) {

                    let form_data = new FormData(document.getElementById("loginForm"));
                    form_data.append("csrf_token", csrf_token);
                    form_data.append("emailInput", emailInput);
                    form_data.append("password", password);

                    $.ajax({
                        url: 'http://localhost/Data/login.php',  // Update this URL to your actual PHP script
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            console.log(data); // Handle the response from the server
                            window.location.href = "http://localhost/index.php";

                        }
                    });
                } else {
                    alert("password must at least have one uppercase letter, one lowercase letter, one number, one special character, and a minimum length of 8 characters ");
                }
            } else {
                alert("Please enter a valid email address.");  // Add validation feedback
            }
        });
    });
})(jQuery);
