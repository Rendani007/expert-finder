$(document).ready(function () {
    $('#signUpType').click(function (event) {
        event.preventDefault();

        var option = null;
        let csrf_token = $("#csrf_token").val();
        if ($('#option1').is(':checked')) {
            option = $('#option1').val();  // Value is "Provider"
        } else if ($('#option2').is(':checked')) {
            option = $('#option2').val();  // Value is "Client"
        }

        // If no option is selected, alert the user and return
        if (!option) {
            alert('Please select either "Service Provider" or "Client" before proceeding.');
            return;  // Stop the function execution if no option is selected
        }


        // Create form data object and append the selected option
        var form_data = new FormData(document.getElementById("userReg"));
        form_data.append("csrf_token", csrf_token);
        form_data.append("selectedOption", option);  // Append the selected option to the form data


        // Perform the AJAX request
        $.ajax({
            url: 'http://localhost/Data/userOrProvider.php',  // Update this URL to your actual PHP script
            type: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data); // Handle the response from the server
                window.location.href = "http://localhost/register.php";
            },
            error: function (xhr, status, error) {
                console.log('Error: ' + error); // Handle any errors
            }
        });
    });
});
