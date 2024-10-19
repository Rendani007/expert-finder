(function ($) {
    $(document).ready(function () {
        $("#resetEmail").click(function (event) {
            event.preventDefault();

            let csrf_token = $("#csrf_token").val();  // Added $() to correctly select the element
            let emailInput = $("#emailInput").val();       // Added $() to correctly select the element
            let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;


            if (emailRegex.test(emailInput)) {   // Uncomment and check if email format is correct
                let form_data = new FormData(document.getElementById("formEmail"));
                form_data.append("csrf_token", csrf_token);
                form_data.append("emailInput", emailInput);

                $.ajax({
                    url: 'http://localhost/Data/forgotPassword.php',  // Update this URL to your actual PHP script
                    type: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        // console.log(data); // Handle the response from the server
                        alert("an email has been sent to you, please click the link and reset your password");  // Replace with actual success page
                    }
                });
                
            } else {
                alert("Please enter a valid email address.");  // Add validation feedback
            }
        });
    });
})(jQuery);
