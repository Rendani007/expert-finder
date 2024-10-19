// Function to handle the logout
(function ($) {
    $(document).ready(function () {
        $('#logoutBtn').on('click', function () {
            $.ajax({
                url: 'https://localhost/Data/logout.php', // URL to the logout.php script
                type: 'POST', // Make a POST request to logout.php
                success: function (response) {
                    // Optionally, clear local/session storage
                    sessionStorage.clear();  // Clear session data from sessionStorage
                    localStorage.clear();    // Clear local storage data

                    // Redirect to the login page after successful logout
                    window.location.href = 'https://localhost/login.php';
                },
                error: function (xhr, status, error) {
                    // Handle any error that occurs during the AJAX request
                    console.error('Logout failed:', error);
                }
            });
        });
    });
})(jQuery);