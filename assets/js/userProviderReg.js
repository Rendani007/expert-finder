(function ($) {//wrapping code in an IIFE (Immediately Invoked Function Expression) to prevent polluting the global namespace, especially if you're working in a larger codebase.
    $(document).ready(function () {
        $('#signIn').click(function (event) {
            event.preventDefault();

            let userProvOption = $("#userProvOption").val();
            let csrf_token = $("#csrf_token").val();
            let regName = $("#regName").val();
            let regSurname = $("#regSurname").val();
            let regEmail = $("#regEmail").val();
            let regPass = $("#regPass").val();
            let phoneNumber = $("#phoneNumber").val();
            let flexCheckDefault = $("#flexCheckDefault").is(':checked');//cant proceed until this checked box is selected
            let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            // let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{4,}$/;
            let phoneRegex = /^(?:\+27|0)[6-8][0-9]{8}$/;

            if (emailRegex.test(regEmail)) {


                if (phoneNumber === phoneRegex) {

                    if (flexCheckDefault) {

                        if (passwordRegex.test(regPass)) {

                            let form_data = new FormData(document.getElementById("userProviderForm"))
                            form_data.append("userProvOption", userProvOption);
                            form_data.append("csrf_token", csrf_token);
                            form_data.append("regName", regName);
                            form_data.append("regSurname", regSurname);
                            form_data.append("regEmail", regEmail);
                            form_data.append("phoneNumber", phoneNumber);
                            form_data.append("regPass", regPass);


                            $.ajax({
                                url: 'http://localhost/Data/userProviderReg.php',  // Update this URL to your actual PHP script
                                type: "POST",
                                data: form_data,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function (data) {
                                    console.log(data); // Handle the response from the server
                                    window.location.href = "http://localhost/questions.php";
                                },
                                error: function (xhr, status, error) {
                                    console.log('Error: ' + error); // Handle any errors
                                }
                            });
                        } else {
                            //Has at least 4 characters.
                            //Includes at least one uppercase letter, one lowercase letter, 
                            //one number.
                            alert("Please make sure that your password is correct");
                        }
                    } else {
                        alert("Please accept terms and conditions");
                    }
                } else {
                    alert("Invalid phone number! Please enter a valid South African phone number.");
                }

            } else {
                // Show email validation error
                alert("Please make sure that your email is correct and valid");
            }
        });
    });
})(jQuery);

