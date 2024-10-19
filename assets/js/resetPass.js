(function ($) {
    $(document).ready(function () {
        $("#resetPassword").click(function (event) {
            event.preventDefault();

            let csrf_token = $("#csrf_token").val();  // Added $() to correctly select the element
            let Password = $("#Password").val();       // Added $() to correctly select the element
            let confirmPassword = $("#confirmPassword").val();       // Added $() to correctly select the element
            let userEmail = $("#userEmail").val();       // Added $() to correctly select the element
            //at least one uppercase letter, one lowercase letter, one number, one special character, and a minimum length of 8 characters 
            // let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{4,}$/;



            if (Password == confirmPassword) {
                if (passwordRegex.test(confirmPassword)) {   // Uncomment and check if email format is correct
                    let form_data = new FormData(document.getElementById("formEmailReset"));
                    form_data.append("csrf_token", csrf_token);
                    form_data.append("confirmPassword", confirmPassword);
                    form_data.append("userEmail", userEmail);

                    $.ajax({
                        url: 'http://localhost/Data/resetPassword.php',  // Update this URL to your actual PHP script
                        type: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            console.log(data);
                            // window.location.href = "http://localhost/login.php";  // Replace with actual success page
                        }
                    });
                } else {
                    alert("Please enter a valid password.");  // Add validation feedback
                }
            } else {
                alert("Your password and Confirm assword do not match.");
            }

        });
    });
})(jQuery);
