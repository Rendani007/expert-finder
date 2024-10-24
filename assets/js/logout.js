(function ($) {
    $(document).ready(function () {
        $('#logoutBtn').on('click', function () {
            console.log("Logout button clicked!");
            $.ajax({
                url: 'http://localhost/Data/logout.php', // URL to the logout.php script
                type: 'POST', // Make a POST request to logout.php
                success: function (response) {
                    // Optionally, clear local/session storage
                    sessionStorage.clear();  // Clear session data from sessionStorage
                    localStorage.clear();    // Clear local storage data

                    // Redirect to the login page after successful logout
                    window.location.href = 'http://localhost/login.php';
                },
                error: function (xhr, status, error) {
                    console.error('Logout failed:', xhr.status, xhr.responseText, error);
                }
            });
        });
    });
})(jQuery);
